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
class OrganizeMatchMapper {

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
	* @param OrganizeMatch $organizeMarch The match to be saved
	* @throws PDOException if a database error occurs
	* @return void
	*/
	public function save(OrganizeMatch $organizeMarch) {
		$stmt = $this->db->prepare("INSERT INTO organizarpartido (fecha, hora)
												values (?,?)");
		$stmt->execute(array($organizeMarch->getFecha(),
							 $organizeMarch->getHora(),
							));
	}

	/**
	* Find all the matches organized by an admin
	*
	* @throws PDOException if a database error occurs
	* @return Array $organizedMatchesArray
	*/
	public function findAll(){
		$stmt = $this->db->query("SELECT * FROM organizarpartido ORDER BY fecha, hora");
		$organizedMatches = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$organizedMatchesArray = array();

		foreach ($organizedMatches as $match) {
			$fecha = new DateTime($match["fecha"]);

			$organizedMatch = new OrganizeMatch($fecha->format('d-m-Y'), substr($match["hora"], 0, 5));
			$organizedMatch-> setIdOrganizarPartido($match["idOrganizarPartido"]);
			array_push( $organizedMatchesArray, $organizedMatch );
		}

		return $organizedMatchesArray;
	}

	public function exist($id){
		$stmt = $this->db->prepare("SELECT * FROM organizarpartido WHERE idOrganizarPartido =?");
		$stmt->execute(array($id));
		$match = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if( $match != null ){
			return true;
		}
		else {
			return null;
		}
	}

	public function findMatchWithParticipants($id){
		$stmt = $this->db->prepare("SELECT
			O.idOrganizarPartido as 'organizarpartido.idOrganizarPartido',
			O.fecha as 'organizarpartido.fecha',
			O.hora as 'organizarpartido.hora',
			P.idOrganizarPartido as 'participantespartido.idOrganizarPartido',
			P.loginUsuario as 'participantespartido.loginUsuario'
			FROM organizarpartido O LEFT OUTER JOIN participantespartido P
			ON O.idOrganizarPartido = P.idOrganizarPartido
			WHERE
			O.idOrganizarPartido=? ");

			$stmt->execute(array($id));
			$match_wt_participants = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if (sizeof($match_wt_participants) > 0) {

				$organizeMatch = new OrganizeMatch($id,
				$match_wt_participants[0]["organizarpartido.fecha"],
				substr($match_wt_participants[0]["organizarpartido.hora"], 0, 5));

				$participants_array = array();

				if ($match_wt_participants[0]["organizarpartido.idOrganizarPartido"]!=null) {
					foreach ($match_wt_participants as $participant){
						array_push($participants_array, $participant["participantespartido.loginUsuario"]);
					}
				}
				$organizeMatch->setParticipants($participants_array);

				return $organizeMatch;
			}else {
				return NULL;
			}

	}

	/**
	* Delete an organize Match
	*
	* @throws PDOException if a database error occurs
	*/
	public function borrar($idOrganizarPartido){
		$stmt = $this->db->prepare("DELETE FROM organizarpartido where idOrganizarPartido=?");
		$stmt->execute(array($idOrganizarPartido));
	}
}
