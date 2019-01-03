<?php
// file: model/UserMapper.php
require_once (__DIR__ . "/../core/PDOConnection.php");

class ConfrontationMapper
{

    private $db;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }

    /**
     * Inserta en la tabla enfrentamientos los id de pareja1, pareja2 y grupo del parametro enviado
     *
     * @param Confrontation $partnergroup
     *            enfrentamiento a registrar
     */
    public function save($partnergroup)
    {
        $stmt = $this->db->prepare("INSERT INTO enfrentamiento (idPareja1, idPareja2, idGrupo, fase)
      values (?,?,?,?)");
        $stmt->execute(array(
            $partnergroup->getIdPartner1(),
            $partnergroup->getIdPartner2(),
            $partnergroup->getIdGroup(),
            $partnergroup->getPhase()
            
        ));
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

    public function getPartidosResultadoNull($idGrupo, $fase)
    {
        $stmt = $this->db->prepare("SELECT * FROM enfrentamiento WHERE
     fecha is not null AND
     hora is not null AND
     idGrupo = ? AND
     fase = ?
     ORDER BY setsPareja1 ");
        $stmt->execute(array(
            $idGrupo,
            $fase
        ));
        
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $confrontations = array();
        
        foreach ($toret_db as $confrontation) {
            array_push($confrontations, new Confrontation($confrontation["idEnfrentamiento"], $confrontation["idPareja1"], $confrontation["idPareja2"], $confrontation["idGrupo"], $confrontation['fase'], $confrontation["fecha"], $confrontation["hora"], $confrontation["puntosPareja1"], $confrontation["puntosPareja2"], $confrontation["setsPareja1"], $confrontation["setsPareja2"]));
        }
        
        return $confrontations;
    }

    public function getPartidos($idGrupo)
    {
        $stmt = $this->db->prepare("SELECT * FROM enfrentamiento WHERE
     idGrupo = ? AND
     fase = 'Grupos'
     ORDER BY idPareja1,idPareja2
     ");
        $stmt->execute(array(
            $idGrupo
        ));
        
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $confrontations = array();
        
        foreach ($toret_db as $confrontation) {
            array_push($confrontations, new Confrontation($confrontation["idEnfrentamiento"], $confrontation["idPareja1"], $confrontation["idPareja2"], $confrontation["idGrupo"], $confrontation['fase'], $confrontation["fecha"], $confrontation["hora"], $confrontation["puntosPareja1"], $confrontation["puntosPareja2"], $confrontation["setsPareja1"], $confrontation["setsPareja2"]));
        }
        
        return $confrontations;
    }

    public function getPartidosPorFase($idGrupo, $fase)
    {
        $stmt = $this->db->prepare("SELECT * FROM enfrentamiento WHERE
     idGrupo = ? AND
     fase = ?
     ORDER BY idPareja1,idPareja2
     ");
        $stmt->execute(array(
            $idGrupo, $fase
        ));
        
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $confrontations = array();
        
        foreach ($toret_db as $confrontation) {
            array_push($confrontations, new Confrontation($confrontation["idEnfrentamiento"], $confrontation["idPareja1"], $confrontation["idPareja2"], $confrontation["idGrupo"], $confrontation['fase'], $confrontation["fecha"], $confrontation["hora"], $confrontation["puntosPareja1"], $confrontation["puntosPareja2"], $confrontation["setsPareja1"], $confrontation["setsPareja2"]));
        }
        
        return $confrontations;
    }

    public function getPartidosCuartos($idGrupo)
    {
        $stmt = $this->db->prepare("SELECT * FROM enfrentamiento WHERE
     idGrupo = ? AND
     fase = 'Cuartos' 
     ORDER BY idPareja1,idPareja2
     ");
        $stmt->execute(array(
            $idGrupo
        ));
        
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $confrontations = array();
        
        foreach ($toret_db as $confrontation) {
            array_push($confrontations, new Confrontation($confrontation["idEnfrentamiento"], $confrontation["idPareja1"], $confrontation["idPareja2"], $confrontation["idGrupo"], $confrontation['fase'], $confrontation["fecha"], $confrontation["hora"], $confrontation["puntosPareja1"], $confrontation["puntosPareja2"], $confrontation["setsPareja1"], $confrontation["setsPareja2"]));
        }
        
        return $confrontations;
    }

    public function getPartidosSemifinal($idGrupo)
    {
        $stmt = $this->db->prepare("SELECT * FROM enfrentamiento WHERE
     idGrupo = ? AND
     fase = 'Semifinal' 
     ORDER BY idPareja1,idPareja2
     ");
        $stmt->execute(array(
            $idGrupo
        ));
        
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $confrontations = array();
        
        foreach ($toret_db as $confrontation) {
            array_push($confrontations, new Confrontation($confrontation["idEnfrentamiento"], $confrontation["idPareja1"], $confrontation["idPareja2"], $confrontation["idGrupo"], $confrontation['fase'], $confrontation["fecha"], $confrontation["hora"], $confrontation["puntosPareja1"], $confrontation["puntosPareja2"], $confrontation["setsPareja1"], $confrontation["setsPareja2"]));
        }
        
        return $confrontations;
    }

    public function getPartidosFinal($idGrupo)
    {
        $stmt = $this->db->prepare("SELECT * FROM enfrentamiento WHERE
     idGrupo = ? AND
     fase = 'Final' 
     ORDER BY idPareja1,idPareja2
     ");
        $stmt->execute(array(
            $idGrupo
        ));
        
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $confrontations = array();
        
        foreach ($toret_db as $confrontation) {
            array_push($confrontations, new Confrontation($confrontation["idEnfrentamiento"], $confrontation["idPareja1"], $confrontation["idPareja2"], $confrontation["idGrupo"], $confrontation['fase'], $confrontation["fecha"], $confrontation["hora"], $confrontation["puntosPareja1"], $confrontation["puntosPareja2"], $confrontation["setsPareja1"], $confrontation["setsPareja2"]));
        }
        
        return $confrontations;
    }

    public function hadPlayed($idPareja1, $idPareja2, $idGrupo)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS count FROM enfrentamiento WHERE idGrupo=? AND (( idPareja1=? AND idPareja2=?) OR
      (idPareja1=? AND idPareja2=?)) AND hora is null");
        $stmt->execute(array(
            $idGrupo,
            $idPareja1,
            $idPareja2,
            $idPareja2,
            $idPareja1
        ));
        $toret_db = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($toret_db["count"] == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getIdConfrontation($idPareja, $idParejaOffer)
    {
        $stmt = $this->db->prepare("SELECT idEnfrentamiento FROM enfrentamiento WHERE (( idPareja1=? AND idPareja2=?) OR (idPareja1=? AND idPareja2=?))");
        $stmt->execute(array(
            $idPareja,
            $idParejaOffer,
            $idParejaOffer,
            $idPareja
        ));
        $toret_db = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($toret_db != null) {
            return $toret_db["idEnfrentamiento"];
        }
    }

    public function actualizarHorario($idEnfrentamiento, $fecha, $hora)
    {
        $stmt = $this->db->prepare("UPDATE enfrentamiento set fecha=?, hora=? where idEnfrentamiento=?");
        $stmt->execute(array(
            $fecha,
            $hora,
            $idEnfrentamiento
        ));
    }

    /**
     * Devuelve true si todos los enfrentamientos de un grupo tienen resultado guardado en la base de datos y false en caso contrario
     */
    public function hasAllConfrontationsResult($idGroup)
    {
        $stmt = $this->db->prepare("SELECT count(*) as num FROM enfrentamiento where idGrupo=? and puntosPareja1 is NULL or puntosPareja2 is NULL");
        $stmt->execute(array(
            $idGroup
        ));
        $toret_db = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return ($toret_db != null && $toret_db["num"] == 0);
    }
}
