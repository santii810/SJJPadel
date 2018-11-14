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
class CategoryMapper {

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
	
	function esGeneroAceptado($idCategoria,$genero){
		$stmt = $this->db->prepare("SELECT sexo FROM categoria WHERE idCategoria = ? "
                      					  );
		$stmt->execute(array($idCategoria));

		$toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$sexo = '';

		foreach ($toret_db as $datos) {
			$sexo = $datos['sexo'];
		}

		if ($sexo == 'mixto') {
			return true;
		} else if($sexo == $genero) {
			return true;
		} else {
			return false;
		}
	}

}
