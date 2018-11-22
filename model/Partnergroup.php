<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");


class PartnerGroup {

	private $idPartner;
	private $idGroup;	
	
	public function __construct($idPartner=NULL,$idGroup=NULL) {
		$this->idPartner = $idPartner;
		$this->idGroup = $idGroup;
	}

	public function getIdPartner() {
		return $this->idPartner;
	}

	public function setIdPartner($id) {
		$this->idPartner = $id;
	}

	public function getIdGroup() {
		return $this->idGroup;
	}

	public function setIdGroup($id) {
		$this->idGroup = $id;
	}

	public function checkIsValidForRegister() {
		$errors = array();
		if (strlen(trim($this->idPartner)) == 0 ) {
			$errors["idPartner"] = "idPartner is mandatory";
		}
		if (strlen(trim($this->idGroup)) == 0 ) {
			$errors["idGroup"] = "idGroup is mandatory";
		}

		if (sizeof($errors)>0){
			throw new ValidationException($errors, "GroupPartner is not valid");
		}
	}
}
