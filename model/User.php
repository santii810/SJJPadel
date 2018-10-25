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

	private $username;	
	private $surname;
	private $pass;
	private $rol;
	private $gender;
	
	public function __construct($username=NULL, $passwd=NULL) {
		$this->username = $username;
		$this->passwd = $passwd;
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
		$this->passwd = $pass;
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
		if (strlen($this->username) < 5) {
			$errors["username"] = "Username must be at least 5 characters length";

		}
		if (strlen($this->surname) < 5) {
			$errors["surname"] = "Surname must be at least 5 characters length";

		}
		if (strlen($this->pass) < 5) {
			$errors["pass"] = "Password must be at least 5 characters length";
		}
		if (strlen($this->rol) < 5) {
			$errors["rol"] = "Rol must be at least 5 characters length";

		}
		if (strlen($this->gender) < 5) {
			$errors["gender"] = "Gender must be at least 5 characters length";

		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "user is not valid");
		}
	}
}
