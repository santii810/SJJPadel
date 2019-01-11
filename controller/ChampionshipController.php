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

require_once (__DIR__ . "/../model/Partner.php");
require_once (__DIR__ . "/../model/PartnerMapper.php");

require_once (__DIR__ . "/../model/Partnergroup.php");
require_once (__DIR__ . "/../model/PartnergroupMapper.php");

require_once (__DIR__ . "/../model/Confrontation.php");
require_once (__DIR__ . "/../model/ConfrontationMapper.php");

require_once (__DIR__ . "/../model/InscriptionUserChampionship.php");
require_once (__DIR__ . "/../model/InscriptionUserChampionshipMapper.php");

require_once (__DIR__ . "/../core/ViewManager.php");
require_once (__DIR__ . "/../controller/BaseController.php");

require_once (__DIR__ . "/../model/Fase.php");

/**
 * Controlador de campeonatos
 */
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
        $this->inscriptionUserChampionshipMapper = new InscriptionUserChampionshipMapper();
    }

    /**
     * Lleva a la vista de ver campeonatos
     *
     * @throws Exception
     */
    public function showall()
    {
        if (! isset($this->currentUser)) {
            throw new Exception("Not in session. see championship requires admin");
        }
        
        $championships = $this->championshipMapper->getCampeonatos();
        
        // Put the User object visible to the view
        $this->view->setVariable("championships", $championships);
        
        // render the view (/view/users/register.php)
        $this->view->render("championship", "showall");
    }
