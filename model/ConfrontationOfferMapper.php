<?php

require_once(__DIR__."/../core/PDOConnection.php");

/**
* Class ConfrontationOfferMapper
*
* Database interface for ConfrontationOffer entities
*
*/
class ConfrontationOfferMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}




	/**
	* Saves a ConfrontationOffer into the database
	*
	* @param ConfrontationOffer $confrontationOffer The match offer to be saved
	* @throws PDOException if a database error occurs
	* @return void
	*/
	public function save(ConfrontationOffer $confrontationOffer) {
		$stmt = $this->db->prepare("INSERT INTO ofertaenfrentamiento (idPareja, fecha, hora)
												values (?,?,?)");
		$stmt->execute(array($confrontationOffer->getIdPareja(),
                $confrontationOffer->getFecha(),
							 $confrontationOffer->getHora(),
							));
	}

	/**
	* Delete a ConfrontationOffer
	*
	* @throws PDOException if a database error occurs
	*/
	public function delete($idOfertaEnfrentamiento){
		$stmt = $this->db->prepare("DELETE FROM ofertaenfrentamiento where idOfertaEnfrentamiento=?");
		$stmt->execute(array($idOfertaEnfrentamiento));
	}
}
