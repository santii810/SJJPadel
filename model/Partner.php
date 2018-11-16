<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

/**
* Class User
*
* Represents a User in the blog
*
* @author lipido <lipido@gmail.com>
*/
class Partner {

	private $idPartner;
	private $idCaptain;	
	private $idFellow;
	private $idCategoryChampionship;
	
	public function __construct($idPartner=NULL,$idCaptain=NULL,$idFellow=NULL,$idCategoryChampionship=NULL) {
		$this->idPartner = $idPartner;
		$this->idCaptain = $idCaptain;
		$this->idFellow = $idFellow;
		$this->idCategoryChampionship = $idCategoryChampionship;
	}

	public function getIdPartner() {
		return $this->idPartner;
	}

	public function getIdCaptain() {
		return $this->idCaptain;
	}

	public function setIdCaptain($id) {
		$this->idCaptain = $id;
	}

	public function getIdFellow() {
		return $this->idFellow ;
	}

	public function setIdFellow($id) {
		$this->idFellow = $id;
	}

	public function getIdCategoryChampionship() {
		return $this->idCategoryChampionship;
	}

	public function setIdCategoryChampionship($id) {
		$this->idCategoryChampionship = $id;
	}

	public function checkIsValidForRegister() {
		$errors = array();
		if (strlen(trim($this->idCaptain)) == 0 ) {
			$errors["idCaptain"] = "idCaptain is mandatory";
		}
		if (strlen(trim($this->idFellow)) == 0 ) {
			$errors["idFellow"] = "idFellow is mandatory";
		}
		if (strlen(trim($this->idCategoryChampionship)) == 0 ) {
			$errors["idCategoryChampionship"] = "idCategoryChampionship is mandatory";
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "user is not valid");
		}
	}
}
