<?php
require_once (__DIR__ . "/../model/Reservation.php");
require_once (__DIR__ . "/../model/ReservationMapper.php");

require_once (__DIR__ . "/../core/ViewManager.php");
require_once (__DIR__ . "/../controller/BaseController.php");

class ReservationController extends BaseController
{
  /**
   * Referencia ReservationMapper que interaciona con
   * la base de datos
   *
   * @var ReservationMapper
   */
    private $reservationMapper;

    public function __construct()
    {
        parent::__construct();

        $this->reservationMapper = new ReservationMapper();
    }

/*
* Accion de mostrar las pistas para realizar las reservas
*
*/
    public function showAvaliableSchedules()
    {
        $reservationMapper = new ReservationMapper();
        $reservations = $reservationMapper->getReservationCount();

        $this->view->setVariable("reservations", $reservations);
        $this->view->render("reservation", "selectSchedule");
    }

/*
* Acción de reservar una pista disponible
*
*/
    public function add()
    {
        $reservationMapper = new ReservationMapper();

        $date = explode('#', $_POST["scheduleButton"])[0];
        $date = date("Y-m-d", strtotime($date));
        $hour = explode('#', $_POST["scheduleButton"])[1];
        $pista = $reservationMapper->getNumReservations($date, $hour);

        $reservation = new Reservation(null, $_SESSION["currentuser"], $date, $hour);

        $reservationMapper->makeReservation($reservation);

        $idReservation = $reservationMapper->getReservationId($_SESSION["currentuser"], $date, $hour);

        $this->view->redirect("reservation", "showInfo", "idReservation=" . $idReservation);
    }

/*
* Acción de mostrar la información de la pista despues de reservarla
*
*/
    public function showInfo()
    {
        $reservationMapper = new ReservationMapper();
        $reservation = $reservationMapper->getReservation($_REQUEST["idReservation"]);

        $this->view->setVariable("reservation", $reservation);
        $this->view->render("reservation", "add");
    }


/*
* Acción de cancelar una reserva de una pista
*
*/
    public function cancel(){
      if (!isset($this->currentUser)) {
          throw new Exception("Not in session. Cancel a reservation requires loggin");
      }
      if (!isset($_POST["idReservation"])) {
          throw new Exception("ID is mandatory");
      }

      $idReservation = $_POST["idReservation"];

      $reservation = $this->reservationMapper->getReservation($idReservation);

      if($reservation->getIdUserReservation() != $this->currentUser->getLogin()){
          throw new Exception("Not your reservation");
      }

      if((time()+(60*60*24)) > strtotime($reservation->getDateReservation())){
        $this->view->setFlash(sprintf(i18n("You can't cancel a reservation 1 day left")));
        $this->view->redirect("schedule", "viewReservations");
      }
      else{
        $this->reservationMapper->delete($reservation->getIdReservation());
        $this->view->setFlash(sprintf(i18n("Reservation cancelled")));
        $this->view->redirect("schedule", "viewReservations");
      }
    }

}
