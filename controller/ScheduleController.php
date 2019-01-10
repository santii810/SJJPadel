<?php

require_once (__DIR__ . "/../model/Confrontation.php");
require_once (__DIR__ . "/../model/ConfrontationMapper.php");

require_once (__DIR__ . "/../model/Reservation.php");
require_once (__DIR__ . "/../model/ReservationMapper.php");

require_once (__DIR__ . "/../model/OrganizedMatch.php");
require_once (__DIR__ . "/../model/OrganizedMatchMapper.php");

require_once (__DIR__ . "/../core/ViewManager.php");
require_once (__DIR__ . "/../controller/BaseController.php");

class ScheduleController extends BaseController
{

  private $organizedMatchMapper;
  private $confrontationMapper;
  private $reservationMapper;

  public function __construct()
  {
      parent::__construct();
      $this->organizedMatchMapper = new OrganizedMatchMapper();
      $this->confrontationMapper = new ConfrontationMapper();
      $this->reservationMapper = new ReservationMapper();
  }

  public function viewChampionshipMatches()
  {
      if (!isset($this->currentUser)) {
          throw new Exception("Not in session. You must be logged");
      }



      $this->view->setVariable("championshipMatches", $championshipMatches);

      $this->view->render("schedule", "viewChampionshipMatches");
  }

  public function viewReservations()
  {
      if (!isset($this->currentUser)) {
          throw new Exception("Not in session. You must be logged");
      }

      $reservations = $this->reservationMapper->getUserReservations($this->currentUser->getLogin());

      $this->view->setVariable("reservations", $reservations);

      $this->view->render("schedule", "viewReservations");
  }

  public function viewOrganizedMatches()
  {
      if (!isset($this->currentUser)) {
          throw new Exception("Not in session. You must be logged");
      }


      $this->view->setVariable("organizedMatches", $organizedMatches);

      $this->view->render("schedule", "viewOrganizedMatches");
  }

}
?>
