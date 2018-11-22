<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");


class PartnergroupMapper {


	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}


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

	public function getIdGrupo($idPareja){

		$stmt = $this->db->prepare("SELECT idGrupo FROM parejagrupo WHERE idPareja = ? ");
		$stmt->execute(array($idPareja));
		$toret_db = $stmt->fetch(PDO::FETCH_ASSOC);

		return $toret_db["idGrupo"];
	}

	public function hasGroup($idPareja){
		$stmt = $this->db->prepare("SELECT COUNT(*) as count FROM parejagrupo WHERE idPareja = ? ");
		$stmt->execute(array($idPareja));
		$toret_db = $stmt->fetch(PDO::FETCH_ASSOC);

		if($toret_db["count"] == 0){
			return false;
		}
		else{
			return true;
		}

	}


}
