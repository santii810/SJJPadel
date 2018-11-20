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

/*
	public function joinPartnerConfrontationOffer($idPareja){
		$stmt = $this->db->prepare("SELECT
			P.idPareja as 'parejagrupo.idPareja',
			P.idGrupo as 'parejagrupo.idGrupo',
			O.idOfertaEnfrentamiento as 'ofertaenfrentamiento.idOfertaEnfrentamiento',
			O.idPareja as 'ofertaenfrentamiento.idPareja',
			O.hora as 'ofertaenfrentamiento.hora',
			O.fecha as 'ofertaenfrentamiento.fecha',
			FROM parejagrupo P LEFT OUTER JOIN ofertaenfrentamiento O
			ON O.idOrganizarPartido = P.idOrganizarPartido
			WHERE
			P.idPareja = ? AND P.idGrupo = ¿O.idGrupo? ");

			$stmt->execute(array($id));
			$match_wt_participants = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	*/
}
