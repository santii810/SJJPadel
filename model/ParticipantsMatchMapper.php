<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");


class ParticipantsMatchMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}


	public function play($idOrganizeMatch, $userLogin){
		$stmt = $this->db->prepare("SELECT * FROM participantespartido WHERE idOrganizarPartido =? AND loginUsuario=?");
		$stmt->execute(array($idOrganizeMatch, $userLogin));
		$play = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if( $play != null ){
			$play = true;
		}
		else{
			$play = false;
		}
		return $play;
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

	public function count($idOrganizeMatch){
		$stmt = $this->db->prepare("SELECT COUNT(*) as count FROM participantespartido WHERE idOrganizarPartido =?");
		$stmt->execute(array($idOrganizeMatch));
		$count = $stmt->fetch(PDO::FETCH_ASSOC);

		return $count["count"];

	}

	/**
	* Delete an organize Match
	*
	* @throws PDOException if a database error occurs
	*/
	public function cancel($idOrganizeMatch, $userLogin){
		$stmt = $this->db->prepare("DELETE FROM participantespartido where idOrganizarPartido=? AND loginUsuario=?");
		$stmt->execute(array($idOrganizeMatch, $userLogin));
	}
}
