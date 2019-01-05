<?php
require_once (__DIR__ . "/../model/Reservation.php");
require_once (__DIR__ . "/../model/ReservationMapper.php");

require_once (__DIR__ . "/../model/Championship.php");
require_once (__DIR__ . "/../model/ChampionshipMapper.php");

require_once (__DIR__ . "/../model/Confrontation.php");
require_once (__DIR__ . "/../model/ConfrontationMapper.php");

require_once (__DIR__ . "/../model/Partner.php");
require_once (__DIR__ . "/../model/PartnerMapper.php");

require_once (__DIR__ . "/../model/Category.php");
require_once (__DIR__ . "/../model/CategoryMapper.php");

require_once (__DIR__ . "/../core/ViewManager.php");
require_once (__DIR__ . "/../controller/BaseController.php");

class StatisticsController extends BaseController
{

    private $reservationMapper;

    private $championshipMapper;

    private $categoryMapper;

    private $confrontationMapper;

    private $partnerMapper;

    public function __construct()
    {
        parent::__construct();
        
        $this->reservationMapper = new ReservationMapper();
        $this->championshipMapper = new ChampionshipMapper();
        $this->categoryMapper = new CategoryMapper();
        $this->confrontationMapper = new ConfrontationMapper();
        $this->partnerMapper = new PartnerMapper();
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
        
        $this->view->setVariable("title", "Reservation statistics");
        $this->view->setVariable("statistics", $statistics);
        $this->view->setVariable("titles", $titles);
        $this->view->render("statistics", "show");
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
        
        $this->view->setVariable("title", "Championship statistics");
        $this->view->setVariable("statistics", $statistics);
        $this->view->setVariable("titles", $titles);
        $this->view->render("statistics", "show");
    }

    public function personalStatistics()
    {
        $statistics = array();
        $championshipStatistics = array();
        $couplesStatistics = array();
        $couplesMatches = array();
        $titles = array(
            "Championsip statistics"
        );

        
        
        
        
        $couples = $this->partnerMapper->getMyParners($this->currentUser->getLogin());
        $totalVictories = 0;
        $totalDefeats = 0;
        $usualCouple = "";
        $matchWithCouple = 0;
        $bestPosition = "Grupos";
        $positionValues = array(
            "Grupos" => 0,
            "Cuartos" => 1,
            "Semifinal" => 2,
            "Final" => 3,
            "Campeón" => 4
        );
        
        foreach ($couples as $couple) {
            //fill championship statistics
            $localVictories = $this->confrontationMapper->countLocalVictories($couple->getIdPartner());
            $visitantVictories = $this->confrontationMapper->countVisitantVictories($couple->getIdPartner());
            $localDefeats = $this->confrontationMapper->countLocalDefeats($couple->getIdPartner());
            $visitantDefeats = $this->confrontationMapper->countVisitantDefeats($couple->getIdPartner());
            $position = $this->confrontationMapper->getBestResult($couple->getIdPartner());
            if ($position != NULL && $positionValues[$position] > $positionValues[$bestPosition])
                $bestPosition = $position;
            
            $couple->setVictories($localVictories + $visitantVictories);
            $couple->setDefeats($localDefeats + $visitantDefeats);
            
            $totalVictories += $couple->getVictories();
            $totalDefeats += $couple->getDefeats();
            if ($couple->getTotalMatches() > $matchWithCouple) {
                $usualCouple = $couple->getIdCaptain() . " - " . $couple->getIdFellow();
                $matchWithCouple = $couple->getTotalMatches();
            }
            
            
            //fill couples statistics
            array_push($couplesStatistics, array(
                "left" => $couple->getIdCaptain() . " - " . $couple->getIdFellow(),
                "rigth" => $couple->getVictoryRate()
            ));
            
            array_push($couplesMatches, array(
                "left" => $couple->getIdCaptain() . " - " . $couple->getIdFellow(),
                "rigth" => $couple->getTotalMatches()
            ));
        }
        
        array_push($championshipStatistics, array(
            "left" => "Total matches",
            "rigth" => $totalVictories + $totalDefeats
        ));
        array_push($championshipStatistics, array(
            "left" => "Total victories",
            "rigth" => $totalVictories
        ));
        array_push($championshipStatistics, array(
            "left" => "Total defeats",
            "rigth" => $totalDefeats
        ));
        if ($totalVictories + $totalDefeats > 0) {
            array_push($championshipStatistics, array(
                "left" => "Victory Rate",
                "rigth" => round(($totalVictories / ($totalVictories + $totalDefeats) * 100),2) . "%"
            ));
        }
        array_push($championshipStatistics, array(
            "left" => "Usual couple",
            "rigth" => $usualCouple
        ));
        array_push($championshipStatistics, array(
            "left" => "Best position",
            "rigth" => $bestPosition
        ));
        
        

      
        
        
        array_push($statistics, $championshipStatistics);
        array_push($statistics, $couplesStatistics);
        array_push($statistics, $couplesMatches);
        
        
        $this->view->setVariable("title", "Personal statistics");
        $this->view->setVariable("statistics", $statistics);
        $this->view->setVariable("titles", $titles);
        $this->view->render("statistics", "show");
    }
}
