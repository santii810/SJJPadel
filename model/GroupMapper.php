<?php

require_once (__DIR__ . "/../core/PDOConnection.php");

/**
* Clase GroupMapper
*
* Interfaz de base de datos para entidades GroupMapper
* 
*
*/
class GroupMapper
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
     * Guarda un grupo
     *
     * @param $group
     * @return void
     */
    public function save($group)
    {
        $stmt = $this->db->prepare("INSERT INTO grupo (idCategoria,idCampeonato,nombreGrupo)
			values (?,?,?)");
        
        $stmt->execute(array(
            $group->getIdCategory(),
            $group->getIdChampionship(),
            $group->getGroupName()
        ));
        
        return $this->db->lastInsertId();
    }

    /**
     * Devuelve el grupo por defecto 
     *
     * @param $idCampeonato, $idCategoria
     * @return Group
     */
    public function getGrupoDefault($idCampeonato, $idCategoria)
    {
        $stmt = $this->db->prepare("SELECT *
			FROM   grupo
			WHERE nombreGrupo = 'Default' AND
			idCampeonato = ? AND
			idCategoria = ?");
        $stmt->execute(array(
            $idCampeonato,
            $idCategoria
        ));
        $toret_db = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($toret_db != null) {
            return new Group($toret_db["idGrupo"], $toret_db["idCategoria"], $toret_db["idCampeonato"], $toret_db["nombreGrupo"]);
        } else {
            return NULL;
        }
    }

    /**
     * Devuelve el grupo de una categoria
     *
     * @param $idCampeonato, $idCategoria
     * @return Group
     */
    public function getGroup($idCampeonato, $idCategoria)
    {
        $stmt = $this->db->prepare("SELECT *
			FROM   grupo
			WHERE nombreGrupo != 'Default' AND
			idCampeonato = ? AND
			idCategoria = ?");
        $stmt->execute(array(
            $idCampeonato,
            $idCategoria
        ));
        $toret_db = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($toret_db != null) {
            return new Group($toret_db["idGrupo"], $toret_db["idCategoria"], $toret_db["idCampeonato"], $toret_db["nombreGrupo"]);
        } else {
            return NULL;
        }
    }

    /**
     * Devuelve todos los grupos de una categoria 
     *
     * @param $idCampeonato, $idCategoria
     * @return Group
     */
    public function getGroups($idCampeonato, $idCategoria)
    {
        $stmt = $this->db->prepare("SELECT *
			FROM   grupo
			WHERE nombreGrupo != 'Default' AND
			idCampeonato = ? AND
			idCategoria = ?");
        $stmt->execute(array(
            $idCampeonato,
            $idCategoria
        ));
        $toret_db = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($toret_db != null) {
            return new Group($toret_db["idGrupo"], $toret_db["idCategoria"], $toret_db["idCampeonato"], $toret_db["nombreGrupo"]);
        } else {
            return NULL;
        }
    }

    /**
     * Retorna todos los grupos asociados a un campeonato
     * @param $idChampionship
     * @return mixed Group
     */
    public function getGroupsFromChampionship($idChampionship)
    {
        $stmt = $this->db->prepare("SELECT * FROM grupo	WHERE idCampeonato = ?");
        $stmt->execute(array(
            $idChampionship
        ));
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $groups = array();
        foreach ($toret_db as $group) {
            array_push($groups, new Group($group["idGrupo"], $group["idCategoria"], $group["idCampeonato"], $group["nombreGrupo"]));
        }
        return $groups;
    }
}
