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
		$stmt = $this->db->prepare("INSERT INTO pareja(idCapitan,idCompañero,idCategoria) values (?,?,?)");
		$stmt->execute(array($partner->getIdCaptain(), $partner->getIdFellow(),$partner->getIdCategory()));
		return $this->db->lastInsertId();
	}

	public function comprobarParejaCategoria($idGrupo,$login) {
		$stmt = $this->db->prepare("SELECT * FROM pareja p,parejagrupo pg,grupo g 
									WHERE p.idPareja = pg.idPareja AND
        			  					  pg.idGrupo = g.idGrupo AND
                      					  g.idGrupo = ? AND
                      					  ( p.idCapitan = ? OR 
                      					  p.idCompañero = ? )"
                      					  );
		$stmt->execute(array($idGrupo,$login,$login));

		if ($stmt->rowCount() == 0) {
			return true;
		} else {
			return false;
		}
	}

	public function existeParejaCategoria($idCapitan,$idCompañero,$idCategoria){
		$stmt = $this->db->prepare("SELECT * FROM pareja 
									WHERE idCapitan = ? AND
										  idCompañero = ? AND
										  idCategoria = ? "
                      					  );
		$stmt->execute(array($idCapitan,$idCompañero,$idCategoria));

		if ($stmt->rowCount() == 0) {
			return true;
		} else {
			return false;
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
								  FROM   pareja");
		$toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$toret = array();

		//devulve array[idPareja] = idCapitan-idCompañero
		foreach ($toret_db as $datos) {
			$toret[$datos['idPareja']] = $datos['idCapitan']." ".$datos['idCompañero'];
		}

		return $toret;
	}
	
}
