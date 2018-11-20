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
class ConfrontationMapper
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
    public function save($partnergroup)
    {
        $stmt = $this->db->prepare("INSERT INTO enfrentamiento (idPareja1, idPareja2, idGrupo) 
												values (?,?,?)");
        $stmt->execute(array(
            $partnergroup->getIdPartner1(),
            $partnergroup->getIdPartner2(),
            $partnergroup->getIdGroup()
        ));
        
        //echo $couplesGroup[$i]->getIdPartner() . " - " . $couplesGroup[$j]->getIdPartner() . "<br>";
    }

    public function actualizarResultados($idEnfrentamiento, $puntosPareja1, $puntosPareja2, $setsPareja1, $setsPareja2)
    {
        $stmt = $this->db->prepare("UPDATE enfrentamiento set puntosPareja1=?, puntosPareja2=?, setsPareja1=?, setsPareja2=? where idEnfrentamiento=?");
        $stmt->execute(array(
            $puntosPareja1,
            $puntosPareja2,
            $setsPareja1,
            $setsPareja2,
            $idEnfrentamiento
        ));
    }

    public function getPartidosResultadoNull($idGrupo)
    {
        $stmt = $this->db->prepare("SELECT * FROM enfrentamiento WHERE 
                                   puntosPareja1 is null AND
                                   puntosPareja2 is null AND
                                   setsPareja1 is null AND
                                   setsPareja2 is null AND
                                   fecha is not null AND
                                   hora is not null AND
                                   idGrupo = ? ");
        $stmt->execute(array(
            $idGrupo
        ));
        
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $confrontations = array();
        
        foreach ($toret_db as $confrontation) {
            array_push($confrontations, new Confrontation($confrontation["idEnfrentamiento"], $confrontation["idPareja1"], $confrontation["idPareja2"], $confrontation["idGrupo"], $confrontation["fecha"], $confrontation["hora"], $confrontation["puntosPareja1"], $confrontation["puntosPareja2"], $confrontation["setsPareja1"], $confrontation["setsPareja2"]));
        }
        
        return $confrontations;
    }

    public function getPartidos($idGrupo)
    {
        $stmt = $this->db->prepare("SELECT * FROM enfrentamiento WHERE 
                                   idGrupo = ? ");
        $stmt->execute(array(
            $idGrupo
        ));
        
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $confrontations = array();
        
        foreach ($toret_db as $confrontation) {
            array_push($confrontations, new Confrontation($confrontation["idEnfrentamiento"], $confrontation["idPareja1"], $confrontation["idPareja2"], $confrontation["idGrupo"], $confrontation["fecha"], $confrontation["hora"], $confrontation["puntosPareja1"], $confrontation["puntosPareja2"], $confrontation["setsPareja1"], $confrontation["setsPareja2"]));
        }
        
        return $confrontations;
    }

    public function hadPlayed($idPareja1, $idPareja2, $idGrupo){
        $stmt = $this->db->prepare("SELECT COUNT(*) AS count FROM enfrentamiento WHERE idGrupo=? AND (( idPareja1=? AND idPareja2=?) OR 
                                                                                        (idPareja1=? AND idPareja2=?)) AND hora is null");
        $stmt->execute(array($idGrupo, $idPareja1, $idPareja2, $idPareja2, $idPareja1));
        $toret_db = $stmt->fetch(PDO::FETCH_ASSOC);

        if($toret_db["count"] == 0){
            return true;
        }
        else{
            return false;
        }
    }


}
