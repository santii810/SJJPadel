<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/OrganizeMatch.php");
require_once(__DIR__."/../model/OrganizeMatchMapper.php");

require_once(__DIR__."/../model/ParticipantsMatch.php");
  require_once(__DIR__."/../model/ParticipantsMatchMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

/**
* Class OrganizeMatchController
*
* Controller to organize a match
*
* @author lipido <lipido@gmail.com>
*/
class OrganizeMatchController extends BaseController {

  /**
  * Reference to the OrganizeMatchMapper to interact
  * with the database
  *
  * @var OrganizeMatchMapper
  */
  private $organizeMatchMapper;
  private $participantsMatchMapper;

  public function __construct() {
    parent::__construct();
    $this->organizeMatchMapper = new OrganizeMatchMapper();
    $this->participantsMatchMapper =  new ParticipantsMatchMapper();
  }


    public function add() {
      if (!isset($this->currentUser) && $this->currentRol == 'a' ) {
        throw new Exception("Not in session. Organize a match requires admin");
      }

      $organizeMatch = new OrganizeMatch();

      if (isset($_POST["dateOrganizeMatch"])) { // reaching via HTTP Post...

        // populate the Post object with data form the form
        $organizeMatch->setFecha(date("Y,m,d", strtotime($_POST["dateOrganizeMatch"])));
        $organizeMatch->setHora($_POST["timeOrganizeMatch"]);

        try {
          // validate OrganizeMatch object
          $organizeMatch->checkIsValidForCreate(); // if it fails, ValidationException

          // save the OrganizeMatch object into the database
          $this->organizeMatchMapper->save($organizeMatch);

          // POST-REDIRECT-GET
          // Everything OK, we will redirect the user to the list of posts
          // We want to see a message after redirection, so we establish
          // a "flash" message (which is simply a Session variable) to be
          // get in the view after redirection.
          $this->view->setFlash(sprintf(i18n("Match successfully organize.")));

          // perform the redirection. More or less:
          // header("Location: index.php?controller=users&action=index")
          // die();
          $this->view->redirect("users", "index");

        }catch(ValidationException $ex) {
          // Get the errors array inside the exepction...
          $errors = $ex->getErrors();
          // And put it to the view as "errors" variable
          $this->view->setVariable("errors", $errors);
        }
      }

      // Put the OrganizeMatch object visible to the view
      $this->view->setVariable("organizeMatch", $organizeMatch);

      // render the view (/view/organizeMatch/add.php)
      $this->view->render("organizeMatch", "add");

    }

    public function viewAll() {
      if (!isset($this->currentUser)) {
        throw new Exception("Not in session. You must be logged");
      }

      $organizedMatches = $this->organizeMatchMapper->findAll();

      // Put the OrganizeMatch object visible to the view
      $this->view->setVariable("organizedMatches", $organizedMatches);

      // render the view (/view/organizeMatch/add.php)
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

        $participant = new ParticipantsMatch(null, $_POST["idOrganizeMatch"], $_SESSION["currentuser"]);

        try{

          // validate OrganizeMatch object
          $participant->checkIsValidForCreate(); // if it fails, ValidationException

          // save the OrganizeMatch object into the database
          $this->participantsMatchMapper->save($participant);

          // POST-REDIRECT-GET
          // Everything OK, we will redirect the user to the list of posts
          // We want to see a message after redirection, so we establish
          // a "flash" message (which is simply a Session variable) to be
          // get in the view after redirection.
          $this->view->setFlash(sprintf(i18n("Match successfully join.")));

          // perform the redirection. More or less:
          // header("Location: index.php?controller=users&action=index")
          // die();
          $this->view->redirect("users", "index");

        }catch(ValidationException $ex) {
          // Get the errors array inside the exepction...
          $errors = $ex->getErrors();
          // And put it to the view as "errors" variable
          $this->view->setVariable("errors", $errors);
        }
      }

      $joinMatch = $this->organizeMatchMapper->findMatchWithParticipants($idOrganizeMatch);

      // Put the OrganizeMatch object visible to the view
      $this->view->setVariable( "joinMatch", $joinMatch );

      // render the view (/view/organizeMatch/add.php)
      $this->view->render("organizeMatch", "join");

    }

    public function delete(){
      if (!isset($this->currentUser) && $this->currentRol == 'a' ) {
        throw new Exception("Not in session. Delete a match requires admin");
      }

    }
  }
