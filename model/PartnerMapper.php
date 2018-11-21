<?php
// file: model/PostMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Partner.php");

/**
* Class PostMapper
*
* Database interface for Post entities
*
* @author lipido <lipido@gmail.com>
*/
class PartnerMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function save($partner) {
		$stmt = $this->db->prepare("INSERT INTO pareja(idCapitan,idCompañero,idCategoriaCampeonato) values (?,?,?)");
		$stmt->execute(array($partner->getIdCaptain(), $partner->getIdFellow(),$partner->getIdCategoryChampionship()));
		return $this->db->lastInsertId();
	}

	public function existeParejaCategoria($login,$idCategoriaCampeonato){
		$stmt = $this->db->prepare("SELECT * FROM pareja
									WHERE idCategoriaCampeonato = ? AND
										  ( idCapitan = ? || idCompañero = ? )
									");
		$stmt->execute(array($idCategoriaCampeonato,$login,$login));

		if ($stmt->rowCount() == 0) {
			return false;
		} else {
			return true;
		}
	}

	public function devolverPareja($idCapitan,$idCompañero,$idCategoria){
		$stmt = $this->db->prepare("SELECT * FROM pareja
									WHERE idCapitan = ? AND
										  idCompañero = ? AND
										  idCategoria = ? "
                      					  );
		$stmt->execute(array($idCapitan,$idCompañero,$idCategoria));

		$toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$pareja = null;

		foreach ($toret_db as $datos) {
			$pareja = new Partner(
				$datos['idPareja'],
				$datos['idCapitan'],
				$datos['idCompañero'],
				$datos['idCategoria']
			);
		}

		return $pareja;

	}

	public function getParejas(){
		$stmt = $this->db->query("SELECT idPareja,idCapitan,idCompañero
								  FROM  pareja");
		$toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$toret = array();

		//devulve array[idPareja] = idCapitan-idCompañero
		foreach ($toret_db as $datos) {
			$toret[$datos['idPareja']] = $datos['idCapitan']." ".$datos['idCompañero'];
		}

		return $toret;
	}

	public function getPartnerNames($idPartner){
	    $stmt = $this->db->prepare("SELECT concat(idCapitan,\" - \", idCompañero) as names FROM `pareja` WHERE idPareja = ?");

	    $stmt->execute(array($idPartner));

	    $toret_db = $stmt->fetch(PDO::FETCH_ASSOC);
	    return $toret_db["names"];
	}


	public function getMyParners($user){
		$stmt = $this->db->prepare("SELECT * FROM `pareja` WHERE  idCapitan = ? || idCompañero = ?");
		$stmt->execute(array($user, $user));
		$toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$partner_array = array();

		if($toret_db != null ){
			foreach( $toret_db as $partner ){
				$partner_o = new Partner( $partner["idPareja"], $partner["idCapitan"], $partner["idCompañero"], $partner["idCategoriaCampeonato"] );
				array_push($partner_array, $partner_o);
			}
			return $partner_array;
		}
		return null;
	}

	public function getIdCapitan($idPareja){
		$stmt = $this->db->prepare("SELECT idCapitan FROM pareja WHERE idPareja=?");
		$stmt->execute(array($idPareja));
		$toret_db = $stmt->fetch(PDO::FETCH_ASSOC);

		if($toret_db != null ){
			return $toret_db["idCapitan"];
		}
	}

	public function getMembers($idPareja){
		$stmt = $this->db->prepare("SELECT * FROM pareja WHERE idPareja=?");
		$stmt->execute(array($idPareja));
		$toret_db = $stmt->fetch(PDO::FETCH_ASSOC);

		$members = array();

		if($toret_db != null){
			array_push($members, $toret_db["idCapitan"]);
			array_push($members, $toret_db["idCompañero"]);
		}

		return $members;

	}

}
