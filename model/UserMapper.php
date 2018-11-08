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
class UserMapper {

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
	public function save($user) {
		$stmt = $this->db->prepare("INSERT INTO usuario (login,nombre,apellidos,pass,rol,genero) 
												values (?,?,?,?,?,?)");
		$stmt->execute(array($user->getLogin(),
							 $user->getUsername(),
							 $user->getSurname(),
							 $user->getPass(),
							 $user->getRol(),
							 $user->getGender()
							));
	}

	/**
	* Checks if a given username is already in the database
	*
	* @param string $username the username to check
	* @return boolean true if the username exists, false otherwise
	*/


	public function borrar($login){
		$stmt = $this->db->prepare("DELETE FROM usuario where login=?");
		$stmt->execute(array($login));
	}

	public function editar($login,$nombre,$apellidos,$pass,$rol,$genero){
		$stmt = $this->db->prepare("UPDATE usuario set nombre=?, apellidos=?, pass=?, rol=?, genero=? where login=?");
		$stmt->execute(array($nombre, $apellidos, $pass, $rol, $genero, $login));
	}

	public function loginExists($login) {
		$stmt = $this->db->prepare("SELECT count(login) FROM usuario where login=?");
		$stmt->execute(array($login));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}

	/**
	* Checks if a given pair of username/password exists in the database
	*
	* @param string $username the username
	* @param string $passwd the password
	* @return boolean true the username/passwrod exists, false otherwise.
	*/
	public function isValidUser($login, $pass) {
		$stmt = $this->db->prepare("SELECT count(login) FROM usuario where login=? and pass=?");
		$stmt->execute(array($login, $pass));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}

	public function getDatos($login){
		$stmt = $this->db->prepare("SELECT * FROM usuario where login=?");
		$stmt->execute(array($login));

		$toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$user = null;

		foreach ($toret_db as $datos) {
			$user = new User(
				$datos['login'],
				$datos['nombre'],
				$datos['apellidos'],
				$datos['pass'],
				$datos['rol'],
				$datos['genero']
			);
		}

		return $user;
	}

	public function getUsuarios(){
		$stmt = $this->db->query("SELECT *
								  FROM   usuario");
		$toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$users = array();

		foreach ($toret_db as $user) {
			array_push($users, new User(
				$user['login'],
				$user['nombre'],
				$user['apellidos'],
				$user['pass'],
				$user['rol'],
				$user['genero']
			));
		}

		return $users;

	}


}
