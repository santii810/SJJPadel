<?php

require_once(__DIR__."/../core/ValidationException.php");

class CategoryChampionship {

	private $id;
	private $idChampionship;
	private $idCategory;
	
	public function __construct($id,$idChampionship, $idCategory) {
		$this->id = $id;
		$this->idChampionship = $idChampionship;
		$this->idCategory = $idCategory;
	}

    function getId() {
        return $this->id;
    }

    function getIdChampionship() {
        return $this->idChampionship;
    }

    function getIdCategory() {
        return $this->idCategory;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdChampionship($idChampionship) {
        $this->idChampionship = $idChampionship;
    }

    function setIdCategory($idCategory) {
        $this->idCategory = $idCategory;
    }


}
