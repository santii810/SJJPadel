<?php

require_once (__DIR__ . "/../core/ValidationException.php");

/**
* Clase ParticipantsMatch
*
* Representa los participanted de un partido
* Contiene los atributos del objecto participantes
* 
*
*/
class ParticipantsMatch
{

    /**
    * Id de los participantes
    * @var int
    */
    private $idParticipantesPartido;

    /**
    * Id del partido organizado
    * @var int
    */
    private $idOrganizarPartido;

    /**
    * login del usuario 
    * @var int
    */
    private $loginUsuario;

    public function __construct($idParticipantesPartido = NULL, $idOrganizarPartido = NULL, $loginUsuario = NULL)
    {
        $this->idParticipantesPartido = $idParticipantesPartido;
        $this->idOrganizarPartido = $idOrganizarPartido;
        $this->loginUsuario = $loginUsuario;
    }

    public function getIdParticipantesPartido()
    {
        return $this->idParticipantesPartido;
    }

    public function setIdParticipantesPartido($idParticipantesPartido)
    {
        $this->idParticipantesPartido = $idParticipantesPartido;
    }

    public function getIdOrganizarPartido()
    {
        return $this->idOrganizarPartido;
    }

    public function setIdOrganizarPartido($idOrganizarPartido)
    {
        $this->idOrganizarPartido = $idOrganizarPartido;
    }

    public function getLoginUsuario()
    {
        return $this->loginUsuario;
    }

    public function setLoginUsuario($loginUsuario)
    {
        $this->loginUsuario = $loginUsuario;
    }

    /**
    * Comprueba si la instancia actual es válida
    * Por estar actualizado en la base de datos.
    *
    * @throws ValidationException si la instancia es
    * no es válido
    *
    * @return void
    */
    public function checkIsValidForCreate()
    {
        $errors = array();
        /*
         * if ($this->idParticipantesPartido >= 0 ) {
         * $errors["idParticipantesPartido"] = "Id Participantes Partido is mandatory";
         * }
         * if ($this->idOrganizarPartido >= 0 ) {
         * $errors["idOrganizarPartido"] = "Id Organizar Partido is mandatory";
         * }
         */
        if (strlen(trim($this->loginUsuario)) == 0) {
            $errors["loginUsuario"] = "User Login is mandatory";
        }
        if (sizeof($errors) > 0) {
            throw new ValidationException($errors, "Organize Match Incorrect");
        }
    }
}
