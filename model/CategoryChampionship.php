<?php
require_once (__DIR__ . "/../core/ValidationException.php");
/**
* Clase CategoryChampionship
*
* Representa la relación de una categoria con un campeonato
* Contiene la correspondecia de categorias con campeonatos
* 
*
*/
class CategoryChampionship
{

    /**
    * Id de categoryChampionship
    * @var int
    */
    private $id;

    /**
    * Id del campeonato
    * @var int
    */

    private $idChampionship;

    /**
    * Id de la categoria
    * @var int
    */

    private $idCategory;

    public function __construct($id = NULL, $idChampionship = NULL, $idCategory = NULL)
    {
        $this->id = $id;
        $this->idChampionship = $idChampionship;
        $this->idCategory = $idCategory;
    }

    /**
    * Devuelve id de categoryChampionship
    *
    * @return int
    */

    function getId()
    {
        return $this->id;
    }

    /**
    * Devuelve id del campeonato
    *
    * @return int
    */

    function getIdChampionship()
    {
        return $this->idChampionship;
    }

    /**
    * Devuelve id de la categoria
    *
    * @return int
    */

    function getIdCategory()
    {
        return $this->idCategory;
    }

    /**
    * Cambia categoryChampionship
    *
    * @return void
    */


    function setId($id)
    {
        $this->id = $id;
    }

    /**
    * Cambia valor de IdCampeonato
    *
    * @return void
    */


    function setIdChampionship($idChampionship)
    {
        $this->idChampionship = $idChampionship;
    }

    /**
    * Cambia valor de IdCategory
    *
    * @return void
    */


    function setIdCategory($idCategory)
    {
        $this->idCategory = $idCategory;
    }
}
