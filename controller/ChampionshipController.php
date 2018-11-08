<?php
//file: controller/PostController.php

require_once(__DIR__."/../model/Championship.php");
require_once(__DIR__."/../model/ChampionshipMapper.php");
require_once(__DIR__."/../model/User.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

/**
* Class PostsController
*
* Controller to make a CRUDL of Posts entities
*
* @author lipido <lipido@gmail.com>
*/
class ChampionshipController extends BaseController {

	private $championshipMapper;

	public function __construct() {
		parent::__construct();

		$this->championshipMapper = new ChampionshipMapper();
	}

	public function add() {
		if (!isset($this->currentUser) && $this->currentRol == 'a' ) {
			throw new Exception("Not in session. Adding Championship requires admin");
		}

		$championship = new Championship();
			
		if (isset($_POST["fechaInicioInscripcion"])) { // reaching via HTTP Post...

			// populate the Post object with data form the form
			$championship->setFechaInicioInscripcion($_POST["fechaInicioInscripcion"]);
			$championship->setFechaFinInscripcion($_POST["fechaFinInscripcion"]);
			$championship->setFechaInicioCampeonato($_POST["fechaInicioCampeonato"]);
			$championship->setFechaFinCampeonato($_POST["fechaFinCampeonato"]);
			$championship->setNombreCampeonato($_POST["nombreCampeonato"]);

			try {
				// validate Post object
				$championship->checkIsValidForCreate(); // if it fails, ValidationException

				// save the Post object into the database
				$this->championshipMapper->save($championship);

				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of posts
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash(sprintf(i18n("Post \"%s\" successfully added."),$championship ->getNombreCampeonato()));

				// perform the redirection. More or less:
				// header("Location: index.php?controller=posts&action=index")
				// die();
				$this->view->redirect("users", "index");

			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}

		// Put the Post object visible to the view
		$this->view->setVariable("championship", $championship);

		// render the view (/view/posts/add.php)
		$this->view->render("championship", "add");

	}
	
}
