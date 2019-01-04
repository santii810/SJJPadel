<?php
require_once (__DIR__ . "/../model/Reservation.php");
require_once (__DIR__ . "/../model/ReservationMapper.php");

require_once (__DIR__ . "/../core/ViewManager.php");
require_once (__DIR__ . "/../controller/BaseController.php");

class StatisticsController extends BaseController
{

    private $reservationMapper;

    public function __construct()
    {
        parent::__construct();
        
        $this->reservationMapper = new ReservationMapper();
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
    
    public function generalStatistics(){
        
        
        
        $this->view->render("statistics", "generalStatistics");
        
    }
}
