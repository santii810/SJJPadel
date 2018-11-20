<?php
// file: model/UserMapper.php
require_once (__DIR__ . "/../core/PDOConnection.php");

/**
 * Class UserMapper
 *
 * Database interface for User entities
 *
 * @author lipido <lipido@gmail.com>
 */
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

    public function getCategory($idCategory){
      $stmt = $this->db->prepare("SELECT * FROM categoria WHERE idCategoria = ?");
      $stmt->execute(array($idCategory));

      $toret_db = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($toret_db != null ){
        return new Category($toret_db["idCategoria"], $toret_db["nivel"], $toret_db["sexo"]);
      }
    }
}
