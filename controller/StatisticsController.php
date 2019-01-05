<?php
require_once (__DIR__ . "/../model/Reservation.php");
require_once (__DIR__ . "/../model/ReservationMapper.php");

require_once (__DIR__ . "/../model/Championship.php");
require_once (__DIR__ . "/../model/ChampionshipMapper.php");

require_once (__DIR__ . "/../model/Category.php");
require_once (__DIR__ . "/../model/CategoryMapper.php");

require_once (__DIR__ . "/../core/ViewManager.php");
require_once (__DIR__ . "/../controller/BaseController.php");

class StatisticsController extends BaseController
{

    private $reservationMapper;

    private $championshipMapper;

    private $categoryMapper;

    public function __construct()
    {
        parent::__construct();
        
        $this->reservationMapper = new ReservationMapper();
        $this->championshipMapper = new ChampionshipMapper();
        $this->categoryMapper = new CategoryMapper();
    }

    public function reservationStatistics()
    {
        $statistics = array();
        $titles = array(
            "Reservations coming days",
            "Reservations per week day",
            "Reservations per time"
        );
        
        $reservationDayStatistics = $this->reservationMapper->getReservationDayStatistics();
        $reservationHourStatistics = $this->reservationMapper->getReservationHourStatistics();
        $reservationComingStatistics = $this->reservationMapper->getReservationComingStatistics();
        
        array_push($statistics, $reservationComingStatistics);
        array_push($statistics, $reservationDayStatistics);
        array_push($statistics, $reservationHourStatistics);
        
        $this->view->setVariable("statistics", $statistics);
        $this->view->setVariable("titles", $titles);
        $this->view->render("statistics", "reservationStats");
    }

    public function championshipStatistics()
    {
        $statistics = array();
        $titles = array(
            "Couples per championship",
            "Couples per category"
        );
        array_push($statistics, $this->championshipMapper->getCouplesPerChampionship());
        array_push($statistics, $this->categoryMapper->getCouplesPerCategory());
        
        
        $this->view->setVariable("statistics", $statistics);
        $this->view->setVariable("titles", $titles);
        $this->view->render("statistics", "championshipStatistics");
    }

    public function personalStatistics()
    {
        $this->view->render("statistics", "personalStatistics");
    }
}
