<?php
// file: model/UserMapper.php
require_once (__DIR__ . "/../core/PDOConnection.php");

/**
* Clase ConfrontationMapper
*
* Interfaz de base de datos para entidades ConfrontationMapper
* 
*
*/

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
     * @param $partnergroup
     *            enfrentamiento a registrar
     * @return void
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

    /**
     * Actualiza los resultados
     *
     * @param $idEnfrentamiento, $puntosPareja1, $puntosPareja2, $setsPareja1, $setsPareja2
     * @return void
     */
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

    /**
     * Devuelve los enfrentamientos de un grupo,colocando primero los nulos
     *
     * @param $idGrupo, $fase
     * @return void
     */
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

    /**
     * Devuelve los partidos de un grupo
     *
     * @param $idGrupo
     * @return void
     */
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

    /**
     * Devuelve los partidos de fase de grupos
     *
     * @param $idGrupo, $fase
     * @return void
     */
    public function getPartidosPorFase($idGrupo, $fase)
    {
        $stmt = $this->db->prepare("SELECT * FROM enfrentamiento WHERE
     idGrupo = ? AND
     fase = ?
     ORDER BY idPareja1,idPareja2
     ");
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

    /**
     * Devuelve los partidos de fase de cuartos
     *
     * @param $idGrupo
     * @return void
     */
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

    /**
     * Devuelve los partidos de fase de semifinales
     *
     * @param $idGrupo
     * @return void
     */
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

    /**
     * Devuelve los partidos de fase final
     *
     * @param $idGrupo
     * @return void
     */
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

    /**
     * Comprueba si han jugado ya una pareja
     *
     * @param $idPareja1, $idPareja2, $idGrupo
     * @return boolean
     */
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

    /**
     * Devuelve el id del enfrentamiento
     *
     * @param $idPareja1, $idPareja2, $idGrupo
     * @return id
     */
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

    /**
     * Actualiza horarios
     *
     * @param $idEnfrentamiento, $fecha, $hora
     * @return void
     */
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
     * Devuelve true si todos los enfrentamientos de un grupo tienen resultado guardado en la base de datos y false en caso
     * contrario
     * @param $idGroup
     * @return int
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

    /**
     * Cuenta las victorias locales de una pareja
     *
     * @param $idPareja
     * @return int
     */
    public function countLocalVictories($idPareja)
    {
        $stmt = $this->db->prepare("SELECT count(idEnfrentamiento) as num FROM enfrentamiento where puntosPareja1 > puntosPareja2 and idPareja1 = ?");
        $stmt->execute(array(
            $idPareja
        ));
        $toret_db = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($toret_db != null) {
            return $toret_db["num"];
        }
    }

    /**
     * Cuenta las victorias Visitantes de una pareja
     *
     * @param $idPareja
     * @return int
     */
    public function countVisitantVictories($idPareja)
    {
        $stmt = $this->db->prepare("SELECT count(idEnfrentamiento) as num FROM enfrentamiento where puntosPareja1 < puntosPareja2 and idPareja2 = ?");
        $stmt->execute(array(
            $idPareja
        ));
        $toret_db = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($toret_db != null) {
            return $toret_db["num"];
        }
    }

    /**
     * Cuenta las derrotas locales de una pareja
     *
     * @param $idPareja
     * @return int
     */
    public function countLocalDefeats($idPareja)
    {
        $stmt = $this->db->prepare("SELECT count(idEnfrentamiento) as num FROM enfrentamiento where puntosPareja1 > puntosPareja2 and idPareja2 = ?");
        $stmt->execute(array(
            $idPareja
        ));
        $toret_db = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($toret_db != null) {
            return $toret_db["num"];
        }
    }

    /**
     * Cuenta las derrotas siendo visitantes de una pareja
     *
     * @param $idPareja
     * @return int
     */
    public function countVisitantDefeats($idPareja)
    {
        $stmt = $this->db->prepare("SELECT count(idEnfrentamiento) as num FROM enfrentamiento where puntosPareja1 < puntosPareja2 and idPareja1 = ?");
        $stmt->execute(array(
            $idPareja
        ));
        $toret_db = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($toret_db != null) {
            return $toret_db["num"];
        }
    }

    /**
     * Devuelve el mejor resultado obtenido
     *
     * @param $idPareja
     * @return string
     */
    public function getBestResult($idPareja)
    {
        $stmt = $this->db->prepare("select idPareja1, idPareja2, fase,setsPareja1,setsPareja2
                        from enfrentamiento where idPareja1=? or idPareja2=?
                        group by fase order by fase desc limit 1;");
        $stmt->execute(array(
            $idPareja,
            $idPareja
        ));
        $toret_db = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($toret_db != null) {
            if ($toret_db["fase"] == "Final") {
                if ($toret_db["idPareja1"] == $idPareja && $toret_db["setsPareja1"] > $toret_db["setsPareja2"] || $toret_db["idPareja2"] == $idPareja && $toret_db["setsPareja1"] < $toret_db["setsPareja2"])
                    return "Campeón";
            }

            return $toret_db["fase"];
        }
    }

    /**
     * Devuelve los enfrentamientos de una pareja
     *
     * @param $idPareja
     * @return mixed Confrontation
     */
    public function getConfrontationMatches($idPareja){
      $stmt = $this->db->prepare("SELECT
        E.idEnfrentamiento as 'e.idEnfrentamiento',
        E.idPareja1 as 'e.idPareja1',
        E.idPareja2 as 'e.idPareja2',
        E.idGrupo as 'e.idGrupo',
        E.fase as 'e.fase',
        E.fecha as 'e.fecha',
        E.hora as 'e.hora'
        FROM enfrentamiento E LEFT OUTER JOIN pareja P
        ON E.idPareja1 = P.idPareja AND E.idPareja2 = P.idPareja
        WHERE
        (E.idPareja1=? OR E.idPareja2=?) AND E.fecha IS NOT NULL AND E.hora IS NOT NULL AND E.fecha >= CURDATE()");

      $stmt->execute(array( $idPareja, $idPareja ));
      $championship_matches = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $championshipM = array();

      foreach($championship_matches as $championshipMatch){
        array_push($championshipM, new Confrontation($championshipMatch["e.idEnfrentamiento"],
                                                      $championshipMatch["e.idPareja1"],
                                                      $championshipMatch["e.idPareja2"],
                                                      $championshipMatch["e.idGrupo"],
                                                      $championshipMatch["e.fase"],
                                                      $championshipMatch["e.fecha"],
                                                      $championshipMatch["e.hora"],
                                                      null,
                                                      null,
                                                      null,
                                                      null));
      }
      return $championshipM;
    }

}
