<?php

require_once (__DIR__ . "/../core/ValidationException.php");

/**
* Clase Fase
*
* Representa los grupos de una categoria
* Contiene los atributos del objecto grupo
*
*/

class Group
{
    /**
    * Id del grupo
    * @var int
    */
    private $idGroup;

    /**
    * Id de la categoria
    * @var int
    */
    private $idCategory;

    /**
    * Id del campeonato
    * @var int
    */
    private $idChampionship;

    /**
    * Nombre del grupo
    * @var string
    */
    private $groupName;

    public function __construct($idGroup = NULL, $idCategory = NULL, $idChampionship = NULL, $groupName = NULL)
    {
        $this->idGroup = $idGroup;
        $this->idCategory = $idCategory;
        $this->idChampionship = $idChampionship;
        $this->groupName = $groupName;
    }

    public function getIdGroup()
    {
        return $this->idGroup;
    }

    public function getIdCategory()
    {
        return $this->idCategory;
    }

    public function setIdCategory($id)
    {
        $this->idCategory = $id;
    }

    public function getIdChampionship()
    {
        return $this->idChampionship;
    }

    public function setIdChampionship($id)
    {
        $this->idChampionship = $id;
    }

    public function getGroupName()
    {
        return $this->groupName;
    }

    public function setGroupName($name)
    {
        $this->groupName = $name;
    }

    /**
    * Comprueba si la instancia actual es válida
    * Por estar actualizado en la base de datos.
    *
    * @throws ValidationException si la instancia es
    * no es válido
    *
    * @return void
    */
    public function checkIsValidForRegister()
    {
        $errors = array();
        if (strlen(trim($this->idCategory)) == 0) {
            $errors["idCategory"] = "idCategory is mandatory";
        }
        if (strlen(trim($this->idChampionship)) == 0) {
            $errors["idChampionship"] = "idChampionship is mandatory";
        }
        if (strlen(trim($this->groupName)) == 0) {
            $errors["groupName"] = "groupName is mandatory";
        }
        if (sizeof($errors) > 0) {
            throw new ValidationException($errors, "group is not valid");
        }
    }
}
