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

	public function getConfrontationOffersForGroup($idGrupo){
		$stmt = $this->db->prepare("SELECT * FROM ofertaenfrentamiento WHERE idGrupo=?");
		$stmt->execute(array($idGrupo));
		$ofertasEnfrentamientos = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$enfrentamientos_array = array();

		if( $ofertasEnfrentamientos != null){
			foreach ($ofertasEnfrentamientos as $enfrentamiento) {
				$enf = new ConfrontationOffer($enfrentamiento["idOfertaEnfrentamiento"],$enfrentamiento["idPareja"], 
												$enfrentamiento["idGrupo"], $enfrentamiento["hora"], $enfrentamiento["fecha"]);
				array_push($enfrentamientos_array, $enf);
			}
		}
		return $enfrentamientos_array;
	}



	/**
	* Saves a ConfrontationOffer into the database
	*
	* @param ConfrontationOffer $confrontationOffer The match offer to be saved
	* @throws PDOException if a database error occurs
	* @return void
	*/
	public function save(ConfrontationOffer $confrontationOffer) {
		$stmt = $this->db->prepare("INSERT INTO ofertaenfrentamiento (idPareja, idGrupo,fecha, hora)
												values (?,?,?)");
		$stmt->execute(array($confrontationOffer->getIdPareja(),
								$confrontationOffer->getIdGrupo(),
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
