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
class ParticipantsMatchMapper {

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
	public function save(ParticipantsMatch $paticipantMatch) {
		$stmt = $this->db->prepare("INSERT INTO participantespartido (idOrganizarPartido, loginUsuario)
												values (?,?)");
		$stmt->execute(array($paticipantMatch->getIdOrganizarPartido(),
							 $paticipantMatch->getLoginUsuario(),
							));
	}

	/**
	* Delete an organize Match
	*
	* @throws PDOException if a database error occurs
	*/
	public function borrar($idParticipantesPartido){
		$stmt = $this->db->prepare("DELETE FROM participantespartido where idParticipantesPartido=?");
		$stmt->execute(array($idParticipantesPartido));
	}
}
