<?php
// file: model/PostMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Championship.php");
require_once(__DIR__."/../model/Group.php");
require_once(__DIR__."/../model/Category.php");

/**
* Class PostMapper
*
* Database interface for Post entities
*
* @author lipido <lipido@gmail.com>
*/
class ChampionshipMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function save($championship) {
		$stmt = $this->db->prepare("INSERT INTO campeonato(fechaInicioInscripcion, fechaFinInscripcion, fechaInicioCampeonato, fechaFinCampeonato, nombreCampeonato) values (?,?,?,?,?)");
		$stmt->execute(array($championship->getFechaInicioInscripcion(), $championship->getFechaFinInscripcion(),$championship->getFechaInicioCampeonato(),$championship->getFechaFinCampeonato(), $championship->getNombreCampeonato()));
		return $this->db->lastInsertId();
	}

	//prueba objectos
	public function getCampeonatos(){
		$stmt = $this->db->query("SELECT *
			FROM campeonato");
		$toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$championships = array();

		foreach ($toret_db as $championship) {
			array_push($championships, new Championship(
				$championship["idCampeonato"],
				$championship["fechaInicioInscripcion"],
				$championship["fechaFinInscripcion"],
				$championship["fechaInicioCampeonato"],
				$championship["fechaFinCampeonato"],
				$championship["nombreCampeonato"]));
		}
		return $championships;
	}

	//Retorna campeonatos ya en curso
	public function getCampeonatosInProgress(){
		$stmt = $this->db->query("SELECT * FROM campeonato where fechaInicioCampeonato < curdate()");
		$toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$championships = array();

		foreach ($toret_db as $championship) {
			array_push($championships, new Championship(
				$championship["idCampeonato"],
				$championship["fechaInicioInscripcion"],
				$championship["fechaFinInscripcion"],
				$championship["fechaInicioCampeonato"],
				$championship["fechaFinCampeonato"],
				$championship["nombreCampeonato"]));
		}
		return $championships;
	}

	// devuelve una lista de campeonatos con la fecha de incripcion finalziada y que no tengan grupos ya creados
	public function getCampeonatosToGenerateGroups(){
		$stmt = $this->db->query("SELECT * FROM campeonato where fechaFinInscripcion <= curdate() and (Select count(idCampeonato) from grupo where campeonato.idCampeonato = grupo.idCampeonato ) = 0");
		$toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$championships = array();

		foreach ($toret_db as $championship) {
			array_push($championships, new Championship(
				$championship["idCampeonato"],
				$championship["fechaInicioInscripcion"],
				$championship["fechaFinInscripcion"],
				$championship["fechaInicioCampeonato"],
				$championship["fechaFinCampeonato"],
				$championship["nombreCampeonato"]));
		}

		return $championships;

	}

		//prueba objectos
	public function getCampeonatosParaIncripcion(){
		$stmt = $this->db->query("SELECT * FROM campeonato where fechaInicioInscripcion <= curdate() and fechaFinInscripcion >= curdate()");
		$toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$championships = array();

		foreach ($toret_db as $championship) {
			array_push($championships, new Championship(
				$championship["idCampeonato"],
				$championship["fechaInicioInscripcion"],
				$championship["fechaFinInscripcion"],
				$championship["fechaInicioCampeonato"],
				$championship["fechaFinCampeonato"],
				$championship["nombreCampeonato"]));
		}

		return $championships;

	}

	public function getCategorias($idCampeonato) {
		$stmt = $this->db->prepare("SELECT cam.nombreCampeonato,cat.nivel,cat.sexo,catc.idCategoria,cam.idCampeonato,catc.idCategoriasCampeonato
			FROM campeonato cam,categoriascampeonato catc, categoria cat
			WHERE cam.idCampeonato = catc.idCampeonato AND
			catc.idCategoria = cat.idCategoria AND
			cam.idCampeonato = ?
			ORDER BY idCategoria");
		$stmt->execute(array($idCampeonato));

		$toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$categories = array();

		foreach ($toret_db as $category) {
			array_push($categories, new Category(
				$category["idCategoria"],
				$category["nivel"],
				$category["sexo"]
			));
		}

		return $categories;
	}



	public function getGrupos($idCampeonato,$idCategoria) {
		$stmt = $this->db->prepare("SELECT g.idGrupo,g.nombreGrupo,g.idCategoria,g.idCampeonato
			FROM campeonato cam,grupo g,categoria c
			WHERE cam.idCampeonato = g.idCampeonato AND
			c.idCategoria = g.idCategoria AND
			cam.idCampeonato = ? AND
			c.idCategoria = ? ");
		$stmt->execute(array($idCampeonato,$idCategoria));

		$toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$groups = array();

		foreach ($toret_db as $group) {
			array_push($groups, new Group(
				$group["idGrupo"],
				$group["idCategoria"],
				$group["idCampeonato"],
				$group["nombreGrupo"]
			));
		}

		return $groups;
	}


	public function getNombreCampeonato($idCampeonato){
		$stmt = $this->db->prepare("SELECT nombreCampeonato FROM campeonato WHERE idCampeonato = ? AND fechaInicioCampeonato <= curdate() AND fechaFinCampeonato >= curdate()");
		$stmt->execute(array($idCampeonato));
		$toret_db = $stmt->fetch(PDO::FETCH_ASSOC);

		if($toret_db != null ){
			return $toret_db["nombreCampeonato"];
		}
	}

	public function validateHour($idChampionship, $fechaOffer){
		$stmt = $this->db->prepare("SELECT COUNT(*) as count FROM campeonato WHERE idCampeonato = ? AND fechaInicioCampeonato <= ? AND fechaFinCampeonato >= ? AND ? > curdate()");
		$stmt->execute(array($idCampeonato, $fechaOffer, $fechaOffer, $fechaOffer));
		$toret_db = $stmt->fetch(PDO::FETCH_ASSOC);

		if($toret_db["count"] == 1){
			return true;
		}
		else{
			return false;
		}

	}
}
