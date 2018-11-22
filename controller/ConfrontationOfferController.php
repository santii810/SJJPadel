<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/ConfrontationOffer.php");
require_once(__DIR__."/../model/ConfrontationOfferMapper.php");

require_once(__DIR__."/../model/Confrontation.php");
require_once(__DIR__."/../model/ConfrontationMapper.php");

require_once(__DIR__."/../model/Reservation.php");
require_once(__DIR__."/../model/ReservationMapper.php");

require_once(__DIR__."/../model/Partner.php");
require_once(__DIR__."/../model/PartnerMapper.php");

require_once(__DIR__."/../model/CategoryChampionship.php");
require_once(__DIR__."/../model/CategoryChampionshipMapper.php");

require_once(__DIR__."/../model/Championship.php");
require_once(__DIR__."/../model/ChampionshipMapper.php");

require_once(__DIR__."/../model/Category.php");
require_once(__DIR__."/../model/CategoryMapper.php");

require_once(__DIR__."/../model/Partnergroup.php");
require_once(__DIR__."/../model/PartnergroupMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

/**
* Class ConfrontationOfferController
*
* Controller to offer a match and join to a tournament match
*
*/
class ConfrontationOfferController extends BaseController {

  /**
  * Reference to the ConfrontationOfferMapper to interact
  * with the database
  * @var ConfrontationOfferMapper
  */
  private $confrontationOfferMapper;

  /**
  * Reference to the ConfrontationMapper to interact
  * with the database
  * @var ConfrontationMapper
  */
  private $confrontationMapper;

  /**
  * Reference to the ReservationMapper to interact
  * with the database
  * @var ReservationMapper
  */
  private $reservationMapper;

  /**
  * Reference to the PartnerMapper to interact
  * with the database
  * @var PartnerMapper
  */
  private $partnerMapper;

  /**
  * Reference to the CategoryChampionshipMapper to interact
  * with the database
  * @var CategoryChampionshipMapper
  */
  private $categoryChampionshipMapper;

  /**
  * Reference to the ChampionshipMapper to interact
  * with the database
  * @var ChampionshipMapper
  */
  private $championshipMapper;

  /**
  * Reference to the CategoryMapper to interact
  * with the database
  * @var CategoryMapper
  */
  private $categoryMapper;

  /**
  * Reference to the PartnergroupMapper to interact
  * with the database
  * @var PartnergroupMapper
  */
  private $partnerGroupMapper;


  public function __construct() {
    parent::__construct();
    $this->confrontationOfferMapper = new ConfrontationOfferMapper();
    $this->confrontationMapper =  new ConfrontationMapper();
    $this->reservationMapper = new ReservationMapper();
    $this->partnerMapper = new PartnerMapper();
    $this->categoryChampionshipMapper = new CategoryChampionshipMapper();
    $this->championshipMapper = new ChampionshipMapper();
    $this->categoryMapper = new CategoryMapper();
    $this->partnerGroupMapper = new PartnergroupMapper();
  }

  public function view(){
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Check Confrontations requires login");
    }

    $currentUser = $this->currentUser->getLogin();

    $partner = $this->partnerMapper->getMyParners($currentUser);

    $category_wt_tournament = array();

    if( $partner != null ){
      foreach( $partner as $partnerCategory ){
        $categoryChampionship =  $this->categoryChampionshipMapper->getChampionshipFromIdCategory( $partnerCategory->getIdCategoryChampionship() );
        $nombreCampeonato = $this->championshipMapper->getNombreCampeonato( $categoryChampionship->getIdChampionship() );
        $idGrupo = $this->partnerGroupMapper->hasGroup( $partnerCategory->getIdPartner() );
        if ( $nombreCampeonato != '' && $idGrupo ){
          $category = $this->categoryMapper->getCategory( $categoryChampionship->getIdCategory() );
          $sexo = $category->getSexo();
          $nivel = $category->getNivel();
          array_push($category_wt_tournament, [$nombreCampeonato, $sexo, $nivel, $categoryChampionship->getId(),
                                                $categoryChampionship->getIdChampionship(), $categoryChampionship->getIdCategory(), $partnerCategory->getIdPartner()]);
        }
      }
    }

    $this->view->setVariable("category_wt_tournament", $category_wt_tournament);

    $this->view->render("confrontation", "confrontationOffer");
  }

  public function select(){
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Check Confrontations requires login");
    }
    if (! (isset($_GET["idCategoriaCampeonato"]) && isset($_GET["idCampeonato"]) && isset($_GET["idCategoria"]) && isset($_GET["idPareja"]) ) ) {
      throw new Exception("Error in the parameters");
    }

    $idCategoriaCampeonato = $_GET["idCategoriaCampeonato"];
    $idCampeonato = $_GET["idCampeonato"];
    $idCategoria = $_GET["idCategoria"];
    $idPareja = $_GET["idPareja"];

    $idGrupo = $this->partnerGroupMapper->getIdGrupo($idPareja);

    $this->validateMatchs($idGrupo);

    $confrontationOffers = $this->confrontationOfferMapper->getConfrontationOffersForGroup($idGrupo);
    $posibleOffers = array();

    foreach($confrontationOffers as $offer){
      if( $idPareja != $offer->getIdPareja() ){
        if( !$this->confrontationMapper->hadPlayed($idPareja, $offer->getIdPareja(), $idGrupo) ){
          $miembrosPareja = $this->partnerMapper->getMembers($offer->getIdPareja());
          $offer->setPareja($miembrosPareja);
          array_push($posibleOffers, $offer);
        }
      }
    }

    $this->view->setVariable("idCampeonato", $idCampeonato);
    $this->view->setVariable("idPareja", $idPareja);
    $this->view->setVariable("posibleOffers", $posibleOffers);
    $this->view->render("confrontation", "confrontationSelect");
  }

  public function join(){
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Check Confrontations requires login");
    }
    if (!( isset($_REQUEST["idOfertaEnfrentamiento"]) && isset($_REQUEST["idPareja"]) && isset( $_REQUEST["idParejaOffer"]) ) )  {
      throw new Exception("Error in the parameters");
    }
    $idPareja = $_REQUEST["idPareja"];
    $idParejaOffer = $_REQUEST["idParejaOffer"];
    $idOfertaEnfrentamiento = $_REQUEST["idOfertaEnfrentamiento"];
    $ofertaEnfrentamiento = $this->confrontationOfferMapper->getOffer($idOfertaEnfrentamiento);
    $miembrosPareja = $this->partnerMapper->getMembers($idParejaOffer);
    $ofertaEnfrentamiento->setPareja($miembrosPareja);

    if( isset($_POST["idOfertaEnfrentamiento"]) ) {
      $idOfertaEnfrentamiento = $_POST["idOfertaEnfrentamiento"];
      $idParejaOferta =  $_REQUEST["idParejaOffer"];
      $idPareja = $_REQUEST["idPareja"];
      $idCapitan = $this->partnerMapper->getIdCapitan($idPareja);
      $ofertaEnfrentamiento = $this->confrontationOfferMapper->getOffer($idOfertaEnfrentamiento);
      var_dump($idParejaOffer);
      $reservation = new Reservation(null, $idCapitan, $ofertaEnfrentamiento->getFecha(), $ofertaEnfrentamiento->getHora());
      $this->reservationMapper->makeReservation($reservation);

      $idConfrontation = $this->confrontationMapper->getIdConfrontation($idParejaOffer, $idPareja);

      $this->confrontationMapper->actualizarHorario($idConfrontation, $ofertaEnfrentamiento->getFecha(), $ofertaEnfrentamiento->getHora());

      $this->confrontationOfferMapper->delete($ofertaEnfrentamiento->getIdOfertaEnfrentamiento() );

      $this->view->setFlash(sprintf(i18n("Join match successfully.")));
      $this->view->redirect("confrontationOffer", "view");
    }

    $this->view->setVariable("idPareja", $idPareja);
    $this->view->setVariable("idParejaOffer", $idParejaOffer);
    $this->view->setVariable("ofertaEnfrentamiento", $ofertaEnfrentamiento);
    $this->view->render("confrontation", "confrontationOfferJoin");

  }

  public function offer(){
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Check Confrontations requires login");
    }
    if(!( isset($_REQUEST["idPareja"]) && isset($_REQUEST["idCampeonato"]) ) ){
      throw new Exception("ID partner and ID Championship are neccesay");
    }

    $idPartner = $_REQUEST["idPareja"];
    $idChampionship = $_REQUEST["idCampeonato"];

    if(isset($_POST["dateOrganizeMatch"]) ) {
      $fechaOffer = $_POST["dateOrganizeMatch"];
      $dateOffer = date("Y-m-d", strtotime($fechaOffer));
      $horaOffer = $_POST["timeOrganizeMatch"];

      if( !($this->championshipMapper->validateHour($idChampionship, $dateOffer)) ){
        $this->view->setFlash(sprintf(i18n("The date is invalid")));
        $this->view->redirect("confrontationOffer", "offer", "idPareja=".$idPartner."&idCampeonato=".$idChampionship );
      }

      if( $this->reservationMapper->getNumReservations($fechaOffer, substr($horaOffer, 0, 5)) ){
        $this->view->setFlash(sprintf(i18n("Alredy 5 matches for this hour and date")));
        $this->view->redirect("confrontationOffer", "offer", "idPareja=".$idPartner."&idCampeonato=".$idChampionship );
      }

      $idGrupo = $this->partnerGroupMapper->getIdGrupo($idPartner);

      $newConfrontation = new ConfrontationOffer(null, $idPartner, $idGrupo, $horaOffer, $fechaOffer);

      $this->confrontationOfferMapper->save($newConfrontation);

      $this->view->setFlash(sprintf(i18n("Set your offer successfully")));
      $this->view->redirect("confrontationOffer", "view");
    }

    $this->view->setVariable("idPartner", $idPartner);
    $this->view->setVariable("idChampionship", $idChampionship);
    $this->view->render("confrontation", "confrontationOfferAdd");
  }

  public function validateMatchs($idGrupo){
    $confrontationOffers = $this->confrontationOfferMapper->getConfrontationOffersForGroup($idGrupo);
    foreach ($confrontationOffers as $offer) {
      $numRes = $this->reservationMapper->getNumReservations($offer->getFecha(), substr($offer->getHora(), 0, 5));
      if( $numRes == 5 ){
        $this->confrontationOfferMapper->delete($offer->getIdOfertaEnfrentamiento());
      }
    }
  }

}
