<?php

require_once (__DIR__ . "/../core/ValidationException.php");

/**
* Clase PartnerGroup
*
* Representa la pareja de un grupo
* Contiene los atributos del objecto PartnerGroup
* 
*
*/
class PartnerGroup
{
    /**
    * Id de la pareja
    * @var int
    */
    private $idPartner;

    /**
    * Id del grupo
    * @var int
    */
    private $idGroup;

    public function __construct($idPartner = NULL, $idGroup = NULL)
    {
        $this->idPartner = $idPartner;
        $this->idGroup = $idGroup;
    }

    public function getIdPartner()
    {
        return $this->idPartner;
    }

    public function setIdPartner($id)
    {
        $this->idPartner = $id;
    }

    public function getIdGroup()
    {
        return $this->idGroup;
    }

    public function setIdGroup($id)
    {
        $this->idGroup = $id;
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
        if (strlen(trim($this->idPartner)) == 0) {
            $errors["idPartner"] = "idPartner is mandatory";
        }
        if (strlen(trim($this->idGroup)) == 0) {
            $errors["idGroup"] = "idGroup is mandatory";
        }
        
        if (sizeof($errors) > 0) {
            throw new ValidationException($errors, "GroupPartner is not valid");
        }
    }
}
