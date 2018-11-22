<?php
// file: model/ReservationMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Partner.php");

class ReservationMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function getReservations(){
		//SELECT count(fechaReserva), fechaReserva, horaReserva FROM reserva WHERE fechaReserva BETWEEN curdate() AND curdate()+7 group by fechaReserva, horaReserva
		$stmt = $this->db->prepare("SELECT * FROM reserva WHERE fechaReserva BETWEEN CURDATE() AND CURDATE() + 7 ORDER BY fechaReserva, horaReserva");
		$stmt->execute();

		$toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$torretReservations = array();

		foreach ($toret_db as $reservation) {
			array_push($torretReservations, new Reservation(
				$reservation["idReserva"],
				$reservation["idUsuarioReserva"],
				$reservation["fechaReserva"],
				$reservation["horaReserva"]
			));
		}
		return $torretReservations;
	}

	public function makeReservation($reservation){
		$stmt = $this->db->prepare("INSERT INTO reserva (idUsuarioReserva, fechaReserva, horaReserva) values (?,?,?)");
		$stmt->execute(array($reservation->getIdUserReservation(),
			$reservation->getDateReservation(),
			$reservation->getHourReservation(),
		));

	}

	public function getNumReservations($date, $hour){
		$stmt = $this->db->prepare("SELECT count(*) as numPistas FROM reserva WHERE fechaReserva  = ? AND horaReserva = ?");
		$date = date("Y-m-d", strtotime($date));
		$stmt->execute(array($date, $hour));

		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		$lastPista = $result["numPistas"];
		return $lastPista;
	}

	public function getReservationCount(){
		$stmt = $this->db->prepare("SELECT count(fechaReserva) as numReservas, fechaReserva, horaReserva FROM reserva WHERE fechaReserva BETWEEN curdate() AND curdate()+7 group by fechaReserva, horaReserva");
		$stmt->execute();

		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$torretReservations = array();

		foreach ($results as $result) {
			array_push($torretReservations, array(
				"fecha" => $result["fechaReserva"],
				"hora" => $result["horaReserva"],
				"numReservas" => $result["numReservas"])
		);
		}
		return $torretReservations;
	}

	public function getReservationId($idUsuarioReserva, $fechaReserva, $horaReserva){
		$stmt = $this->db->prepare("SELECT * FROM reserva WHERE idUsuarioReserva=? AND fechaReserva=? AND horaReserva=?");
		$stmt->execute(array($idUsuarioReserva,
													$fechaReserva,
													$horaReserva));
		$reservation = $stmt->fetch(PDO::FETCH_ASSOC);

		if($reservation != null){
			return $reservation["idReserva"];
		}
		return null;
	}

	public function getReservation($idReservation){
		$stmt = $this->db->prepare("SELECT * FROM reserva WHERE idReserva = ?");
		$stmt->execute(array($idReservation));
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		if( $results != null ) {
			return new Reservation(
				$results["idReserva"],
				$results["idUsuarioReserva"],
				$results["fechaReserva"],
				$results["horaReserva"]);
		}
	}
}
