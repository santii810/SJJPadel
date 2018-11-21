<?php

require_once(__DIR__."/../core/ValidationException.php");

/**
* Class ConfrontationOffer
*
* Represents a ConfrontationOffer in the app
*
*/
class ConfrontationOffer {

  	private $idOfertaEnfrentamiento;
	private $idPareja;
	private $idGrupo;
	private $hora;
  	private $fecha;
    private $pareja;

	public function __construct($idOfertaEnfrentamiento=NULL, $idPareja=NULL, $idGrupo=NULL, $hora=NULL, $fecha=NULL, array $pareja=NULL) {
    $this->idOfertaEnfrentamiento = $idOfertaEnfrentamiento;
	  $this->idPareja = $idPareja;
	  $this->idGrupo = $idGrupo;
	  $this->hora = $hora;
    $this->fecha = $fecha;
    $this->pareja = $pareja;
	}

	public function getIdOfertaEnfrentamiento() {
		return $this->idOfertaEnfrentamiento;
	}

  public function setIdOfertaEnfrentamiento($idOfertaEnfrentamiento) {
    $this->idOfertaEnfrentamiento = $idOfertaEnfrentamiento;
  }

  public function getIdPareja(){
    return $this->idPareja;
  }

  public function setIdPareja($idPareja){
    $this->idPareja = $idPareja;
  }

    public function getIdGrupo(){
    return $this->idGrupo;
  }

  public function setIdGrupo($idGrupo){
    $this->idGrupo = $idGrupo;
  }


  public function getHora() {
    return $this->hora;
  }

  public function setHora($hora) {
    $this->hora = $hora;
  }

	public function getFecha() {
		return $this->fecha;
	}

	public function setFecha($fecha) {
		$this->fecha = $fecha;
	}

  public function getPareja(){
    return $this->pareja;
  }

  public function setPareja($pareja){
    $this->pareja = $pareja;
  }

	public function checkIsValidForCreate() {

		$errors = array();
    /*
		if ($fecha_actual > $this->getFecha() ) {
			$errors["dateIncorrect"] = "Date is not valid";
		}
		if ($this->getFecha() == '0000-00-00') {
			$errors["emptyDate"] = "date is mandatory";
		}
		if (strlen(trim($this->idCategory)) == 0 ) {
			$errors["idCategory"] = "idCategory is mandatory";
		}
    */
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "Organize Match Incorrect");
		}
	}
}
