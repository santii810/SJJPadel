<?php
// file: model/Reservation.php

require_once(__DIR__."/../core/ValidationException.php");

class Reservation {
	private $idReservation;
	private $idUserReservation;	
	private $dateReservation;
	private $hourReservation;
	private $idPista;
        
        function __construct($idReservation, $idUserReservation, $dateReservation, $hourReservation, $idPista) {
            $this->idReservation = $idReservation;
            $this->idUserReservation = $idUserReservation;
            $this->dateReservation = $dateReservation;
            $this->hourReservation = $hourReservation;
            $this->idPista = $idPista;
        }

        function getIdReservation() {
            return $this->idReservation;
        }

        function getIdUserReservation() {
            return $this->idUserReservation;
        }

        function getDateReservation() {
            return $this->dateReservation;
        }

        function getHourReservation() {
            return $this->hourReservation;
        }

        function getIdPista() {
            return $this->idPista;
        }

        function setIdReservation($idReservation) {
            $this->idReservation = $idReservation;
        }

        function setIdUserReservation($idUserReservation) {
            $this->idUserReservation = $idUserReservation;
        }

        function setDateReservation($dateReservation) {
            $this->dateReservation = $dateReservation;
        }

        function setHourReservation($hourReservation) {
            $this->hourReservation = $hourReservation;
        }

        function setIdPista($idPista) {
            $this->idPista = $idPista;
        }


}