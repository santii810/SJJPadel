<?php

// file: controller/PostController.php
require_once (__DIR__ . "/../model/Championship.php");
require_once (__DIR__ . "/../model/ChampionshipMapper.php");
require_once (__DIR__ . "/../model/CategoryChampionship.php");
require_once (__DIR__ . "/../model/CategoryChampionshipMapper.php");
require_once (__DIR__ . "/../model/User.php");
require_once (__DIR__ . "/../model/Partner.php");
require_once (__DIR__ . "/../model/Group.php");
require_once (__DIR__ . "/../model/GroupMapper.php");
require_once (__DIR__ . "/../model/Partnergroup.php");
require_once (__DIR__ . "/../model/PartnergroupMapper.php");
require_once (__DIR__ . "/../model/Confrontation.php");
require_once (__DIR__ . "/../model/ConfrontationMapper.php");

require_once (__DIR__ . "/../core/ViewManager.php");
require_once (__DIR__ . "/../controller/BaseController.php");

class ChampionshipController extends BaseController
{

	private $championshipMapper;

	private $categoryChampionshipMapper;

	private $groupMapper;

	private $partnerGroupMapper;

	private $confrontationMapper;

	private $groupNames = array(
		"Grupo A",
		"Grupo B",
		"Grupo C",
		"Grupo D",
		"Grupo E",
		"Grupo F"
	);

	public function __construct()
	{
		parent::__construct();
		
		$this->championshipMapper = new ChampionshipMapper();
		$this->categoryChampionshipMapper = new CategoryChampionshipMapper();
		$this->groupMapper = new GroupMapper();
		$this->partnerGroupMapper = new PartnergroupMapper();
		$this->confrontationMapper = new ConfrontationMapper();
	}

	public function add()
	{
		if (! isset($this->currentUser) && $this->currentRol == 'a') {
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
                $this->view->setFlash(sprintf(i18n("Post \"%s\" successfully added."), $championship->getNombreCampeonato()));
                
                // perform the redirection. More or less:
                // header("Location: index.php?controller=posts&action=index")
                // die();
                $this->view->redirect("users", "index");
            } catch (ValidationException $ex) {
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

    public function selectToCalendar()
    {
    	$campeonatos = $this->championshipMapper->getCampeonatosToGenerateGroups();
    	
    	$this->view->setVariable("campeonatos", $campeonatos);
    	$this->view->render("championship", "selectToCalendar");
    }

    /*
     * Genera el calendario de un campeonato.
     * Recorre el conjunto de categorias de los campeonatos.
     * Para cada una crea grupos de entre 8 y 12 parejas
     * Luego, usando la lista de parejas se asignan N parejas a cada grupo
     */
    public function generateCalendar()
    {
    	//Comprobamos que se haya seleccionado un campeonato
    	if(isset($_POST["idCampeonato"]) && $_POST["idCampeonato"] != 0){
    		$idCampeonato = $_POST["idCampeonato"];
    		unset($_POST["idCampeonato"]);
    		$categoriasCampeonato = $this->categoryChampionshipMapper->getCategoriesFromChampionship($idCampeonato);

    		foreach ($categoriasCampeonato as $categoriaCampeonato) {
    			$couples = $this->categoryChampionshipMapper->getCouples($categoriaCampeonato->getId());
    			if (sizeof($couples) > 7) {
    				$groupIds = $this->createGroups($couples, $categoriaCampeonato);
    				$this->asignCouples($couples, $groupIds);
    				$this->fillConfrontations($groupIds);
    			}
    		}
    	}else{
    		$this->view->render("championship", "selectToCalendar");
    	}
    }

    /**
     * Va repartiendo las parejas en los grupos creados
     *
     * @param
     *            couples parejas apuntadas a la categoria
     * @param
     *            groupIds grupos de dicha categoria
     */
    private function asignCouples($couples, $groupIds)
    {
    	$roulette = 0;
    	$asignedCouples = 0;
    	foreach ($couples as $couple) {
            if ($asignedCouples < 12 * sizeof($groupIds)) { // Se asegura de que no existan grupos de mas de 12 parejas
            	$this->partnerGroupMapper->save(new Partnergroup($couple->getIdPartner(), $groupIds[$roulette]));
            	$roulette = ($roulette + 1) % sizeof($groupIds);
            	$asignedCouples ++;
            }
        }
    }

    /**
     * Crea grupos en funcion de las parejas asignadas
     *
     * @param
     *            couples Parejas apuntadas a dicha categoria
     * @param
     *            categoriaCampeonato categoria a gestionar
     */
    private function createGroups($couples, $categoriaCampeonato)
    {
        $numGroups = floor(sizeof($couples) / 8); // calculo el numero de grupos dividiendo
        $groupSize = min(sizeof($couples) / $numGroups, 12); // si el tamaño de los grupos es mayor de 12 lo trunco
        
        $groupIds = array();
        // Se crean los grupos necesarios
        for ($i = 0; $i < $numGroups; $i ++) {
        	$group = new Group(NULL, $categoriaCampeonato->getIdCategory(), $categoriaCampeonato->getIdChampionship(), $this->groupNames[$i]);
        	array_push($groupIds, $this->groupMapper->save($group));
        }
        return $groupIds;
    }

    private function fillConfrontations($groupIds)
    {
    	foreach ($groupIds as $idGrupo) {
    		$couplesGroup = $this->partnerGroupMapper->getIdParejasGrupo($idGrupo);
    		for ($i = 0; $i < sizeof($couplesGroup); $i ++) {
    			for ($j = ($i + 1); $j < sizeof($couplesGroup); $j ++) {
    				$confrontation = new Confrontation(NULL, $couplesGroup[$i]->getIdPartner(), $couplesGroup[$j]->getIdPartner(), $idGrupo);
    				$this->confrontationMapper->save($confrontation);
    			}
    		}
    		
    		foreach ($couplesGroup as $couple) {}
    	}
}
}
