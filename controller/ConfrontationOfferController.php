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


  public function __construct() {
    parent::__construct();
    $this->confrontationOfferMapper = new ConfrontationOfferMapper();
    $this->confrontationMapper =  new ConfrontationMapper();
    $this->reservationMapper = new ReservationMapper();
    $this->partnerMapper = new PartnerMapper();
    $this->categoryChampionshipMapper = new CategoryChampionshipMapper();
    $this->championshipMapper = new ChampionshipMapper();
    $this->categoryMapper = new CategoryMapper();
  }

  public function view(){
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Check Confrontations requires login");
    }

    $currentUser = $this->currentUser->getLogin();

    $partner = $this->partnerMapper->getMyParners($currentUser);

    if( $partner != null ){
    //  var_dump($partner);
      $category_wt_tournament = array();
      foreach( $partner as $partnerCategory ){
        $categoryChampionship =  $this->categoryChampionshipMapper->getChampionshipFromIdCategory( $partnerCategory->getIdCategoryChampionship() );
        $nombreCampeonato = $this->championshipMapper->getNombreCampeonato( $categoryChampionship->getIdChampionship() );
        if ( $nombreCampeonato != '' ){
          $category = $this->categoryMapper->getCategory( $categoryChampionship->getIdCategory() );
          $sexo = $category->getSexo();
          $nivel = $category->getNivel();
          array_push($category_wt_tournament, [$nombreCampeonato, $sexo, $nivel, $categoryChampionship->getId(),
                                                $categoryChampionship->getIdChampionship(), $categoryChampionship->getIdCategory(), $partnerCategory->getIdPartner()]);
        }
      }

      //$this->view->setFlash(sprintf(i18n("Match successfully organize.")));

      //$this->view->redirect("users", "index");

      $this->view->setVariable("category_wt_tournament", $category_wt_tournament);

      $this->view->render("confrontation", "confrontationOffer");
    }else{
      echo 'no esta en ninguna pareja';
    }
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

    

    $this->view->render("confrontation", "confrontationSelect");

  }
}
