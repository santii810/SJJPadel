<?php

require_once (__DIR__ . "/../core/PDOConnection.php");

/**
* Clase PartnerGroupMapper
*
* Interfaz de base de datos para entidades PartnerGroupMapper
* 
*
*/
class PartnergroupMapper
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
     * Guarda una relación de una pareja a un grupo 
     *
     * @param $partnergroup
     * @return void
     */
    public function save($partnergroup)
    {
        $stmt = $this->db->prepare("INSERT INTO parejagrupo (idPareja,idGrupo)
												values (?,?)");
        $stmt->execute(array(
            $partnergroup->getIdPartner(),
            $partnergroup->getIdGroup()
        ));
    }

    /**
     * Devuelve las parejas pertenecientes a un grupo 
     *
     * @param $idGrupo
     * @return mixed PartnerGroups
     */
    public function getIdParejasGrupo($idGrupo)
    {
        $stmt = $this->db->prepare("SELECT * FROM parejagrupo WHERE idGrupo = ? ");
        $stmt->execute(array(
            $idGrupo
        ));
        
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $partnergroups = array();
        
        foreach ($toret_db as $partnergroup) {
            array_push($partnergroups, new Partnergroup($partnergroup["idPareja"], $partnergroup["idGrupo"]));
        }
        
        return $partnergroups;
    }

    /**
     * Devuelve el id del grupo al que pertenece una pareja 
     *
     * @param $idPareja
     * @return int
     */
    public function getIdGrupo($idPareja)
    {
        $stmt = $this->db->prepare("SELECT idGrupo FROM parejagrupo WHERE idPareja = ? ");
        $stmt->execute(array(
            $idPareja
        ));
        $toret_db = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $toret_db["idGrupo"];
    }

    /**
     * Comprueba si una pareja tiene grupo 
     *
     * @param $idPareja
     * @return boolean
     */
    public function hasGroup($idPareja)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM parejagrupo WHERE idPareja = ? ");
        $stmt->execute(array(
            $idPareja
        ));
        $toret_db = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($toret_db["count"] == 0) {
            return false;
        } else {
            return true;
        }
    }
}