/**
 * Inserta un campeonato
 * @throws Exception Realizar acciones de campeonato requise ser admin
 */
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
            
            $idCurrentChampionship = - 1;
            
            try {
                // validate Post object
                $championship->checkIsValidForCreate(); // if it fails, ValidationException
                                                        // save the Post object into the database
                $idCurrentChampionship = $this->championshipMapper->save($championship);
                
                for ($i = 0; $i < count($_POST['categories']); $i ++) {
                    $this->categoryChampionshipMapper->save(new CategoryChampionship(NULL, $idCurrentChampionship, $_POST['categories'][$i]));
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
        
        // Devuelve las categorias para insertar en campeonato
        $categories = $this->categoryMapper->getCategorias();
        
        // Put the Post object visible to the view
        $this->view->setVariable("championship", $championship);
        $this->view->setVariable("categories", $categories);
        
        // render the view (/view/posts/add.php)
        $this->view->render("championship", "add");
    }
/**
 * Elimina un campeonato
 * @throws Exception Realizar acciones de campeonato requise ser admin
 */
    public function delete()
    {
        if (! isset($this->currentUser)) {
            throw new Exception("Not in session. delete championship requires admin");
        }
        
        if (isset($_POST['name_championship']) && isset($_POST['date_start_inscription']) && isset($_POST['date_end_inscription']) && isset($_POST['date_start_championship']) && isset($_POST['date_end_championship'])) {
            
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
/**
 * Lleva a la vista de editar un capeonato
 * @throws Exception Realizar acciones de campeonato requise ser admin
 */
    public function edit()
    {
        if (! isset($this->currentUser)) {
            throw new Exception("Not in session. edit championship requires sesion");
        }
        
        $categoriesCurrentChampionship = $this->championshipMapper->getCategorias($_REQUEST['id']);
        
        if (isset($_POST["fechaInicioInscripcion"])) {
            
            $championship = new Championship($_POST['id'], $_POST['fechaInicioInscripcion'], $_POST['fechaFinInscripcion'], $_POST['fechaInicioCampeonato'], $_POST['fechaFinCampeonato'], $_POST['nombreCampeonato']);
            
            $this->championshipMapper->edit($championship);
            
            // actualizar categorias del campeonato
            $this->editCategoriesChampionship($categoriesCurrentChampionship, $_POST['categories'], $_POST['id']);
            
            $this->view->setFlash("successfully modify");
            
            $this->view->redirect("championship", "showall");
        }
        
        // Devuelve los datos de un campeonato
        $championship = $this->championshipMapper->getDatos($_REQUEST['id']);
        
        // Devuelve las categorias para insertar en campeonato
        $categories = $this->categoryMapper->getCategorias();
        
        // Put the User object visible to the view
        $this->view->setVariable("championship", $championship);
        $this->view->setVariable("categories", $categories);
        
        $this->view->setVariable("categoriesCurrentChampionship", $categoriesCurrentChampionship);
        
        // render the view (/view/users/register.php)
        $this->view->render("championship", "edit");
    }
/**
 * Obtiene todos los champeonatos para los que se necesita generar grupos
 * @throws Exception Realizar acciones de campeonato requise ser admin
 */
    public function selectToCalendar()
    {
        if (! isset($this->currentUser)) {
            throw new Exception("Not in session. Check Confrontations requires login");
        }
        $campeonatos = $this->championshipMapper->getCampeonatosToGenerateGroups();
        
        $this->view->setVariable("campeonatos", $campeonatos);
        $this->view->render("championship", "selectToCalendar");
    }

    /**
     * Muestra los campeonatos que esta inscrito el usuario que esta logeado
     * @throws Exception Realizar acciones de campeonato requise ser admin
     */
    public function showallInscriptionCurrentUser()
    {
        if (! isset($this->currentUser)) {
            throw new Exception("Not in session. see inscription championship requires login");
        }
        
        $championships = $this->inscriptionUserChampionshipMapper->getInscriptionsCurrentUserInChampionship($this->currentUser->getLogin());
        
        // Put the User object visible to the view
        $this->view->setVariable("championships", $championships);
        
        // render the view (/view/users/register.php)
        $this->view->render("championship", "showallInscriptionCurrentUser");
    }

    /**
     * Borra la inscripcion a un campeonato
     * @throws Exception Realizar acciones de campeonato requise ser admin
     */
    public function deleteInscription()
    {
        if (! isset($this->currentUser)) {
            throw new Exception("Not in session. delete Inscription requires login");
        }
        
        if (isset($_POST['idCaptain']) && isset($_POST['idFellow']) && isset($_POST['level']) && isset($_POST['sex']) && isset($_POST['championship_name'])) {
            
            $this->inscriptionUserChampionshipMapper->delete($_POST['id']);
            
            $this->view->setFlash("successfully delete");
            
            $this->view->redirect("championship", "showallInscriptionCurrentUser");
        }
        
        $inscription = $this->inscriptionUserChampionshipMapper->getDatos($_REQUEST['id']);
        
        // Put the User object visible to the view
        $this->view->setVariable("inscription", $inscription);
        
        // render the view (/view/users/register.php)
        $this->view->render("championship", "deleteInscription");
    }


    /**
     * Muestra los campeonatos que estan inscritos los usuarios
     * @throws Exception Realizar acciones de campeonato requise ser admin
     */
    public function showallInscriptionAllUsers()
    {
        if (! isset($this->currentUser)) {
            throw new Exception("Not in session. see users inscriptions in championship requires admin");
        }
        
        $championships = $this->inscriptionUserChampionshipMapper->getAllInscriptionsInChampionship();
        
        // Put the User object visible to the view
        $this->view->setVariable("championships", $championships);
        
        // render the view (/view/users/register.php)
        $this->view->render("championship", "showallInscriptionAllUsers");
    }

    /*
     * Genera el calendario de un campeonato.
     * Recorre el conjunto de categorias de los campeonatos.
     * Para cada una crea grupos de entre 8 y 12 parejas
     * Luego, usando la lista de parejas se asignan N parejas a cada grupo
     */
    public function generateCalendar()
    {
        // $championshipMapper = new ChampionshipMapper();
        if (! isset($this->currentUser)) {
            throw new Exception("Not in session. Check Confrontations requires login");
        }
        if (isset($_REQUEST["id"])) {
            $campeonato = $this->championshipMapper->getCampeonato($_REQUEST["id"]);
            // TODO quitar esa condicion
            if ($campeonato->needGenerateCalendar() || 1) {
                switch ($campeonato->getFase()) {
                    case Fase::INSCRIPCION:
                        // Si está en fase de inscripcion se crean los grupos
                        $groupHasGenerated = $this->generateGroups($campeonato);
                        if ($groupHasGenerated)
                            $this->championshipMapper->updateFase($campeonato->getId(), Fase::GRUPOS);
                        // TODO añadir mensaje de retorno
                        break;
                    case Fase::GRUPOS:
                        // Se crean los cuartos
                        $grupos = $this->groupMapper->getGroupsFromChampionship($campeonato->getId());
                        $this->crearEnfrentamientosCuartos($grupos);
                        $this->championshipMapper->updateFase($campeonato->getId(), Fase::CUARTOS);
                        // TODO añadir mensaje de retorno
                        break;
                    case Fase::CUARTOS:
                        $grupos = $this->groupMapper->getGroupsFromChampionship($campeonato->getId());
                        $this->crearEnfrentamientosSemifinal($grupos);
                        $this->championshipMapper->updateFase($campeonato->getId(), Fase::SEMIFINAL);
                        // TODO añadir mensaje de retorno
                        break;
                    case Fase::SEMIFINAL:
                        $grupos = $this->groupMapper->getGroupsFromChampionship($campeonato->getId());
                        $this->crearEnfrentamientoFinal($grupos);
                        $this->championshipMapper->updateFase($campeonato->getId(), Fase::FINAL);
                        // TODO añadir mensaje de retorno
                        break;
                }
            } else {
                throw new Exception(i18n("Cannot generate groups from this championship"));
            }
        }
        $this->view->redirect("championship", "showall");
    }

    /**
     * Genera los grupos necesarios para un campeonato
     *
     * @param
     *            campeonato Campeonato a generar
     */
    private function generateGroups($campeonato)
    {
        $groupHasGenerated = false;
        $categoriasCampeonato = $this->categoryChampionshipMapper->getCategoriesFromChampionship($campeonato->getId());
        
        foreach ($categoriasCampeonato as $categoriaCampeonato) {
            $couples = $this->categoryChampionshipMapper->getCouples($categoriaCampeonato->getId());
            if (sizeof($couples) > 7) {
                $groupHasGenerated = true;
                $groupIds = $this->createGroups($couples, $categoriaCampeonato);
                $this->asignCouples($couples, $groupIds);
                $this->fillConfrontations($groupIds);
            }
        }
        return $groupHasGenerated;
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
/**
 * Rellena la tabla enfrentamientos generando todos los enfrentamientos necesarios
 * @param int $groupIds id de los grupos a rellenar
 */
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
/**
 * Modifica las categorias asociadas a un campeonato
 * @param Category[] $categoriesCurrentChampionship categorias del campeonato
 * @param Category[] $categoriesSeleted
 * @param int $idChampionship
 */
    private function editCategoriesChampionship($categoriesCurrentChampionship, $categoriesSeleted, $idChampionship)
    {
        $array_id_current = array();
        // para comparar necesitamos los id en este caso
        foreach ($categoriesCurrentChampionship as $value) {
            $array_id_current[] = $value->getId();
        }
        // Si no se han seleccionado las categorias existentes estas se borran
        for ($i = 0; $i < count($array_id_current); $i ++) {
            if (! in_array($array_id_current[$i], $categoriesSeleted)) {
                $this->categoryChampionshipMapper->delete($idChampionship, $array_id_current[$i]);
            }
        }
        
        $categoryChampionship = new CategoryChampionship();
        $categoryChampionship->setIdChampionship($_POST['id']);
        
        // Si no estan las categorias añadidas las añade
        for ($i = 0; $i < count($categoriesSeleted); $i ++) {
            if (! $this->categoryChampionshipMapper->existsCategory($idChampionship, $categoriesSeleted[$i])) {
                $categoryChampionship->setIdCategory($categoriesSeleted[$i]);
                $this->categoryChampionshipMapper->save($categoryChampionship);
            }
        }
    }

    /**
     * Calcula la clasificacion de un grupo
     *
     * @param int $idGrupo
     *            id del grupo a calcular
     * @return int[] id de las 8 parejas clasificadas, ordenadas de mejor clasificada a peor clasificada.
     */
    private function groupWinners($idGrupo)
    {
        $confrontationMapper = new confrontationMapper();
        // Recoge todos los id de las parejas que estan en el grupo seleccionado
        $partnergroupMapper = new PartnergroupMapper();
        $idParejas = $partnergroupMapper->getIdParejasGrupo($idGrupo);
        $array_idParejas = array();
        
        foreach ($idParejas as $id) {
            $array_idParejas[] = $id->getIdPartner();
        }
        
        $partnerMapper = new PartnerMapper();
        $partidos = $confrontationMapper->getPartidos($idGrupo);
        
        $array_partidos = array();
        
        // array multidimensional
        foreach ($partidos as $partido) {
            $array_partidos[] = array(
                $partido->getIdPartner1(), // 0
                $partido->getIdPartner2(), // 1
                $partido->getPointsPartner1(), // 2
                $partido->getPointsPartner2(), // 3
                $partido->getSetsPartner1(), // 4
                $partido->getSetsPartner2() // 5
            );
        }
        
        // array que contendra la clasificacion
        $array_clasificacion = array();
        $puntos = 0;
        $sets = 0;
        
        // recorrido por los valores de puntos y sets de cada pareja
        for ($i = 0; $i < count($array_idParejas); $i ++) {
            for ($j = 0; $j < count($array_partidos); $j ++) {
                if ($array_idParejas[$i] == $array_partidos[$j][0]) {
                    $puntos += $array_partidos[$j][2];
                    $sets += $array_partidos[$j][4];
                } else if ($array_idParejas[$i] == $array_partidos[$j][1]) {
                    $puntos += $array_partidos[$j][3];
                    $sets += $array_partidos[$j][5];
                }
            }
            $array_clasificacion[] = array(
                $array_idParejas[$i],
                $puntos,
                $sets
            );
            $puntos = 0;
            $sets = 0;
        }
        
        // ordenacion por puntos y sets
        $orden_puntos = array();
        $orden_sets = array();
        
        foreach ($array_clasificacion as $clave => $datos) {
            $orden_puntos[$clave] = $datos[1];
            $orden_sets[$clave] = $datos[2];
        }
        array_multisort($orden_puntos, $orden_sets, SORT_ASC, $array_clasificacion);
        
        $array_clasificacion = array_reverse($array_clasificacion);
        
        $array_winners = array();
        
        for ($i = 0; $i < 8; $i ++) {
            $array_winners[$i] = $array_clasificacion[$i][0];
        }
        
        // mandamos el valor de variable para que lo recoga la vista
        return $array_winners;
    }
/**
 * Guarda los enfrentamientos de la fase de cuartos
 * @param Group[] $grupos
 */
    private function crearEnfrentamientosCuartos($grupos)
    {
        foreach ($grupos as $grupo) {
            $ganadores = $this->groupWinners($grupo->getIdGroup());
            $enfrentamiento = new Confrontation(NULL, $ganadores[0], $ganadores[7], $grupo->getIdGroup(), Fase::CUARTOS);
            $this->confrontationMapper->save($enfrentamiento);
            $enfrentamiento = new Confrontation(NULL, $ganadores[1], $ganadores[6], $grupo->getIdGroup(), Fase::CUARTOS);
            $this->confrontationMapper->save($enfrentamiento);
            $enfrentamiento = new Confrontation(NULL, $ganadores[2], $ganadores[5], $grupo->getIdGroup(), Fase::CUARTOS);
            $this->confrontationMapper->save($enfrentamiento);
            $enfrentamiento = new Confrontation(NULL, $ganadores[3], $ganadores[4], $grupo->getIdGroup(), Fase::CUARTOS);
            $this->confrontationMapper->save($enfrentamiento);
        }
    }
    /**
     * Guarda los enfrentamientos de la fase de semifinal
     * @param Group[] $grupos
     */
    private function crearEnfrentamientosSemifinal($grupos)
    {
        foreach ($grupos as $grupo) {
            $partidos = $this->confrontationMapper->getPartidosPorFase($grupo->getIdGroup(), Fase::CUARTOS);
            $ganadores = array();
            foreach ($partidos as $partido) {
                $partido->getPointsPartner1() > $partido->getPointsPartner2() ? array_push($ganadores, $partido->getIdPartner1()) : array_push($ganadores, $partido->getIdPartner2());
            }
            
            $enfrentamiento = new Confrontation(NULL, $ganadores[0], $ganadores[1], $grupo->getIdGroup(), Fase::SEMIFINAL);
            $this->confrontationMapper->save($enfrentamiento);
            $enfrentamiento = new Confrontation(NULL, $ganadores[2], $ganadores[3], $grupo->getIdGroup(), Fase::SEMIFINAL);
            $this->confrontationMapper->save($enfrentamiento);
        }
    }
    /**
     * Guarda el enfrentamiento de la final
     *      * @param Group[] $grupos
     */
    private function crearEnfrentamientoFinal($grupos)
    {
        foreach ($grupos as $grupo) {
            $partidos = $this->confrontationMapper->getPartidosPorFase($grupo->getIdGroup(), Fase::SEMIFINAL);
            $ganadores = array();
            foreach ($partidos as $partido) {
                $partido->getPointsPartner1() > $partido->getPointsPartner2() ? array_push($ganadores, $partido->getIdPartner1()) : array_push($ganadores, $partido->getIdPartner2());
            }
            
            $enfrentamiento = new Confrontation(NULL, $ganadores[0], $ganadores[1], $grupo->getIdGroup(), Fase::FINAL);
            $this->confrontationMapper->save($enfrentamiento);
        }
    }
}
