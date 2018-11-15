<?php
//file: controller/PostController.php
require_once(__DIR__."/../model/Confrontation.php");
require_once(__DIR__."/../model/ConfrontationMapper.php");
require_once(__DIR__."/../model/ChampionshipMapper.php");
require_once(__DIR__."/../model/PartnerMapper.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/PartnergroupMapper.php");
require_once(__DIR__."/../model/Partnergroup.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

/**
* Class PostsController
*
* Controller to make a CRUDL of Posts entities
*
* @author lipido <lipido@gmail.com>
*/
class ConfrontationController extends BaseController {

	private $confrontationMapper;

	public function __construct() {
		parent::__construct();

		$this->confrontationMapper = new ConfrontationMapper();
	}

	public function selectClasification() {
		if (!isset($this->currentUser) && ( $this->currentRol == 'a' || $this->currentRol == 'e' || $this->currentRol == 'd' ) ) {
			throw new Exception("Not in session. select Championship requires login");
		}
			
		if (isset($_POST["idCategoria"]) && isset($_POST["idCampeonato"]) && isset($_POST["idGrupo"])) {
			
			//$queryString = "idCampeonato=".$_POST['idCampeonato']."&idCategoria=".$_POST['idCategoria']."&idGrupo=".$_POST['idGrupo'];
			
			$queryString = "idGrupo=".$_POST['idGrupo'];

			$this->view->redirect("confrontation", "clasification", $queryString );

		}

		$championship = new ChampionshipMapper();
		//todos los campeonatos
		$campeonatos = $championship->getCampeonatos();

		//mandamos el valor de variable para que lo recoga la vista
		$this->view->setVariable("campeonatos",$campeonatos);

		// render the view (/view/posts/add.php)
		$this->view->render("confrontation", "selectclasification");

	}

	public function clasification() {
		if (!isset($this->currentUser) && ( $this->currentRol == 'a' || $this->currentRol == 'e' || $this->currentRol == 'd' ) ) {
			throw new Exception("Not in session. select Championship requires login");
		}
		$confrontationMapper = new confrontationMapper();
		$idGrupo = '';

		if (isset($_REQUEST['idGrupo'])) {
			$idGrupo = $_REQUEST['idGrupo'];
		}

		if (isset($_POST["setsPareja1"])) {
			
            

		}
		//Recoge todos los id de las parejas que estan en el grupo seleccionado
		$partnergroupMapper = new PartnergroupMapper();
		$idParejas = $partnergroupMapper->getIdParejasGrupo($idGrupo);
		$array_idParejas = array();
		foreach ($idParejas as $id) {
			$array_idParejas[] = $id->getIdPartner();
		}

		$partnerMapper = new PartnerMapper();
		$partidos = $confrontationMapper->getPartidos($idGrupo);
		$array_partidos = array();
		
		//array multidimensional
		foreach ($partidos as $partido) {
			$array_partidos[] = array( $partido->getIdPartner1(),//0
									   $partido->getIdPartner2(),//1
									   $partido->getPointsPartner1(),//2
									   $partido->getPointsPartner2(),//3
									   $partido->getSetsPartner1(),//4
									   $partido->getSetsPartner2()//5
									);
			
		}

		//array que contendra la clasificacion 
		$array_clasificacion = array();
		$puntos = 0;
		$sets = 0;

		//recorrido por los valores de puntos y sets de cada pareja
		for ($i=0; $i < count($array_idParejas); $i++) { 
			for ($j=0; $j < count($array_partidos); $j++) { 
				if ( $array_idParejas[$i] == $array_partidos[$j][0] ) {
					$puntos += $array_partidos[$j][2];
					$sets += $array_partidos[$j][4]; 
				} else if ( $array_idParejas[$i] == $array_partidos[$j][1] ){
					$puntos += $array_partidos[$j][3];
					$sets += $array_partidos[$j][5];
				}
			}
			$array_clasificacion[] = array( $array_idParejas[$i],
											$puntos,
											$sets
										  );
			$puntos = 0;
			$sets = 0;
		}

		//ordenacion por puntos y sets
		$orden_puntos = array();
		$orden_sets = array();
		
		foreach ($array_clasificacion as $clave=>$datos){
			$orden_puntos[$clave] = $datos[1];
			$orden_sets[$clave] = $datos[2];
		}
		array_multisort($orden_puntos, $orden_sets, SORT_ASC, $array_clasificacion);

		$parejas = $partnerMapper->getParejas();
		
		//todos los partidos sin los resultados
		//$partidos = $confrontationMapper->getPartidosResultadoNull($idGrupo);
		
		//mandamos el valor de variable para que lo recoga la vista
		$this->view->setVariable("clasificacion",array_reverse($array_clasificacion));
		$this->view->setVariable("idGrupo",$idGrupo);
		$this->view->setVariable("parejas",$parejas);
		// render the view (/view/posts/add.php)
		$this->view->render("confrontation", "clasification");

	}

	public function select() {
		if (!isset($this->currentUser) && ( $this->currentRol == 'a' ) ) {
			throw new Exception("Not in session. select Championship requires login");
		}
			
		if (isset($_POST["idCategoria"]) && isset($_POST["idCampeonato"]) && isset($_POST["idGrupo"])) {
			
			//$queryString = "idCampeonato=".$_POST['idCampeonato']."&idCategoria=".$_POST['idCategoria']."&idGrupo=".$_POST['idGrupo'];
			
			$queryString = "idGrupo=".$_POST['idGrupo'];

			$this->view->redirect("confrontation", "setresults", $queryString );

		}

		$championship = new ChampionshipMapper();
		//todos los campeonatos
		$campeonatos = $championship->getCampeonatosInProgress();

		//mandamos el valor de variable para que lo recoga la vista
		$this->view->setVariable("campeonatos",$campeonatos);

		// render the view (/view/posts/add.php)
		$this->view->render("confrontation", "selectmatches");

	}



	public function setresults() {
		if (!isset($this->currentUser) && ( $this->currentRol == 'a' ) ) {
			throw new Exception("Not in session. select Championship requires login");
		}
		$confrontationMapper = new confrontationMapper();
		$idGrupo = '';

		if (isset($_REQUEST['idGrupo'])) {
			$idGrupo = $_REQUEST['idGrupo'];
		}

		if (isset($_POST["setsPareja1"])) {
			
            for ($i=0; $i < count($_POST['idEnfrentamiento']); $i++) { 
            	if($_POST['setsPareja1'][$i] != '' && $_POST['setsPareja2'][$i] != ''){
            		$setsP1 = $_POST['setsPareja1'][$i];
            		$setsP2 = $_POST['setsPareja2'][$i];

            		if ( ($setsP1 <= 3 || $setsP2 <= 3) && (($setsP1 + $setsP2) <= 5) && ($setsP1 != $setsP2) ) {
            			
            			if ($setsP1 > $setsP2) {
            				$puntosP1 = 3;
            				$puntosP2 = 1;
            			}
            			else{
            				$puntosP1 = 1;
            				$puntosP2 = 3;
            			}

            			//actualiza los resultados recogidos
            			$confrontationMapper->actualizarResultados($_POST['idEnfrentamiento'][$i],$puntosP1,$puntosP2,$setsP1,$setsP2); 
            		}
            	}
            }

		}
		$partnerMapper = new PartnerMapper();
		$parejas = $partnerMapper->getParejas();
		
		//todos los partidos sin los resultados
		$partidos = $confrontationMapper->getPartidosResultadoNull($idGrupo);
		
		//mandamos el valor de variable para que lo recoga la vista
		$this->view->setVariable("partidos",$partidos);
		$this->view->setVariable("idGrupo",$idGrupo);
		$this->view->setVariable("parejas",$parejas);
		// render the view (/view/posts/add.php)
		$this->view->render("confrontation", "setresults");

	}

}
