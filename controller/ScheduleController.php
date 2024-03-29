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
  /**
   * Reference to the UserMapper to interact
   * with the database
   *
   * @var UserMapper
   */
  private $userMapper;

  /**
   * Reference to the OrganizedMatchMapper to interact
   * with the database
   *
   * @var OrganizedMatchMapper
   */
  private $organizedMatchMapper;

  /**
   * Reference to the ConfrontationMapper to interact
   * with the database
   *
   * @var ConfrontationMapper
   */
  private $confrontationMapper;

  /**
   * Reference to the ReservationMapper to interact
   * with the database
   *
   * @var ReservationMapper
   */
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

  /**
	* Acción de listar todos los partidos de campeonato que tiene que jugar un usuario
  * y su fecha y hora ya se ha establecido
	*
	*/
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

  /**
	* Accion de listar las reservas hechas por un usuario
	*
  * Muestras las reservas que un usuario ha realizado
	*
	*/
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

  /**
  * Acción de mostrar los partidos organizados que se han creado para un usuario
  *
  */
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
