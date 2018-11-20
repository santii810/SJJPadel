<?php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/CategoryChampionship.php");

class CategoryChampionshipMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}


	function getCategoriesFromChampionship($idChampionship){
		$stmt = $this->db->prepare("SELECT * FROM categoriascampeonato WHERE idCampeonato = ? ");
		$stmt->execute(array($idChampionship));

		$toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$toret = array();
		foreach ($toret_db as $data) {
			array_push($toret, new CategoryChampionship($data["idCategoriasCampeonato"], $data["idCampeonato"], $data["idCategoria"]));
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

	function getCategoryFromChampionship($idChampionship,$idCategory){
		$stmt = $this->db->prepare("SELECT * FROM categoriascampeonato
											 WHERE idCampeonato = ? AND
											 	   idCategoria = ? ");
		$stmt->execute(array($idChampionship,$idCategory));

		$toret_db = $stmt->fetch(PDO::FETCH_ASSOC);

		if($toret_db != null) {
			return new CategoryChampionship(
			$toret_db["idCategoriasCampeonato"],
			$toret_db["idCategoria"],
			$toret_db["idCampeonato"]
			);
		} else {
			return NULL;
		}
	}

	public function getChampionshipFromIdCategory($idCategoriaCampeonato){
		$stmt = $this->db->prepare("SELECT * FROM categoriascampeonato WHERE idCategoriasCampeonato = ? ");
		$stmt->execute(array($idCategoriaCampeonato));

		$data = $stmt->fetch(PDO::FETCH_ASSOC);

		return new CategoryChampionship($data["idCategoriasCampeonato"], $data["idCampeonato"], $data["idCategoria"]);
	}

}
