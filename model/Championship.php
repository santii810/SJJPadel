<?php
// file: model/Post.php

require_once(__DIR__."/../core/ValidationException.php");


class Championship {

	private $id;

	private $fechaInicioInscripcion;

	private $fechaFinInscripcion;

	private $fechaInicioCampeonato;

	private $fechaFinCampeonato;

	private $nombreCampeonato;
	
	public function __construct($id=NULL,$fechaInicioInscripcion=NULL, $fechaFinInscripcion=NULL,$fechaInicioCampeonato=NULL,$fechaFinCampeonato=NULL,$nombreCampeonato=NULL) {
		$this->id = $id;
		$this->fechaInicioInscripcion = $fechaInicioInscripcion;
		$this->fechaFinInscripcion = $fechaFinInscripcion;
		$this->fechaInicioCampeonato = $fechaInicioCampeonato;
		$this->fechaFinCampeonato = $fechaFinCampeonato;
		$this->nombreCampeonato = $nombreCampeonato;

	}

	public function getId() {
		return $this->id;
	}

	public function getFechaInicioInscripcion() {
		return $this->fechaInicioInscripcion;
	}

	public function setFechaInicioInscripcion($fecha) {
		$this->fechaInicioInscripcion = $fecha;
	}

	public function getFechaFinInscripcion() {
		return $this->fechaFinInscripcion;
	}

	public function setFechaFinInscripcion($fecha) {
		$this->fechaFinInscripcion = $fecha;
	}

	public function getFechaInicioCampeonato() {
		return $this->fechaInicioCampeonato;
	}

	public function setFechaInicioCampeonato($fecha) {
		$this->fechaInicioCampeonato = $fecha;
	}

	public function getFechaFinCampeonato() {
		return $this->fechaFinCampeonato;
	}

	public function setFechaFinCampeonato($fecha) {
		$this->fechaFinCampeonato = $fecha;
	}

	public function getNombreCampeonato() {
		return $this->nombreCampeonato;
	}

	public function setNombreCampeonato($nombre) {
		$this->nombreCampeonato = $nombre;
	}

	public function checkIsValidForCreate() {
		$errors = array();
		
		if (strlen(trim($this->fechaInicioInscripcion)) == 0 ) {
			$errors["fechaInicioInscripcion"] = "fecha inicio inscripcion is mandatory";
		}
		if (strlen(trim($this->fechaFinInscripcion)) == 0 ) {
			$errors["fechaFinInscripcion"] = "fecha fin inscripcion is mandatory";
		}
		if (strlen(trim($this->fechaInicioCampeonato)) == 0 ) {
			$errors["fechaInicioCampeonato"] = "fecha inicio campeonato is mandatory";
		}
		if (strlen(trim($this->fechaFinCampeonato)) == 0 ) {
			$errors["fechaFinCampeonato"] = "fecha fin campeonato is mandatory";
		}
		if (strlen(trim($this->nombreCampeonato)) == 0 ) {
			$errors["nombreCampeonato"] = "nombre del campeonato is mandatory";
		}
		if (sizeof($errors) > 0){
			throw new ValidationException($errors, "Championship is not valid");
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
			$errors["id"] = "id is mandatory";
		}

		try{
			$this->checkIsValidForCreate();
		}catch(ValidationException $ex) {
			foreach ($ex->getErrors() as $key=>$error) {
				$errors[$key] = $error;
			}
		}
		if (sizeof($errors) > 0) {
			throw new ValidationException($errors, "Championship is not valid");
		}
	}
}
