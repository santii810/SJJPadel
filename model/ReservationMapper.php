<?php
// file: model/ReservationMapper.php
require_once (__DIR__ . "/../core/PDOConnection.php");

require_once (__DIR__ . "/../model/User.php");
require_once (__DIR__ . "/../model/Partner.php");

/**
* Clase ReservationMapper
*
* Interfaz de base de datos para entidades ReservationMapper
*
*
*/
class ReservationMapper
{
    /**
     * Referencia a conexión PDO
     *
     * @var PDO
     */
    private $db;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }

    /**
     * Devuelve todas las reservas
     *
     *
     * @return mixed Reservation
     */
    public function getReservations()
    {
        // SELECT count(fechaReserva), fechaReserva, horaReserva FROM reserva WHERE fechaReserva BETWEEN curdate() AND curdate()+7 group by fechaReserva, horaReserva
        $stmt = $this->db->prepare("SELECT * FROM reserva WHERE fechaReserva BETWEEN CURDATE() AND CURDATE() + 7 ORDER BY fechaReserva, horaReserva");
        $stmt->execute();

        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $torretReservations = array();

        foreach ($toret_db as $reservation) {
            array_push($torretReservations, new Reservation($reservation["idReserva"], $reservation["idUsuarioReserva"], $reservation["fechaReserva"], $reservation["horaReserva"]));
        }
        return $torretReservations;
    }

    /**
     * Guarda una reserva
     *
     * @param $reservation
     * @return void
     */
    public function makeReservation($reservation)
    {
        $stmt = $this->db->prepare("INSERT INTO reserva (idUsuarioReserva, fechaReserva, horaReserva) values (?,?,?)");
        $stmt->execute(array(
            $reservation->getIdUserReservation(),
            $reservation->getDateReservation(),
            $reservation->getHourReservation()
        ));
    }

    /**
     * Devuelve número de reservas en una fecha y hora
     *
     * @param $date, $hour
     * @return int
     */
    public function getNumReservations($date, $hour)
    {
        $stmt = $this->db->prepare("SELECT count(*) as numPistas FROM reserva WHERE fechaReserva  = ? AND horaReserva = ?");
        $date = date("Y-m-d", strtotime($date));
        $stmt->execute(array(
            $date,
            $hour
        ));

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $lastPista = $result["numPistas"];
        return $lastPista;
    }

    /**
     * Devuelve número total de reservas
     *
     *
     * @return int
     */
    public function getReservationCount()
    {
        $stmt = $this->db->prepare("SELECT count(fechaReserva) as numReservas, fechaReserva, horaReserva FROM reserva WHERE fechaReserva BETWEEN curdate() AND curdate()+7 group by fechaReserva, horaReserva");
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $torretReservations = array();

        foreach ($results as $result) {
            array_push($torretReservations, array(
                "fecha" => $result["fechaReserva"],
                "hora" => $result["horaReserva"],
                "numReservas" => $result["numReservas"]
            ));
        }
        return $torretReservations;
    }

    /**
     * Devuelve el id de una reserva
     *
     * @param $idUsuarioReserva, $fechaReserva, $horaReserva
     * @return int
     */
    public function getReservationId($idUsuarioReserva, $fechaReserva, $horaReserva)
    {
        $stmt = $this->db->prepare("SELECT * FROM reserva WHERE idUsuarioReserva=? AND fechaReserva=? AND horaReserva=?");
        $stmt->execute(array(
            $idUsuarioReserva,
            $fechaReserva,
            $horaReserva
        ));
        $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($reservation != null) {
            return $reservation["idReserva"];
        }
        return null;
    }

    /**
     * Devuelve los datos de una reserva
     *
     * @param $idReservation
     * @return Reservation
     */
    public function getReservation($idReservation)
    {
        $stmt = $this->db->prepare("SELECT * FROM reserva WHERE idReserva = ?");
        $stmt->execute(array(
            $idReservation
        ));
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($results != null) {
            return new Reservation($results["idReserva"], $results["idUsuarioReserva"], $results["fechaReserva"], $results["horaReserva"]);
        }
    }

    /**
     * Devuelve los datos estadísticos de una reserva
     *
     *
     * @return mixed estadística
     */
    public function getReservationDayStatistics()
    {
        $stmt = $this->db->prepare("SELECT count(idReserva) as num, dayofweek(fechaReserva) as day FROM reserva group by DAYOFWEEK(fechaReserva)");
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $torretReservations = array();
        $days = array(
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday",
            "Sunday"
        );

        foreach ($results as $result) {
            array_push($torretReservations, array(
                "left" => $days[$result["day"] - 1],
                "rigth" => $result["num"]
            ));
        }
        return $torretReservations;
    }

    /**
     * Devuelve los datos estadísticos de una reserva en una hora determinada
     *
     *
     * @return mixed estadística
     */
    public function getReservationHourStatistics()
    {
        $stmt = $this->db->prepare("SELECT count(idReserva) as num, horaReserva FROM reserva group by horaReserva");
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $torretReservations = array();

        foreach ($results as $result) {
            array_push($torretReservations, array(
                "left" => $result["horaReserva"],
                "rigth" => $result["num"]
            ));
        }
        return $torretReservations;
    }

    /**
     * Devuelve los datos estadísticos al comiezo de las reservas
     *
     *
     * @return mixed estadística
     */
    public function getReservationComingStatistics()
    {
      $stmt = $this->db->prepare("SELECT count(idReserva) as num, horaReserva, fechaReserva
                  FROM reserva
                  group by horaReserva, fechaReserva
                  having fechaReserva >= curdate() AND fechaReserva < curdate()+7");
      $stmt->execute();

      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $torretReservations = array();

        foreach ($results as $result) {
            array_push($torretReservations, array(
                "left" => $result["fechaReserva"]. " - " .$result["horaReserva"],
                "rigth" => $result["num"]
            ));
        }
        return $torretReservations;
    }

    /**
     * Devuelve las reservas de un usuario
     *
     * @param $login
     * @return mixed Reservation
     */
    public function getUserReservations($login){
      $stmt = $this->db->prepare("SELECT * FROM reserva WHERE idUsuarioReserva = ? AND fechaReserva >= CURDATE() ORDER BY fechaReserva");
      $stmt->execute(array( $login ));
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $torretReservations = array();

      foreach ($results as $result) {
          $fecha = new DateTime($result["fechaReserva"]);
          array_push($torretReservations, new Reservation($result["idReserva"], $result["idUsuarioReserva"], $fecha->format('d-m-Y'), $result["horaReserva"]));
      }
      return $torretReservations;
    }

    /**
     * Guarda una reserva
     *
     * @param $reservation
     * @return void
     */
    public function saveWithReturn($reservation)
    {
        $stmt = $this->db->prepare("INSERT INTO reserva (idUsuarioReserva, fechaReserva, horaReserva) values (?,?,?)");
        $stmt->execute(array(
            $reservation->getIdUserReservation(),
            $reservation->getDateReservation(),
            $reservation->getHourReservation()
        ));
        return $this->db->lastInsertId();
    }

    /**
     * Elimina una reserva
     *
     * @param $idReserva
     * @return void
     */
    public function delete($idReserva)
    {
        $stmt = $this->db->prepare("DELETE FROM reserva where idReserva=?");
        $stmt->execute(array( $idReserva ));
    }

}
