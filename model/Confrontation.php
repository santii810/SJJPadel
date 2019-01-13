<?php
// file: model/User.php
require_once (__DIR__ . "/../core/ValidationException.php");

/**
* Clase Confrontation
*
* Representa un enfrentamiento de un campeonato
* Contiene los atributos del objecto Confrontation
* 
*
*/


class Confrontation
{

    /**
    * Id del enfrentamiento
    * @var int
    */
    private $idConfrontation;

    /**
    * Id de la pareja 1
    * @var int
    */
    private $idPartner1;

    /**
    * Id de la pareja2
    * @var int
    */
    private $idPartner2;

    /**
    * Id del grupo
    * @var int
    */
    private $idGroup;

    /**
    * fase del enfrentamiento
    * @var string
    */
    private $phase;

    /**
    * fecha del enfrentamiento
    * @var date
    */
    private $date;

    /**
    * Hora del enfrentamiento
    * @var string
    */
    private $time;

    /**
    * puntos de la pareja1
    * @var int
    */
    private $pointsPartner1;

    /**
    * puntos de la pareja2
    * @var int
    */
    private $pointsPartner2;

    /**
    * sets de la pareja1
    * @var int
    */
    private $setsPartner1;

    /**
    * sets de la pareja2
    * @var int
    */
    private $setsPartner2;

    public function __construct($idConfrontation = NULL, $idPartner1 = NULL, $idPartner2 = NULL, $idGroup = NULL, $phase = NULL, $date = NULL, $time = NULL, $pointsPartner1 = NULL, $pointsPartner2 = NULL, $setsPartner1 = NULL, $setsPartner2 = NULL)
    {
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

    /**
    * Devuelve el id enfrentamiento
    *
    * @return int
    */
    public function getIdConfrontation()
    {
        return $this->idConfrontation;
    }

    /**
    * Devuelve el id de la pareja1
    *
    * @return int
    */
    public function getIdPartner1()
    {
        return $this->idPartner1;
    }

    /**
    * Cambia valor del idPartner1
    *
    * @return void
    */
    public function setIdPartner1($id)
    {
        $this->idPartner1 = $id;
    }

    /**
    * Devuelve el id de la pareja2
    *
    * @return int
    */
    public function getIdPartner2()
    {
        return $this->idPartner2;
    }

    /**
    * Cambia valor del idPartner2
    *
    * @return void
    */
    public function setIdPartner2($id)
    {
        $this->idPartner2 = $id;
    }

    /**
    * Devuelve el id del grupo
    *
    * @return int
    */
    public function getIdGroup()
    {
        return $this->idGroup;
    }

    /**
    * Cambia valor del idGrupo
    *
    * @return void
    */
    public function setIdGroup($id)
    {
        $this->idGroup = $id;
    }

    /**
    * Devuelve la fase
    *
    * @return string
    */
    public function getPhase()
    {
        return $this->phase;
    }

    /**
    * Cambia valor de la fase
    *
    * @return void
    */
    public function setPhase($id)
    {
        $this->phase = $phase;
    }

    /**
    * Devuelve la fecha
    *
    * @return date
    */
    public function getDate()
    {
        return $this->date;
    }

    /**
    * Cambia valor de la fecha
    *
    * @return void
    */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
    * Devuelve la hora
    *
    * @return string
    */
    public function getTime()
    {
        return $this->time;
    }

    /**
    * Cambia valor de la hora
    *
    * @return void
    */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
    * Devuelve los puntos de la pareja1
    *
    * @return int
    */
    public function getPointsPartner1()
    {
        return $this->pointsPartner1;
    }

    /**
    * Cambia valor de los puntos pareja1
    *
    * @return void
    */
    public function setPointsPartner1($points)
    {
        $this->pointsPartner1 = $points;
    }

    /**
    * Devuelve los puntos de la pareja2
    *
    * @return int
    */
    public function getPointsPartner2()
    {
        return $this->pointsPartner2;
    }

    /**
    * Cambia valor de los puntos pareja2
    *
    * @return void
    */
    public function setPointsPartner2($points)
    {
        $this->pointsPartner2 = $points;
    }

    /**
    * Devuelve los sets de la pareja1
    *
    * @return int
    */
    public function getSetsPartner1()
    {
        return $this->setsPartner1;
    }

    /**
    * Cambia valor de los sets pareja1
    *
    * @return void
    */
    public function setSetPartner1($sets)
    {
        $this->setsPartner1 = $sets;
    }

    /**
    * Devuelve los sets de la pareja2
    *
    * @return int
    */
    public function getSetsPartner2()
    {
        return $this->setsPartner2;
    }

    /**
    * Cambia valor de los sets pareja1
    *
    * @return void
    */
    public function setSetPartner2($sets)
    {
        $this->setsPartner2 = $sets;
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
    public function checkIsValidForRegister()
    {
        $errors = array();

        if (sizeof($errors) > 0) {
            throw new ValidationException($errors, "confrontation is not valid");
        }
    }

    /**
     * Devuelve los nombres de la pareja1
     *
     * 
     * @return Partner
     */
    public function getPartner1Names()
    {
        $partnerMapper = new PartnerMapper();
        return $partnerMapper->getPartnerNames($this->idPartner1);
    }

    /**
     * Devuelve los nombres de la pareja2
     *
     * 
     * @return Partner
     */
    public function getPartner2Names()
    {
        $partnerMapper = new PartnerMapper();
        return $partnerMapper->getPartnerNames($this->idPartner2);
    }
}
