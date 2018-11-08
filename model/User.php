<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

/**
* Class User
*
* Represents a User in the blog
*
* @author lipido <lipido@gmail.com>
*/
class User {

	private $login;
	private $username;	
	private $surname;
	private $pass;
	private $rol;
	private $gender;
	
	public function __construct($login=NULL,$username=NULL,$surname=NULL,$pass=NULL,$rol=NULL,$gender=NULL) {
		$this->login = $login;
		$this->username = $username;
		$this->surname = $surname;
		$this->pass = $pass;
		$this->rol = $rol;
		$this->gender = $gender;
	}

	public function getLogin() {
		return $this->login;
	}

	public function setLogin($login) {
		$this->login = $login;
	}

	public function getUsername() {
		return $this->username;
	}

	public function setUsername($username) {
		$this->username = $username;
	}

	public function getSurname() {
		return $this->surname;
	}

	public function setSurname($surname) {
		$this->surname = $surname;
	}

	public function getPass() {
		return $this->pass;
	}
	
	public function setPass($pass) {
		$this->pass = $pass;
	}

	public function getRol() {
		return $this->rol;
	}

	public function setRol($rol) {
		$this->rol = $rol;
	}

	public function getGender() {
		return $this->gender;
	}

	public function setGender($gender) {
		$this->gender = $gender;
	}

	public function checkIsValidForRegister() {
		$errors = array();
		if (strlen($this->login) < 3) {
			$errors["login"] = "login must be at least 3 characters length";

		}
		if (strlen($this->username) < 3) {
			$errors["username"] = "Username must be at least 3 characters length";

		}
		if (strlen($this->surname) < 3) {
			$errors["surname"] = "Surname must be at least 3 characters length";

		}
		if (strlen($this->pass) < 3) {
			$errors["pass"] = "Password must be at least 3 characters length";
		}
		if (strlen($this->rol) < 1) {
			$errors["rol"] = "Rol must be at least 1 characters length";

		}
		if (strlen($this->gender) < 1) {
			$errors["gender"] = "Gender must be at least 1 characters length";

		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "user is not valid");
		}
	}
}
