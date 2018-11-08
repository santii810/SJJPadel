<?php
//file: controller/PostController.php

require_once(__DIR__."/../model/Partner.php");
require_once(__DIR__."/../model/PartnerMapper.php");
require_once(__DIR__."/../model/ChampionshipMapper.php");
require_once(__DIR__."/../model/Partnergroup.php");
require_once(__DIR__."/../model/PartnergroupMapper.php");
require_once(__DIR__."/../model/CategoryMapper.php");
require_once(__DIR__."/../model/Group.php");
require_once(__DIR__."/../model/GroupMapper.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

/**
* Class PostsController
*
* Controller to make a CRUDL of Posts entities
*
* @author lipido <lipido@gmail.com>
*/
class PartnerController extends BaseController {

	private $partnerMapper;

	public function __construct() {
		parent::__construct();

		$this->partnerMapper = new PartnerMapper();
	}

	public function selectChampionship() {
		$championship = new ChampionshipMapper();

		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Adding partner Championship requires login");
		}
		
		if (isset($_POST['idCampeonato'])) {
			$user = new UserMapper();

			if ($_POST['login'] != $this->currentUser->getLogin() && $user->loginExists($_POST["login"])) {
				//$queryString = "idCampeonato=".$_POST['idCampeonato']."&login=".$_POST['login'];
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
		$campeonatos = $championship->getCampeonatos();
		
		//mandamos el valor de variable para que lo recoga la vista
		$this->view->setVariable("campeonatos",$campeonatos);

		// render the view (/view/posts/add.php)
		$this->view->render("partner", "selectChampionship");

	}

	public function inscription() {
		if (!isset($this->currentUser)) {
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
			$groupMapper = new GroupMapper();
			$partnerMapper = new PartnerMapper();
			$userMapper = new UserMapper();
			$categoryMapper = new categoryMapper();

			//Grupo por defecto de la categoria seleccionada
			$GrupoDefault = $groupMapper->getGrupoDefault($_POST['idCampeonato'],$_POST['idCategoria']);

			//Recogemos generos de los componentes de la pareja
			$datosPareja = $userMapper->getDatos($_POST['login']);
			$generoPareja = $datosPareja->getGender();
			//Comprobaciones para poder inscribirse en el torneo
			if($partnerMapper->comprobarParejaCategoria($idGrupoDefault,$this->currentUser->getLogin()) && 
				$partnerMapper->comprobarParejaCategoria($idGrupoDefault,$_POST['login']) &&
				$categoryMapper->esGeneroAceptado($_POST['idCategoria'],$generoPareja) &&
				$categoryMapper->esGeneroAceptado($_POST['idCategoria'],$this->currentUser->getGender())
			) {
				
				//Rellenamos los datos de la pareja
				$partner = new Partner();
				$partner->setIdCaptain($this->currentUser->getLogin());
				$partner->setIdFellow($_POST['login']);
				$partner->setIdCategory($_POST['idCategoria']);

				//id del elemento insertado
				$idPareja = $partnerMapper->save($partner);

				//relleno tabla pareja grupo
				$partnergroup = new PartnerGroup();
				$partnergroupMapper = new PartnergroupMapper(); 
				//Insertamos los datos en el modelo pareja grupo
				$partnergroup->setIdPartner($idPareja);
				$partnergroup->setIdGroup($GrupoDefault->getIdGroup());

				//Guardamos los datos en la tabla pareja grupo
				$partnergroupMapper->save($partnergroup);

				$this->view->setFlash("successfully inscription");

					// perform the redirection. More or less:
					// header("Location: index.php?controller=users&action=login")
					// die();
				$this->view->redirect("users", "index");
				

			} else {
				$errors = array();
				if (!$partnerMapper->comprobarParejaCategoria($idGrupoDefault,$this->currentUser->getLogin())) {
					$errors["login"] = "Login current user already exists in category";
				} else if(!$partnerMapper->comprobarParejaCategoria($idGrupoDefault,$_POST['login'])){
					$errors["login"] = "Login fellow already exists in category";
				} else if(!$categoryMapper->esGeneroAceptado($_POST['idCategoria'],$generoPareja)){
					$errors['login'] = "Fellow Gender not compability in this category";
				} else if(!$categoryMapper->esGeneroAceptado($_POST['idCategoria'],$this->currentUser->getGender())){
					$errors['login'] = "CurrentUser Gender not compability in this category";
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
