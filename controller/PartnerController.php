<?php
//file: controller/PartnerController.php

require_once(__DIR__."/../model/Partner.php");
require_once(__DIR__."/../model/PartnerMapper.php");
require_once(__DIR__."/../model/ChampionshipMapper.php");
require_once(__DIR__."/../model/Partnergroup.php");
require_once(__DIR__."/../model/PartnergroupMapper.php");
require_once(__DIR__."/../model/CategoryMapper.php");
require_once(__DIR__."/../model/Group.php");
require_once(__DIR__."/../model/GroupMapper.php");
require_once(__DIR__."/../model/CategoryChampionshipMapper.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");


class PartnerController extends BaseController {

	private $partnerMapper;

	public function __construct() {
		parent::__construct();

		$this->partnerMapper = new PartnerMapper();
	}

	public function selectChampionship() {
		$championship = new ChampionshipMapper();

		if (!isset($this->currentUser) && ( $this->currentRol == 'a' || $this->currentRol == 'e' || $this->currentRol == 'd' )) {
			throw new Exception("Not in session. Adding partner Championship requires login");
		}
		
		if (isset($_POST['idCampeonato'])) {
			$user = new UserMapper();

			if ($_POST['login'] != $this->currentUser->getLogin() && $user->loginExists($_POST["login"])) {
				
				$_SESSION['idCamp'] = $_POST['idCampeonato'];
				$_SESSION['loginComp'] = $_POST['login'];
				$this->view->redirect("partner", "inscription" );
			} else {
				$errors = array();
				if ($_POST['login'] == $this->currentUser->getLogin()) {
					$errors["login"] = "the login can not be the same as the logged in user";
				} else {
					$errors["login"] = "Login does not exist";
				}
				$this->view->setVariable("errors", $errors);
			}

		}

		//todos los campeonatos
		$campeonatos = $championship->getCampeonatosParaIncripcion();
		
		//mandamos el valor de variable para que lo recoga la vista
		$this->view->setVariable("campeonatos",$campeonatos);

		// render the view (/view/posts/add.php)
		$this->view->render("partner", "selectChampionship");

	}

	public function inscription() {
		if (!isset($this->currentUser) && ( $this->currentRol == 'a' || $this->currentRol == 'e' || $this->currentRol == 'd' )) {
			throw new Exception("Not in session. Adding partner Championship requires login");
		}
		//Solo se realiza al inicio
		if ((isset($_SESSION['idCamp'])) && (isset($_SESSION['loginComp']))) {
			//asignamos los valores para que empiece el ciclo
			$_POST['idCampeonato'] = $_SESSION['idCamp'];
			$_POST['login'] = $_SESSION['loginComp'];
			//eliminamos las variables de session
			unset($_SESSION['idCamp']);
			unset($_SESSION['loginComp']);
		}

		$partner = new Partner();
		
		if (isset($_POST["idCategoria"])) { // reaching via HTTP Post...
			//Obtenemos el objecto category-campionship relacionado con el idCampeonato y idCategoria seleccionado
			$CategoryChampionshipMapper = new CategoryChampionshipMapper();
			$objectCategoryChampionship = $CategoryChampionshipMapper->getCategoryFromChampionship($_POST['idCampeonato'],$_POST['idCategoria']);

			//Obtenemos el genero del compañero de equipo
			$userMapper = new UserMapper();
			$datosPareja = $userMapper->getDatos($_POST['login']);
			$generoPareja = $datosPareja->getGender();

			//Mapper para obtener la funcion de 'esGeneroAceptado'
			$categoryMapper = new categoryMapper();

			//Mapper para la fucion existe pareja categoria
			$partnerMapper = new PartnerMapper();

			if ( $categoryMapper->esGeneroAceptado($_POST['idCategoria'],$generoPareja) &&
				 $categoryMapper->esGeneroAceptado($_POST['idCategoria'],$this->currentUser->getGender()) &&
				 !$partnerMapper->existeParejaCategoria($_POST['login'],$objectCategoryChampionship->getId()) &&
				 !$partnerMapper->existeParejaCategoria($this->currentUser->getLogin(),$objectCategoryChampionship->getId())
				) {

				//Si no esta inscrito ya en el campeonato y el genero es compatible lo insertamos en la tabla pareja

				$partner = new Partner();
				$partner->setIdCaptain($this->currentUser->getLogin());
				$partner->setIdFellow($_POST['login']);
				$partner->setIdCategoryChampionship($objectCategoryChampionship->getId());

				//inscribimos en la base de datos la pareja
				$partnerMapper->save($partner);

				$this->view->setFlash("successfully inscription");

				$this->view->redirect("users", "index");
				
			} else {
				$errors = array();
				
				if (!$categoryMapper->esGeneroAceptado($_POST['idCategoria'],$generoPareja)) {
					$errors["login"] = "El genero de tu pareja no es compatible con esta categoria";
				} else if (!$categoryMapper->esGeneroAceptado($_POST['idCategoria'],$this->currentUser->getGender())) {
					$errors["login"] = "Tu genero no es compatible con esta categoria";
				} else if($partnerMapper->existeParejaCategoria($_POST['login'],$objectCategoryChampionship->getId())) {
					$errors["login"] = "Tu compañero ya esta inscrito en esta categoría";
				} else if($partnerMapper->existeParejaCategoria($this->currentUser->getLogin())) {
					$errors["login"] = "Ya estas inscrito en esta categoría";
				} else {
					$errors['login'] = "Error";
				} 

				$this->view->setVariable("errors", $errors);
			}
		}

		if (isset($_POST["idCampeonato"])) {
			//obtenemos las categorias de ese campeonato
			$championship = new ChampionshipMapper();
			$categorias = $championship->getCategorias($_POST["idCampeonato"]);

			$this->view->setVariable("idCampeonato",$_POST["idCampeonato"]);
			$this->view->setVariable("categorias",$categorias);
			$this->view->setVariable("login",$_POST['login']);

			// render the view (/view/posts/add.php)
			$this->view->render("partner", "inscription");

		//si se accede directamente sin seleccionar el campeonato dirige al index
		} else {
			$this->view->setFlash(sprintf(i18n("error en peticion.")));
			$this->view->redirect("users", "index");
		}
	}

}
