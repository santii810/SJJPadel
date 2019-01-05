<?php
// file: model/UserMapper.php
require_once (__DIR__ . "/../core/PDOConnection.php");

class CategoryMapper
{

    /**
     * Reference to the PDO connection
     *
     * @var PDO
     */
    private $db;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }

    /**
     * Saves a User into the database
     *
     * @param User $user
     *            The user to be saved
     * @throws PDOException if a database error occurs
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

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM categoria where idCategoria=?");
        $stmt->execute(array(
            $id
        ));
    }

    public function edit($level, $sex, $id)
    {
        $stmt = $this->db->prepare("UPDATE categoria set nivel=?, sexo=? where idCategoria =?");
        $stmt->execute(array(
            $level,
            $sex,
            $id
        ));
    }

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
                "left" => $result["sexo"]. " - " . $result["nivel"],
                "rigth" => $result["num"]
            ));
        }
        return $torret;
    }
}
