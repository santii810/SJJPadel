<?php
// file: model/UserMapper.php
require_once (__DIR__ . "/../core/PDOConnection.php");

/**
* Clase CategoryMapper
*
* Interfaz de base de datos para entidades CategoryMapper
* 
*
*/

class CategoryMapper
{

    /**
     * Referencia a conexión PDO
     *
     * @var PDO
     */
    private $db;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }

    /**
     * Guarda categoria
     *
     * @param Category $category
     *            
     * @throws PDOException si falla base de datos
     * @return void
     */
    public function save($category)
    {
        $stmt = $this->db->prepare("INSERT INTO categoria (nivel,sexo) 
                        values (?,?)");
        $stmt->execute(array(
            $category->getNivel(),
            $category->getSexo()
        ));
    }

    /**
     * elimina categoria
     *
     * @param $id
     *            
     * @throws PDOException si falla base de datos
     * @return void
     */

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM categoria where idCategoria=?");
        $stmt->execute(array(
            $id
        ));
    }

    /**
     * Edita categoria
     *
     * @param $level,$sex,$id
     *            
     * @throws PDOException si falla base de datos
     * @return void
     */

    public function edit($level, $sex, $id)
    {
        $stmt = $this->db->prepare("UPDATE categoria set nivel=?, sexo=? where idCategoria =?");
        $stmt->execute(array(
            $level,
            $sex,
            $id
        ));
    }

    /**
     * Devuelve datos de una categoria
     *
     * @param $id
     *            
     * @throws PDOException si falla base de datos
     * @return Category
     */

    public function getDatos($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM categoria where idCategoria=?");
        $stmt->execute(array(
            $id
        ));
        
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $category = null;
        
        foreach ($toret_db as $datos) {
            $category = new Category($datos['idCategoria'], $datos['nivel'], $datos['sexo']);
        }
        
        return $category;
    }

    /**
     * Comprueba el genero de la categoria con el del usuario
     *
     * @param $idCategoria,$genero
     *            
     * @throws PDOException si falla base de datos
     * @return boolean
     */

    public function esGeneroAceptado($idCategoria, $genero)
    {
        $stmt = $this->db->prepare("SELECT sexo FROM categoria WHERE idCategoria = ? ");
        $stmt->execute(array(
            $idCategoria
        ));
        
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $sexo = '';
        
        foreach ($toret_db as $datos) {
            $sexo = $datos['sexo'];
        }
        
        if ($sexo == 'mixto') {
            return true;
        } else if ($sexo == $genero) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Guarda categoria
     *
     * 
     *            
     * @throws PDOException si falla base de datos
     * @return mixed of Category
     */

    public function getCategorias()
    {
        $stmt = $this->db->prepare("SELECT * FROM categoria");
        $stmt->execute();
        
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $categoriesToret = array();
        
        foreach ($toret_db as $category) {
            array_push($categoriesToret, new Category($category["idCategoria"], $category["nivel"], $category["sexo"]));
        }
        
        return $categoriesToret;
    }

    /**
     * Devuelve categoria
     *
     * @param $IdCategory
     *            
     * @throws PDOException si falla base de datos
     * @return Category
     */

    public function getCategory($idCategory)
    {
        $stmt = $this->db->prepare("SELECT * FROM categoria WHERE idCategoria = ?");
        $stmt->execute(array(
            $idCategory
        ));
        
        $toret_db = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($toret_db != null) {
            return new Category($toret_db["idCategoria"], $toret_db["nivel"], $toret_db["sexo"]);
        }
    }

    /**
     * Comprueba si la categoria existe
     *
     * @param Category $category
     *            
     * @throws PDOException si falla base de datos
     * @return boolean
     */

    public function categoryExists(Category $category)
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM categoria where nivel=? AND sexo=?");
        $stmt->execute(array(
            $category->getNivel(),
            $category->getSexo()
        ));
        
        if ($stmt->fetchColumn() > 0) {
            return true;
        }
    }

    /**
     * Devuelve las parejas de una categoria pertenecientes a un campeonato
     *
     * @param Category $category
     *            
     * @throws PDOException si falla base de datos
     * @return mixed
     */

    public function getCouplesPerCategory()
    {
        $stmt = $this->db->prepare("SELECT count(idPareja) as num,  sexo, nivel
                                FROM pareja p, categoriasCampeonato c , categoria ca 
                                WHERE p.idCategoriaCampeonato = c.idCategoriasCampeonato AND c.idCategoria = ca.idCategoria 
                                GROUP BY c.idCategoria");
        $stmt->execute();
        
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $torret = array();
        
        foreach ($results as $result) {
            array_push($torret, array(
                "left" => $result["sexo"] . " - " . $result["nivel"],
                "rigth" => $result["num"]
            ));
        }
        return $torret;
    }
}
