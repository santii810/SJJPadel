<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

class Confrontation {

	private $idConfrontation;
	private $idPartner1;
	private $idPartner2;
	private $idGroup;
	private $phase;
	private $date;
	private $time;
	private $pointsPartner1;
	private $pointsPartner2;
	private $setsPartner1;
	private $setsPartner2;
	
	public function __construct($idConfrontation=NULL,$idPartner1=NULL,$idPartner2=NULL,$idGroup=NULL,$phase=NULL,$date=NULL,$time=NULL,$pointsPartner1=NULL,$pointsPartner2=NULL,$setsPartner1=NULL,$setsPartner2=NULL) {
		$this->idConfrontation = $idConfrontation;
		$this->idPartner1 = $idPartner1;
		$this->idPartner2 = $idPartner2;
		$this->idGroup = $idGroup;
		$this->phase = $phase;
		$this->date = $date;
		$this->time = $time;
		$this->pointsPartner1 = $pointsPartner1;
		$this->pointsPartner2 = $pointsPartner2;
		$this->setsPartner1 = $setsPartner1;
		$this->setsPartner2 = $setsPartner2;
	}

	public function getIdConfrontation() {
		return $this->idConfrontation;
	}

	public function getIdPartner1() {
		return $this->idPartner1;
	}

	public function setIdPartner1($id) {
		$this->idPartner1 = $id;
	}

	public function getIdPartner2() {
		return $this->idPartner2;
	}

	public function setIdPartner2($id) {
		$this->idPartner2 = $id;
	}

	public function getIdGroup() {
		return $this->idGroup;
	}

	public function setIdGroup($id) {
		$this->idGroup = $id;
	}

	public function getPhase() {
		return $this->phase;
	}

	public function setPhase($id) {
		$this->phase = $phase;
	}

	public function getDate() {
		return $this->date;
	}

	public function setDate($date) {
		$this->date = $date;
	}

	public function getTime() {
		return $this->time;
	}

	public function setTime($time) {
		$this->time = $time;
	}

	public function getPointsPartner1() {
		return $this->pointsPartner1;
	}

	public function setPointsPartner1($points) {
		$this->pointsPartner1 = $points;
	}

	public function getPointsPartner2() {
		return $this->pointsPartner2;
	}

	public function setPointsPartner2($points) {
		$this->pointsPartner2 = $points;
	}

	public function getSetsPartner1() {
		return $this->setsPartner1;
	}

	public function setSetPartner1($sets) {
		$this->setsPartner1 = $sets;
	}

	public function getSetsPartner2() {
		return $this->setsPartner2;
	}

	public function setSetPartner2($sets) {
		$this->setsPartner2 = $sets;
	}

	public function checkIsValidForRegister() {
		$errors = array();
		
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "confrontation is not valid");
		}
	}

	public function getPartner1Names(){
		$partnerMapper = new PartnerMapper();
		return $partnerMapper->getPartnerNames($this->idPartner1);
	}
	
	public function getPartner2Names(){
		$partnerMapper = new PartnerMapper();
		return $partnerMapper->getPartnerNames($this->idPartner2);
	}
	
}
