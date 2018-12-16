<?php

require_once(__DIR__."/../core/ValidationException.php");


class InscriptionUserChampionship {

	private $idPartner;

	private $idCaptain;

	private $idFellow;

	private $level;

	private $sex;

	private $nameChampionship;
	
	public function __construct($idPartner=NULL, $idCaptain=NULL, $idFellow=NULL, $level=NULL, $sex=NULL, $nameChampionship=NULL) {
		$this->idPartner = $idPartner;
		$this->idCaptain = $idCaptain;
		$this->idFellow = $idFellow;
		$this->level = $level;
		$this->sex = $sex;
		$this->nameChampionship = $nameChampionship;
	}

	public function setIdPartner($id) {
		$this->idPartner = $id;
	}

	public function getIdPartner() {
		return $this->idPartner;
	}

	public function setIdCaptain($id) {
		$this->idCaptain = $id;
	}

	public function getIdCaptain() {
		return $this->idCaptain;
	}

	public function setIdFellow($id) {
		$this->idFellow = $id;
	}

	public function getIdFellow() {
		return $this->idFellow;
	}

	public function setLevel($level) {
		$this->level = $level;
	}

	public function getLevel() {
		return $this->level;
	}

	public function setSex($sex) {
		$this->sex = $sex;
	}

	public function getSex() {
		return $this->sex;
	}

	public function setNameChampionship($name) {
		$this->nameChampionship = $name;
	}

	public function getNameChampionship() {
		return $this->nameChampionship;
	}

	public function checkIsValidForCreate() {
		$errors = array();
		
		if (strlen(trim($this->idCaptain)) == 0 ) {
			$errors["idCaptain"] = "idCaptain is mandatory";
		}
		
		if (strlen(trim($this->idFellow)) == 0 ) {
			$errors["idFellow"] = "idFellow is mandatory";
		}

		if (strlen(trim($this->level)) == 0 ) {
			$errors["level"] = "level is mandatory";
		}

		if (strlen(trim($this->sex)) == 0 ) {
			$errors["sex"] = "sex is mandatory";
		}

		if (strlen(trim($this->nameChampionship)) == 0 ) {
			$errors["nameChampionship"] = "nameChampionship is mandatory";
		}

		if (sizeof($errors) > 0){
			throw new ValidationException($errors, "Inscription current user is not valid");
		}
	}

	/**
	* Checks if the current instance is valid
	* for being updated in the database.
	*
	* @throws ValidationException if the instance is
	* not valid
	*
	* @return void
	*/
	public function checkIsValidForUpdate() {
		$errors = array();

		if (!isset($this->id)) {
			$errors["idCaptain"] = "id is mandatory";
		}

		try{
			$this->checkIsValidForCreate();
		}catch(ValidationException $ex) {
			foreach ($ex->getErrors() as $key=>$error) {
				$errors[$key] = $error;
			}
		}
		if (sizeof($errors) > 0) {
			throw new ValidationException($errors, "Inscription current user is not valid");
		}
	}
}
