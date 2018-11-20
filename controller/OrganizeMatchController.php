<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/OrganizeMatch.php");
require_once(__DIR__."/../model/OrganizeMatchMapper.php");

require_once(__DIR__."/../model/ParticipantsMatch.php");
require_once(__DIR__."/../model/ParticipantsMatchMapper.php");

require_once(__DIR__."/../model/Reservation.php");
require_once(__DIR__."/../model/ReservationMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

/**
* Class OrganizeMatchController
*
* Controller to organize a match
*
*/
class OrganizeMatchController extends BaseController {

  /**
  * Reference to the OrganizeMatchMapper to interact
  * with the database
  * @var OrganizeMatchMapper
  */
  private $organizeMatchMapper;

  /**
  * Reference to the ParticipantsMatchMapper to interact
  * with the database
  * @var ParticipantsMatchMapper
  */
  private $participantsMatchMapper;

  /**
  * Reference to the ReservationMapper to interact
  * with the database
  * @var ReservationMapper
  */
  private $reservationMapper;

  public function __construct() {
    parent::__construct();
    $this->organizeMatchMapper = new OrganizeMatchMapper();
    $this->participantsMatchMapper =  new ParticipantsMatchMapper();
    $this->reservationMapper = new ReservationMapper();
  }


  public function add() {
    if (!isset($this->currentUser) && $this->currentRol == 'a' ) {
      throw new Exception("Not in session. Organize a match requires admin");
    }

    $organizeMatch = new OrganizeMatch();

      if (isset($_POST["dateOrganizeMatch"])) { // reaching via HTTP Post...
        if(time() > strtotime($_POST["dateOrganizeMatch"])){
          throw new Exception("Fecha actual mayor que la introducida");
        }
        $organizeMatch->setFecha(date("Y-m-d", strtotime($_POST["dateOrganizeMatch"])));
        $organizeMatch->setHora($_POST["timeOrganizeMatch"]);



        $numRes = $this->reservationMapper->getNumReservations($organizeMatch->getFecha(), $organizeMatch->getHora());
        if( $numRes == 5 ){
          throw new Exception(" Alredy five matches for this date");
        }

        try {
          $organizeMatch->checkIsValidForCreate();

          $this->organizeMatchMapper->save($organizeMatch);

          $this->view->setFlash(sprintf(i18n("Match successfully organize.")));

          $this->view->redirect("users", "index");

        }catch(ValidationException $ex) {
          $errors = $ex->getErrors();
          $this->view->setVariable("errors", $errors);
        }
      }

      $this->view->setVariable("organizeMatch", $organizeMatch);

      $this->view->render("organizeMatch", "add");

    }


    public function viewAll() {
      if (!isset($this->currentUser)) {
        throw new Exception("Not in session. You must be logged");
      }

      $this->validateAllOrganizeMatches();

      $organizedMatches = $this->organizeMatchMapper->findAll();
      foreach ($organizedMatches as $match) {
        $match->setNumParticipants($this->participantsMatchMapper->count($match->getIdOrganizarPartido()));
      }

      $this->view->setVariable("organizedMatches", $organizedMatches);

      $this->view->render("organizeMatch", "view");
    }


    public function join(){
      if (!isset($this->currentUser) && $this->currentRol == 'd' ) {
        throw new Exception("Not in session. Join match requires loggin");
      }
      if(!isset($_REQUEST["idOrganizeMatch"])){
        throw new Exception("ID is mandatory");
      }
      $idOrganizeMatch = $_REQUEST["idOrganizeMatch"];

      if(isset($_POST["idOrganizeMatch"])){

        if( !($this->organizeMatchMapper->exist($_POST["idOrganizeMatch"])) ){
          throw new Exception("Incorrect ID");
        }

        $play = $this->participantsMatchMapper->play($idOrganizeMatch, $_SESSION["currentuser"]);

        if( $play ){
          throw new Exception("User alredy play");
        }

        $participant = new ParticipantsMatch(null, $_POST["idOrganizeMatch"], $_SESSION["currentuser"]);

        try{

          $participant->checkIsValidForCreate();

          $this->participantsMatchMapper->save($participant); // Error 4 insercion

          $this->view->setFlash(sprintf(i18n("Match successfully join.")));



          $players = $this->participantsMatchMapper->count($idOrganizeMatch);

          if( $players == 4 ){
            $organizeMatch = $this->organizeMatchMapper->find($idOrganizeMatch);
            if($organizeMatch != null){
              $numRes = $this->reservationMapper->getNumReservations($organizeMatch->getFecha(), $organizeMatch->getHora());
              if( $numRes != 5 ){
                $reservation = new Reservation(null, "admin", $organizeMatch->getFecha(), $organizeMatch->getHora());
                $this->reservationMapper->makeReservation($reservation);
                $this->organizeMatchMapper->delete($idOrganizeMatch);
              }
              else{
                throw new Exception(" Alredy five matches for this date");
              }
            }
            else {
              throw new Exception(" Organize match not found");
            }
          }

          $this->view->redirect("users", "index");

        }catch(ValidationException $ex) {
          $errors = $ex->getErrors();
          $this->view->setVariable("errors", $errors);
        }
      }

      $joinMatch = $this->organizeMatchMapper->findMatchWithParticipants($idOrganizeMatch);
      $play = $this->participantsMatchMapper->play($idOrganizeMatch, $_SESSION["currentuser"]);

      $this->view->setVariable("play", $play );

      $this->view->setVariable("joinMatch", $joinMatch );

      $this->view->render("organizeMatch", "join");

    }

    public function delete(){
      if (!isset($this->currentUser) && $this->currentRol == 'a' ) {
        throw new Exception("Not in session. Delete a match requires admin");
      }
      if(!isset($_REQUEST["idOrganizeMatch"])){
        throw new Exception("ID is mandatory");
      }

      $idOrganizeMatch = $_REQUEST["idOrganizeMatch"];

      if(isset($_POST["idOrganizeMatch"])){

        if( !($this->organizeMatchMapper->exist($_POST["idOrganizeMatch"])) ){
          throw new Exception("Incorrect ID");
        }

        try{
          $this->organizeMatchMapper->delete($_POST["idOrganizeMatch"]);

          $this->view->setFlash(sprintf(i18n("Match successfully delete.")));

          $this->view->redirect("users", "index");

        }catch(ValidationException $ex) {
          $errors = $ex->getErrors();
          $this->view->setVariable("errors", $errors);
        }
      }

      $deleteMatch = $this->organizeMatchMapper->findMatchWithParticipants($idOrganizeMatch);

      $this->view->setVariable("deleteMatch", $deleteMatch );

      $this->view->render("organizeMatch", "delete");

    }

    public function cancel(){
      if (!isset($this->currentUser) && $this->currentRol == 'a' ) {
        throw new Exception("Not in session. Delete a match requires admin");
      }

      if(isset($_POST["idOrganizeMatch"])){

        if( !($this->organizeMatchMapper->exist($_POST["idOrganizeMatch"])) ){
          throw new Exception("Incorrect ID");
        }

        try{

          $this->participantsMatchMapper->cancel($_POST["idOrganizeMatch"], $_SESSION["currentuser"]);

          $this->view->setFlash(sprintf(i18n("Cancel successfully.")));

          $this->view->redirect("users", "index");

        }catch(ValidationException $ex) {
          $errors = $ex->getErrors();
          $this->view->setVariable("errors", $errors);
        }
      }
      else{
        throw new Exception("ID is mandatory");
      }
    }

    public function validateAllOrganizeMatches(){
      $organizedMatches = $this->organizeMatchMapper->findAll();
      foreach ($organizedMatches as $organizeMatch) {
        $numRes = $this->reservationMapper->getNumReservations($organizeMatch->getFecha(), $organizeMatch->getHora());
        if( $numRes == 5 ){
          $this->organizeMatchMapper->delete($organizeMatch->getIdOrganizarPartido());
        }
      }
    }

  }
