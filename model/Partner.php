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
	private $idCategory;
	
	public function __construct($idPartner=NULL,$idCaptain=NULL,$idFellow=NULL,$idCategory=NULL) {
		$this->idPartner = $idPartner;
		$this->idCaptain = $idCaptain;
		$this->idFellow = $idFellow;
		$this->idCategory = $idCategory;
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

	public function getIdCategory() {
		return $this->idCategory;
	}

	public function setIdCategory($id) {
		$this->idCategory = $id;
	}

	public function checkIsValidForRegister() {
		$errors = array();
		if (strlen(trim($this->idCaptain)) == 0 ) {
			$errors["idCaptain"] = "idCaptain is mandatory";
		}
		if (strlen(trim($this->idFellow)) == 0 ) {
			$errors["idFellow"] = "idFellow is mandatory";
		}
		if (strlen(trim($this->idCategory)) == 0 ) {
			$errors["idCategory"] = "idCategory is mandatory";
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "user is not valid");
		}
	}
}
