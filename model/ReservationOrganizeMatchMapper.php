<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");

/**
* Class UserMapper
*
* Database interface for User entities
*
* @author lipido <lipido@gmail.com>
*/
class ReservationOrganizeMatchMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

  /**
  * Saves a OrganizeMatch into the database
  *
  * @param ParticipantsMatch $paticipantMatch The participant to be saved
  * @throws PDOException if a database error occurs
  * @return void
  */
  public function save($idReserva, $idOrganizarPartido) {
    $stmt = $this->db->prepare("INSERT INTO reservaorganizarpartido (idReserva, idOrganizarPartido)
                        VALUES (?,?)");
    $stmt->execute(array($idReserva, $idOrganizarPartido));
  }

}
