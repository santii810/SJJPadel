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

    public function viewAll()
    {
        $statistics = array();       
        
        
        
        
        $this->view->setVariable("statistics", $statistics);
        $this->view->render("statistics", "viewAll");
    }

   
}
