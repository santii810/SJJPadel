<?php
require_once (__DIR__ . "/../core/PDOConnection.php");
require_once (__DIR__ . "/../model/CategoryChampionship.php");

/**
* Clase CategoryChampionshipMapper
*
* Interfaz de base de datos para entidades CategoryChampionshipMapper
* 
*
*/

class CategoryChampionshipMapper
{

    private $db;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }

    /**
     * Guarda un categoryChampionship 
     *
     * @param int $categoryChampionship
     * @return void
     */

    public function save($categoryChampionship)
    {
        $stmt = $this->db->prepare("INSERT INTO categoriascampeonato( idCategoria, idCampeonato ) values (?,?)");
        $stmt->execute(array(
            $categoryChampionship->getIdCategory(),
            $categoryChampionship->getIdChampionship()
        ));
        return $this->db->lastInsertId();
    }

    /**
     * Borra un categoryChampionship 
     *
     * @param int $categoryChampionship
     * @return void
     */

    public function delete($idChampionship, $idCategory)
    {
        $stmt = $this->db->prepare("DELETE FROM categoriascampeonato where idCampeonato=? AND idCategoria=?");
        $stmt->execute(array(
            $idChampionship,
            $idCategory
        ));
    }

    /**
     * Obtiene las categorias de un tederminado campeonato
     *
     * @param int $idChampionship
     * @return Category[] categorias asociadas al campeonato
     */
    function getCategoriesFromChampionship($idChampionship)
    {
        $stmt = $this->db->prepare("SELECT * FROM categoriascampeonato WHERE idCampeonato = ? ");
        $stmt->execute(array(
            $idChampionship
        ));
        
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $toret = array();
        foreach ($toret_db as $data) {
            array_push($toret, new CategoryChampionship($data["idCategoriasCampeonato"], $data["idCampeonato"], $data["idCategoria"]));
        }
        return $toret;
    }

 
    /**
     * Obtiene todas las parejas apuntadas a esa categoria
     * @param int $idCategoryChampionship
     * @return Partner[] parejas de la categoria
     */
    function getCouples($idCategoryChampionship)
    {
        $stmt = $this->db->prepare("SELECT * FROM pareja WHERE idCategoriaCampeonato = ? ");
        $stmt->execute(array(
            $idCategoryChampionship
        ));
        
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $toret = array();
        
        foreach ($toret_db as $data) {
            array_push($toret, new Partner($data["idPareja"], $data["idCapitan"], $data["idCompañero"], $data["idCategoriaCampeonato"]));
        }
        return $toret;
    }

    /**
     * Devuelve todos los categoyChampionship de un campeonato
     *
     * @param CategoryChampionship $categoryChampionship
     * @return CategoryChampionship[]
     */

    function getCategoryFromChampionship($idChampionship, $idCategory)
    {
        $stmt = $this->db->prepare("SELECT * FROM categoriascampeonato
											 WHERE idCampeonato = ? AND
											 	   idCategoria = ? ");
        $stmt->execute(array(
            $idChampionship,
            $idCategory
        ));
        
        $toret_db = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($toret_db != null) {
            return new CategoryChampionship($toret_db["idCategoriasCampeonato"], $toret_db["idCategoria"], $toret_db["idCampeonato"]);
        } else {
            return NULL;
        }
    }

    /**
     * Devuelve campeonato asociado a idCategoryChampionship
     *
     * @param CategoryChampionship $categoryChampionship
     * @return CategoryChampionship[]
     */

    public function getChampionshipFromIdCategory($idCategoriaCampeonato)
    {
        $stmt = $this->db->prepare("SELECT * FROM categoriascampeonato WHERE idCategoriasCampeonato = ? ");
        $stmt->execute(array(
            $idCategoriaCampeonato
        ));
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return new CategoryChampionship($data["idCategoriasCampeonato"], $data["idCampeonato"], $data["idCategoria"]);
    }

    public function existsCategory($idChampionship, $idCategory)
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM categoriascampeonato where idCampeonato=? and idCategoria=?");
        $stmt->execute(array(
            $idChampionship,
            $idCategory
        ));
        
        return $stmt->fetchColumn() > 0;
    }
}
