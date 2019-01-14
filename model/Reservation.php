<?php
// file: model/Reservation.php
require_once (__DIR__ . "/../core/ValidationException.php");

/**
* Clase Reservation
*
* Representa las reservas de pista
* Contiene los atributos del objecto Reserva
* 
*
*/
class Reservation
{

    /**
    * Id de la reserva
    * @var int
    */
    private $idReservation;

    /**
    * Id del usuario que reserva
    * @var int
    */
    private $idUserReservation;

    /**
    * fecha de la reserva
    * @var date
    */
    private $dateReservation;

    /**
    * hora de la reserva de la reserva
    * @var string
    */
    private $hourReservation;

    function __construct($idReservation = NULL, $idUserReservation = NULL, $dateReservation = NULL, $hourReservation = NULL)
    {
        $this->idReservation = $idReservation;
        $this->idUserReservation = $idUserReservation;
        $this->dateReservation = $dateReservation;
        $this->hourReservation = $hourReservation;
    }

    function getIdReservation()
    {
        return $this->idReservation;
    }

    function getIdUserReservation()
    {
        return $this->idUserReservation;
    }

    function getDateReservation()
    {
        return $this->dateReservation;
    }

    function getHourReservation()
    {
        return $this->hourReservation;
    }

    function setIdReservation($idReservation)
    {
        $this->idReservation = $idReservation;
    }

    function setIdUserReservation($idUserReservation)
    {
        $this->idUserReservation = $idUserReservation;
    }

    function setDateReservation($dateReservation)
    {
        $this->dateReservation = $dateReservation;
    }

    function setHourReservation($hourReservation)
    {
        $this->hourReservation = $hourReservation;
    }
}
