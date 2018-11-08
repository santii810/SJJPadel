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
class PartnergroupMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	/**
	* Saves a User into the database
	*
	* @param User $user The user to be saved
	* @throws PDOException if a database error occurs
	* @return void
	*/
	public function save($partnergroup) {
		$stmt = $this->db->prepare("INSERT INTO parejagrupo (idPareja,idGrupo) 
												values (?,?)");
		$stmt->execute(array($partnergroup->getIdPartner(),
							 $partnergroup->getIdGroup(),
							));
	}

	public function getIdParejasGrupo($idGrupo){

		$stmt = $this->db->prepare("SELECT * FROM parejagrupo WHERE idGrupo = ? ");
		$stmt->execute(array($idGrupo));
		
		$toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$partnergroups = array();

		foreach ($toret_db as $partnergroup) {
			array_push($partnergroups, new Partnergroup(
				$partnergroup["idPareja"],
				$partnergroup["idGrupo"]
			 	));
		}

		return $partnergroups;
	}
}
