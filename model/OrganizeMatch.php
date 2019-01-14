<?php

require_once (__DIR__ . "/../core/ValidationException.php");


/**
* Clase OrganizeMatch
*
* Representa los partidos organizados
* Contiene los atributos del objecto OrganizeMatch
* 
*
*/
class OrganizeMatch
{
    /**
    * Id del partido organizado
    * @var int
    */
    private $idOrganizarPartido;

    /**
    * fecha del partido organizado
    * @var date
    */
    private $fecha;

    /**
    * hora del partido organizado
    * @var string
    */
    private $hora;

    /**
    * participantes del partido organizado
    * @var mixed
    */
    private $participants;

    /**
    * número participantes del partido organizado
    * @var int
    */
    private $numParticipants;

    public function __construct($idOrganizeMatch = NULL, $fecha = NULL, $hora = NULL, array $participants = NULL, $numParticipants = NULL)
    {
        $this->idOrganizarPartido = $idOrganizeMatch;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->participants = $participants;
        $this->numParticipants = $numParticipants;
    }

    public function getIdOrganizarPartido()
    {
        return $this->idOrganizarPartido;
    }

    public function setIdOrganizarPartido($idOrganizarPartido)
    {
        $this->idOrganizarPartido = $idOrganizarPartido;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getHora()
    {
        return $this->hora;
    }

    public function setHora($hora)
    {
        $this->hora = $hora;
    }

    public function getParticipants()
    {
        return $this->participants;
    }

    public function setParticipants($participants)
    {
        $this->participants = $participants;
    }

    public function getNumParticipants()
    {
        return $this->numParticipants;
    }

    public function setNumParticipants($numParticipants)
    {
        $this->numParticipants = $numParticipants;
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
        $fecha_actual = new DateTime(date('Y-m-d'));
        
        $errors = array();
        /*
         * if ($fecha_actual > $this->getFecha() ) {
         * $errors["dateIncorrect"] = "Date is not valid";
         * }
         */
        if ($this->getFecha() == '0000-00-00') {
            $errors["emptyDate"] = "date is mandatory";
        }
        /*
         * if (strlen(trim($this->idCategory)) == 0 ) {
         * $errors["idCategory"] = "idCategory is mandatory";
         * }
         */
        if (sizeof($errors) > 0) {
            throw new ValidationException($errors, "Organize Match Incorrect");
        }
    }
}
