<?php

require_once(__DIR__."/../model/Reservation.php");
require_once(__DIR__."/../model/ReservationMapper.php");
require_once(__DIR__."/../model/Reservation.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");


class ReservationController extends BaseController {
	
	private $reservationMapper;

	public function __construct() {
		parent::__construct();

		$this->reservationMapper = new ReservationMapper();
	}


	public function showAvaliableSchedules() {
		$reservationMapper = new ReservationMapper();
		$reservations = $reservationMapper->getReservationCount();

		$this->view->setVariable("reservations", $reservations);
		$this->view->render("reservation", "selectSchedule");
	}
	public function add(){
		$reservationMapper = new ReservationMapper();
		
		$date = explode('#', $_POST["scheduleButton"])[0];
		$date = date("Y-m-d", strtotime($date));
		$hour = explode('#', $_POST["scheduleButton"])[1];
		$pista = $reservationMapper->getFreePista($date, $hour);
		
		
		$reservation = new Reservation(null, $_SESSION["currentuser"], $date, $hour, $pista+1);
		
		$reservationMapper->makeReservation($reservation);


		$this->view->setVariable("reservation", $reservation);
		$this->view->render("reservation", "add");
	}
}