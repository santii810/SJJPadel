<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Category.php");
require_once(__DIR__."/../model/CategoryMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class CategoryController extends BaseController {

	/**
	* Reference to the UserMapper to interact
	* with the database
	*
	* @var UserMapper
	*/
	private $categoryMapper;

	public function __construct() {
		parent::__construct();

		$this->categoryMapper = new CategoryMapper();
	}

	public function showall(){
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. see users requires admin");
		}

		$categories = $this->categoryMapper->getCategorias();

		// Put the User object visible to the view
		$this->view->setVariable("categories", $categories);

		// render the view (/view/users/register.php)
		$this->view->render("category", "showall");

	}

	public function delete(){
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. delete category requires login");
		}

		$userMapper = new UserMapper();

		if ( isset($_POST['level']) && isset($_POST['sex']) ) {

			$this->categoryMapper->delete($_POST['id']);

			$this->view->setFlash("successfully delete");

			$this->view->redirect("category", "showall");

		}



		$category = $this->categoryMapper->getDatos($_REQUEST['id']);

		// Put the User object visible to the view
		$this->view->setVariable("category", $category);

		// render the view (/view/users/register.php)
		$this->view->render("category", "delete");

	}

	public function edit(){
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. category requires sesion");
		}

		if ( isset($_POST['level']) && isset($_POST['sex']) && isset($_POST['id']) ) {

			$this->categoryMapper->edit( $_POST['level'],$_POST['sex'],$_POST['id'] );

			$this->view->setFlash("successfully modify");

			$this->view->redirect("category", "showall");

		}



		$category = $this->categoryMapper->getDatos($_REQUEST['id']);

		// Put the User object visible to the view
		$this->view->setVariable("category", $category);

		// render the view (/view/users/register.php)
		$this->view->render("category", "edit");

	}

	public function add(){
		$category = new Category();

		if (isset($_POST["level"])){ // reaching via HTTP Post...

			// populate the User object with data form the form
			$category->setNivel($_POST["level"]);
			$category->setSexo($_POST["sex"]);
			

			try{
				$category->checkIsValidForCreate(); // if it fails, ValidationException

				// check if user exists in the database
				if (!$this->categoryMapper->categoryExists( $category ) ) {

					// save the User object into the database
					$this->categoryMapper->save($category);

					// POST-REDIRECT-GET
					// Everything OK, we will redirect the user to the list of posts
					// We want to see a message after redirection, so we establish
					// a "flash" message (which is simply a Session variable) to be
					// get in the view after redirection.
					$this->view->setFlash("Category added");

					// perform the redirection. More or less:
					// header("Location: index.php?controller=users&action=login")
					// die();
					$this->view->redirect("category", "showall");
				} else {
					$errors = array();
					$errors["category"] = "Category already exists";
					$this->view->setVariable("errors", $errors);
				}
			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}

		// Put the User object visible to the view
		$this->view->setVariable("category", $category);

		// render the view (/view/users/register.php)
		$this->view->render("category", "add");
	}

}
