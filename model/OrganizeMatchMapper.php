<?php
// file: model/OrganizeMatchMapper.php
require_once (__DIR__ . "/../core/PDOConnection.php");


/**
* Clase OrganizeMatchMapper
*
* Interfaz de base de datos para entidades OrganizeMatchMapper
* 
*
*/
class OrganizeMatchMapper
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
     * Guarda un partido organizado
     *
     * @param int $categoryChampionship
     * @return void
     */
    public function save(OrganizeMatch $organizeMatch)
    {
        $stmt = $this->db->prepare("INSERT INTO organizarpartido (fecha, hora)
												values (?,?)");
        $stmt->execute(array(
            $organizeMatch->getFecha(),
            $organizeMatch->getHora()
        ));
    }

    /**
     * Busca un partido organizado 
     *
     * @param $idOrganizarPartido
     * @return OrganizeMatch
     */
    public function find($idOrganizarPartido)
    {
        $stmt = $this->db->prepare("SELECT * FROM organizarpartido WHERE idOrganizarPartido =?");
        $stmt->execute(array(
            $idOrganizarPartido
        ));
        $match_sql = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($match_sql != null) {
            $match = new OrganizeMatch($match_sql["idOrganizarPartido"], $match_sql["fecha"], $match_sql["hora"]);
            return $match;
        }
        return null;
    }

    /**
     * Busca los partidos organizados por el administrador 
     *
     * 
     * @return mixed OrganizeMatch
     */
    public function findAll()
    {
        $stmt = $this->db->query("SELECT * FROM organizarpartido ORDER BY fecha, hora");
        $organizedMatches = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $organizedMatchesArray = array();

        foreach ($organizedMatches as $match) {
            $fecha = new DateTime($match["fecha"]);

            $organizedMatch = new OrganizeMatch(null, $fecha->format('d-m-Y'), substr($match["hora"], 0, 5));
            $organizedMatch->setIdOrganizarPartido($match["idOrganizarPartido"]);
            array_push($organizedMatchesArray, $organizedMatch);
        }

        return $organizedMatchesArray;
    }

    /**
     * Comprueba si existe el id de un partido organizado 
     *
     * @param $id
     * @return boolean
     */
    public function exist($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM organizarpartido WHERE idOrganizarPartido =?");
        $stmt->execute(array(
            $id
        ));
        $match = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($match != null) {
            return true;
        } else {
            return null;
        }
    }

    /**
     * Busca un partidos organizados con participantes 
     *
     * @param $id
     * @return OrganizeMatch
     */
    public function findMatchWithParticipants($id)
    {
        $stmt = $this->db->prepare("SELECT
			O.idOrganizarPartido as 'organizarpartido.idOrganizarPartido',
			O.fecha as 'organizarpartido.fecha',
			O.hora as 'organizarpartido.hora',
			P.idOrganizarPartido as 'participantespartido.idOrganizarPartido',
			P.loginUsuario as 'participantespartido.loginUsuario'
			FROM organizarpartido O LEFT OUTER JOIN participantespartido P
			ON O.idOrganizarPartido = P.idOrganizarPartido
			WHERE
			O.idOrganizarPartido=? ");

        $stmt->execute(array(
            $id
        ));
        $match_wt_participants = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (sizeof($match_wt_participants) > 0) {

            $organizeMatch = new OrganizeMatch($id, $match_wt_participants[0]["organizarpartido.fecha"], substr($match_wt_participants[0]["organizarpartido.hora"], 0, 5));

            $participants_array = array();

            if ($match_wt_participants[0]["organizarpartido.idOrganizarPartido"] != null) {
                foreach ($match_wt_participants as $participant) {
                    array_push($participants_array, $participant["participantespartido.loginUsuario"]);
                }
            }
            $organizeMatch->setParticipants($participants_array);

            return $organizeMatch;
        } else {
            return NULL;
        }
    }

    /**
     * Borra un partido organizado 
     *
     * @param $idOrganizarPartido
     * @return void
     */
    public function delete($idOrganizarPartido)
    {
        $stmt = $this->db->prepare("DELETE FROM organizarpartido where idOrganizarPartido=?");
        $stmt->execute(array(
            $idOrganizarPartido
        ));
    }
}
