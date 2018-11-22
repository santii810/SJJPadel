<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");


class ParticipantsMatch {

	private $idParticipantesPartido;
  private $idOrganizarPartido;
  private $loginUsuario;

	public function __construct($idParticipantesPartido=NULL, $idOrganizarPartido=NULL, $loginUsuario=NULL) {
    $this->idParticipantesPartido = $idParticipantesPartido;
		$this->idOrganizarPartido = $idOrganizarPartido;
		$this->loginUsuario = $loginUsuario;
	}

  public function getIdParticipantesPartido() {
    return $this->idParticipantesPartido;
  }

  public function setIdParticipantesPartido($idParticipantesPartido) {
    $this->idParticipantesPartido = $idParticipantesPartido;
  }

	public function getIdOrganizarPartido() {
		return $this->idOrganizarPartido;
	}

  public function setIdOrganizarPartido($idOrganizarPartido) {
    $this->idOrganizarPartido = $idOrganizarPartido;
  }

	public function getLoginUsuario() {
		return $this->loginUsuario;
	}

	public function setLoginUsuario($loginUsuario) {
		$this->loginUsuario = $loginUsuario;
	}

	public function checkIsValidForCreate() {

		$errors = array();
		/*if ($this->idParticipantesPartido >= 0 ) {
			$errors["idParticipantesPartido"] = "Id Participantes Partido is mandatory";
		}
		if ($this->idOrganizarPartido >= 0 ) {
			$errors["idOrganizarPartido"] = "Id Organizar Partido is mandatory";
		}*/
		if (strlen(trim($this->loginUsuario)) == 0 ) {
			$errors["loginUsuario"] = "User Login is mandatory";
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "Organize Match Incorrect");
		}
	}
}
