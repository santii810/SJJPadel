<?php

require_once (__DIR__ . "/../model/User.php");
require_once (__DIR__ . "/../model/UserMapper.php");

require_once (__DIR__ . "/../model/Confrontation.php");
require_once (__DIR__ . "/../model/ConfrontationMapper.php");

require_once (__DIR__ . "/../model/Reservation.php");
require_once (__DIR__ . "/../model/ReservationMapper.php");

require_once (__DIR__ . "/../model/OrganizedMatch.php");
require_once (__DIR__ . "/../model/OrganizedMatchMapper.php");

require_once (__DIR__ . "/../model/Partner.php");
require_once (__DIR__ . "/../model/PartnerMapper.php");

require_once (__DIR__ . "/../core/ViewManager.php");
require_once (__DIR__ . "/../controller/BaseController.php");

class ScheduleController extends BaseController
{

  private $userMapper;
  private $organizedMatchMapper;
  private $confrontationMapper;
  private $reservationMapper;

  public function __construct()
  {
      parent::__construct();
      $this->userMapper = new UserMapper();
      $this->organizedMatchMapper = new OrganizedMatchMapper();
      $this->confrontationMapper = new ConfrontationMapper();
      $this->reservationMapper = new ReservationMapper();
      $this->partnerMapper = new PartnerMapper();
  }

  public function viewChampionshipMatches()
  {
      if (!isset($this->currentUser)) {
          throw new Exception("Not in session. You must be logged");
      }
      $user = $this->userMapper->getDatos($this->currentUser->getLogin());

      if($user->getRol() == 'a'){
          throw new Exception(" Not user or trainer");
      }

      $parejas = $this->partnerMapper->getMyParners($this->currentUser->getLogin());
      $championshipMatches = array();
      foreach($parejas as $pareja){
        $championshipMatchesArray = $this->confrontationMapper->getConfrontationMatches($pareja->getIdPartner());
        foreach($championshipMatchesArray as $championshipMatch){
          array_push($championshipMatches, $championshipMatch);
        }
      }


      $this->view->setVariable("championshipMatches", $championshipMatches);

      $this->view->render("schedule", "viewChampionshipMatches");
  }

  public function viewReservations()
  {
      if (!isset($this->currentUser)) {
          throw new Exception("Not in session. You must be logged");
      }
      $user = $this->userMapper->getDatos($this->currentUser->getLogin());

      if($user->getRol() == 'a'){
          throw new Exception(" Not user or trainer");
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
      $user = $this->userMapper->getDatos($this->currentUser->getLogin());

      if($user->getRol() == 'a'){
          throw new Exception(" Not user or trainer");
      }

      $organizedMatches = $this->organizedMatchMapper->getUserMatches($this->currentUser->getLogin());

      $organizedMatchesReservation = array();

      foreach($organizedMatches as $organizeMatch){
        array_push($organizedMatchesReservation, $this->reservationMapper->getReservation($organizeMatch->getIdReserva()));
      }

      $this->view->setVariable("organizedMatchesReservation", $organizedMatchesReservation);

      $this->view->render("schedule", "viewOrganizedMatches");
  }

}
?>
