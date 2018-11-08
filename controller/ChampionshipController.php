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
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Adding Championship requires login");
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

	public function edit() {
		if (!isset($_REQUEST["id"])) {
			throw new Exception("A post id is mandatory");
		}

		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Editing posts requires login");
		}


		// Get the Post object from the database
		$postid = $_REQUEST["id"];
		$post = $this->postMapper->findById($postid);

		// Does the post exist?
		if ($post == NULL) {
			throw new Exception("no such post with id: ".$postid);
		}

		// Check if the Post author is the currentUser (in Session)
		if ($post->getAuthor() != $this->currentUser) {
			throw new Exception("logged user is not the author of the post id ".$postid);
		}

		if (isset($_POST["submit"])) { // reaching via HTTP Post...

			// populate the Post object with data form the form
			$post->setTitle($_POST["title"]);
			$post->setContent($_POST["content"]);

			try {
				// validate Post object
				$post->checkIsValidForUpdate(); // if it fails, ValidationException

				// update the Post object in the database
				$this->postMapper->update($post);

				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of posts
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash(sprintf(i18n("Post \"%s\" successfully updated."),$post ->getTitle()));

				// perform the redirection. More or less:
				// header("Location: index.php?controller=posts&action=index")
				// die();
				$this->view->redirect("posts", "index");

			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}

		// Put the Post object visible to the view
		$this->view->setVariable("post", $post);

		// render the view (/view/posts/add.php)
		$this->view->render("posts", "edit");
	}


	public function delete() {
		if (!isset($_POST["id"])) {
			throw new Exception("id is mandatory");
		}
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Editing posts requires login");
		}
		
		// Get the Post object from the database
		$postid = $_REQUEST["id"];
		$post = $this->postMapper->findById($postid);

		// Does the post exist?
		if ($post == NULL) {
			throw new Exception("no such post with id: ".$postid);
		}

		// Check if the Post author is the currentUser (in Session)
		if ($post->getAuthor() != $this->currentUser) {
			throw new Exception("Post author is not the logged user");
		}

		// Delete the Post object from the database
		$this->postMapper->delete($post);

		// POST-REDIRECT-GET
		// Everything OK, we will redirect the user to the list of posts
		// We want to see a message after redirection, so we establish
		// a "flash" message (which is simply a Session variable) to be
		// get in the view after redirection.
		$this->view->setFlash(sprintf(i18n("Post \"%s\" successfully deleted."),$post ->getTitle()));

		// perform the redirection. More or less:
		// header("Location: index.php?controller=posts&action=index")
		// die();
		$this->view->redirect("posts", "index");

	}
}
