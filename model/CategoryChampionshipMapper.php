<?php

require_once(__DIR__."/../core/PDOConnection.php");

class CategoryChampionshipMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	
	function getCategoriesFromChampionship($idChampionship){
		$stmt = $this->db->prepare("SELECT * FROM categoriasCampeonato WHERE idCampeonato = ? ");
		$stmt->execute(array($idChampionship));

		$toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$toret = array();

		foreach ($toret_db as $data) {
			array_push($toret, new CategoryChampionship($data["idCategoriasCampeonato"], $data["idCategoria"], $data["idCampeonato"]));
		}
		return $toret;
	}

	// Obtiene todas las parejas apuntadas a esa categoria
	function getCouples($idCategoryChampionship){
		$stmt = $this->db->prepare("SELECT * FROM pareja WHERE idCategoriaCampeonato = ? ");
		$stmt->execute(array($idCategoryChampionship));

		$toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$toret = array();

		foreach ($toret_db as $data) {
			array_push($toret, new Partner($data["idPareja"], $data["idCapitan"], $data["idCompañero"], $data["idCategoriaCampeonato"]));
		}
		return $toret;
	}
}
