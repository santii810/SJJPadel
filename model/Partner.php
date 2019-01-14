<?php

require_once (__DIR__ . "/../core/ValidationException.php");

/**
* Clase Partner
*
* Representa una pareja de un campeonato
* Contiene los atributos del objecto pareja
* 
*
*/
class Partner
{
    /**
    * Id de la pareja
    * @var int
    */
    private $idPartner;

    /**
    * Id del capitan
    * @var int
    */
    private $idCaptain;

    /**
    * Id del compañero
    * @var int
    */
    private $idFellow;

    /**
    * Id de la categoria relacionada a un campeonato
    * @var int
    */
    private $idCategoryChampionship;

    /**
    * victorias de la pareja
    * @var int
    */
    private $victories;

    /**
    * derrotas de la pareja
    * @var int
    */
    private $defeats;

    public function __construct($idPartner = NULL, $idCaptain = NULL, $idFellow = NULL, $idCategoryChampionship = NULL)
    {
        $this->idPartner = $idPartner;
        $this->idCaptain = $idCaptain;
        $this->idFellow = $idFellow;
        $this->idCategoryChampionship = $idCategoryChampionship;
    }

    public function getIdPartner()
    {
        return $this->idPartner;
    }

    public function getIdCaptain()
    {
        return $this->idCaptain;
    }

    public function setIdCaptain($id)
    {
        $this->idCaptain = $id;
    }

    public function getIdFellow()
    {
        return $this->idFellow;
    }

    public function setIdFellow($id)
    {
        $this->idFellow = $id;
    }

    public function getIdCategoryChampionship()
    {
        return $this->idCategoryChampionship;
    }

    public function setIdCategoryChampionship($id)
    {
        $this->idCategoryChampionship = $id;
    }

    public function getVictories()
    {
        return $this->victories;
    }

    public function getDefeats()
    {
        return $this->defeats;
    }

    public function setVictories($victories)
    {
        $this->victories = $victories;
    }

    public function setDefeats($defeats)
    {
        $this->defeats = $defeats;
    }

    public function getVictoryRate()
    {
        if ($this->getTotalMatches() > 0)
            return $this->victories / $this->getTotalMatches();
        else
            return "-";
    }

    public function getTotalMatches()
    {
        return $this->defeats + $this->victories;
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
        if (strlen(trim($this->idCaptain)) == 0) {
            $errors["idCaptain"] = "idCapitan es obligatorio";
        }
        if (strlen(trim($this->idFellow)) == 0) {
            $errors["idFellow"] = "idCompañero es obligatorio";
        }
        if (strlen(trim($this->idCategoryChampionship)) == 0) {
            $errors["idCategoryChampionship"] = "idCategoryChampionship is mandatory";
        }
        if (sizeof($errors) > 0) {
            throw new ValidationException($errors, "compañero no es valido");
        }
    }
}
