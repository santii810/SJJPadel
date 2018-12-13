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

require_once (__DIR__ . "/../model/Category.php");
require_once (__DIR__ . "/../model/CategoryMapper.php");

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

    private $categoryMapper;

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
        $this->categoryMapper = new categoryMapper();
        $this->partnerGroupMapper = new PartnergroupMapper();
        $this->confrontationMapper = new ConfrontationMapper();
    }

    public function showall(){
        if (!isset($this->currentUser)) {
            throw new Exception("Not in session. see championship requires admin");
        }

        $championships = $this->championshipMapper->getCampeonatos();

        // Put the User object visible to the view
        $this->view->setVariable("championships", $championships);

        // render the view (/view/users/register.php)
        $this->view->render("championship", "showall");

    }


    public function add()
    {
        if (! isset($this->currentUser) && $this->currentRol == 'a') {
            throw new Exception("Not in session. Adding Championship requires admin");
        }
        
        $championship = new Championship();
        
        if ( isset($_POST["fechaInicioInscripcion"] ) ) { // reaching via HTTP Post...
                                                       // populate the Post object with data form the form
            $championship->setFechaInicioInscripcion($_POST["fechaInicioInscripcion"]);
            $championship->setFechaFinInscripcion($_POST["fechaFinInscripcion"]);
            $championship->setFechaInicioCampeonato($_POST["fechaInicioCampeonato"]);
            $championship->setFechaFinCampeonato($_POST["fechaFinCampeonato"]);
            $championship->setNombreCampeonato($_POST["nombreCampeonato"]);
            
            $idCurrentChampionship = -1;

            try {
                // validate Post object
                $championship->checkIsValidForCreate(); // if it fails, ValidationException
                                                        // save the Post object into the database
                $idCurrentChampionship = $this->championshipMapper->save($championship);

                for ($i=0; $i < count($_POST['categories']); $i++) { 
                    $this->categoryChampionshipMapper->save( new CategoryChampionship( NULL ,  $idCurrentChampionship,$_POST['categories'][$i] ) );
                }
                
                
                $this->view->setFlash(sprintf(i18n("Championship successfully added."), $championship->getNombreCampeonato()));
               
                $this->view->redirect("championship", "showall");
            } catch (ValidationException $ex) {
                // Get the errors array inside the exepction...
                $errors = $ex->getErrors();
                // And put it to the view as "errors" variable
                $this->view->setVariable("errors", $errors);
            }

        }
        
        //Devuelve las categorias para insertar en campeonato
        $categories = $this->categoryMapper->getCategorias();

        // Put the Post object visible to the view
        $this->view->setVariable("championship", $championship);
        $this->view->setVariable("categories", $categories);
        
        // render the view (/view/posts/add.php)
        $this->view->render("championship", "add");
    }

    public function delete(){
        if (!isset($this->currentUser)) {
            throw new Exception("Not in session. delete championship requires admin");
        }

        if ( isset($_POST['name_championship']) && isset($_POST['date_start_inscription']) && isset($_POST['date_end_inscription']) && isset($_POST['date_start_championship']) && isset($_POST['date_end_championship'] )) {

            $this->championshipMapper->delete($_POST['id']);

            $this->view->setFlash("successfully delete");

            $this->view->redirect("championship", "showall");

        }

        $championship = $this->championshipMapper->getDatos($_REQUEST['id']);
        $categories = $this->championshipMapper->getCategorias($_REQUEST['id']);

        // Put the User object visible to the view
        $this->view->setVariable("championship", $championship);
        $this->view->setVariable("categories", $categories);

        // render the view (/view/users/register.php)
        $this->view->render("championship", "delete");

    }

    public function edit(){
        if (!isset($this->currentUser)) {
            throw new Exception("Not in session. edit championship requires sesion");
        }

        $categoriesCurrentChampionship = $this->championshipMapper->getCategorias($_REQUEST['id']);

        if ( isset($_POST["fechaInicioInscripcion"] ) ) {

            $championship = new Championship($_POST['id'],
                                             $_POST['fechaInicioInscripcion'],
                                             $_POST['fechaFinInscripcion'],
                                             $_POST['fechaInicioCampeonato'],
                                             $_POST['fechaFinCampeonato'],
                                             $_POST['nombreCampeonato']
                                            );
        
            $this->championshipMapper->edit( $championship );

            //actualizar categorias del campeonato
            $this->editCategoriesChampionship($categoriesCurrentChampionship, $_POST['categories'], $_POST['id']);

            $this->view->setFlash("successfully modify");

            $this->view->redirect("championship", "showall");

        }


        //Devuelve los datos de un campeonato
        $championship = $this->championshipMapper->getDatos($_REQUEST['id']);

        //Devuelve las categorias para insertar en campeonato
        $categories = $this->categoryMapper->getCategorias();

        // Put the User object visible to the view
        $this->view->setVariable("championship", $championship);
        $this->view->setVariable("categories", $categories);

        $this->view->setVariable("categoriesCurrentChampionship", $categoriesCurrentChampionship);

        // render the view (/view/users/register.php)
        $this->view->render("championship", "edit");

    }

    public function selectToCalendar()
    {
        if (!isset($this->currentUser)) {
          throw new Exception("Not in session. Check Confrontations requires login");
      }
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
        if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Check Confrontations requires login");
    }
        $groupHasGenerated = false;
        // Comprobamos que se haya seleccionado un campeonato
        if (isset($_POST["idCampeonato"]) && $_POST["idCampeonato"] != 0) {
            $idCampeonato = $_POST["idCampeonato"];
            unset($_POST["idCampeonato"]);
            $categoriasCampeonato = $this->categoryChampionshipMapper->getCategoriesFromChampionship($idCampeonato);
            
            foreach ($categoriasCampeonato as $categoriaCampeonato) {
                $couples = $this->categoryChampionshipMapper->getCouples($categoriaCampeonato->getId());
                if (sizeof($couples) > 7) {
                    $groupHasGenerated = true;
                    $groupIds = $this->createGroups($couples, $categoriaCampeonato);
                    $this->asignCouples($couples, $groupIds);
                    $this->fillConfrontations($groupIds);
                }
            }
            
            if ($groupHasGenerated) {
                $this->view->setVariable("messageToShow", i18n("Properly generated calendar."));
                $this->view->setVariable("showButton", true);
                
            } else{
                $this->view->setVariable("messageToShow", i18n("There are not enough athletes register to create a group."));                
            }
            $this->view->render("championship", "calendarGenerated");
        } else {
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



    private function editCategoriesChampionship($categoriesCurrentChampionship,$categoriesSeleted,$idChampionship) {
        $array_id_current = array();
        //para comparar necesitamos los id en este caso
        foreach ($categoriesCurrentChampionship as $value) {
            $array_id_current[] = $value->getId(); 
        }
        //Si no se han seleccionado las categorias existentes estas se borran
        for ($i=0; $i < count($array_id_current); $i++) {
            if (!in_array( $array_id_current[$i], $categoriesSeleted )) {
                $this->categoryChampionshipMapper->delete($idChampionship,$array_id_current[$i]);
            }
        }

        $categoryChampionship = new CategoryChampionship();
        $categoryChampionship->setIdChampionship($_POST['id']);

        //Si no estan las categorias añadidas las añade    
        for ($i=0; $i < count($categoriesSeleted); $i++) { 
          if (!$this->categoryChampionshipMapper->existsCategory( $idChampionship, $categoriesSeleted[$i] ) ) {
                $categoryChampionship->setIdCategory($categoriesSeleted[$i]);                    
                $this->categoryChampionshipMapper->save($categoryChampionship);
            }
        }

    }

}
