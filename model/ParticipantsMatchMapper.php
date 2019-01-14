<?php

require_once (__DIR__ . "/../core/PDOConnection.php");

/**
* Clase ParticipantsMatchMapper
*
* Interfaz de base de datos para entidades ParticipantsMatchMapper
* 
*
*/
class ParticipantsMatchMapper
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
     * Comprueba si estan todos los participantes para el partido 
     *
     * @param $idOrganizeMatch, $userLogin
     * @return boolean
     */
    public function play($idOrganizeMatch, $userLogin)
    {
        $stmt = $this->db->prepare("SELECT * FROM participantespartido WHERE idOrganizarPartido =? AND loginUsuario=?");
        $stmt->execute(array(
            $idOrganizeMatch,
            $userLogin
        ));
        $play = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($play != null) {
            $play = true;
        } else {
            $play = false;
        }
        return $play;
    }

    /**
     * Guarda un participante en el partido organizado 
     *
     * @param $paticipantMatch
     * @return void
     */
    public function save(ParticipantsMatch $paticipantMatch)
    {
        $stmt = $this->db->prepare("INSERT INTO participantespartido (idOrganizarPartido, loginUsuario)
												values (?,?)");
        $stmt->execute(array(
            $paticipantMatch->getIdOrganizarPartido(),
            $paticipantMatch->getLoginUsuario()
        ));
    }

    /**
     * Cuenta los participantes de un partido 
     *
     * @param $idOrganizeMatch
     * @return int
     */
    public function count($idOrganizeMatch)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM participantespartido WHERE idOrganizarPartido =?");
        $stmt->execute(array(
            $idOrganizeMatch
        ));
        $count = $stmt->fetch(PDO::FETCH_ASSOC);

        return $count["count"];
    }

    /**
     * Cancela la inscripción a un partido organizado
     *
     * @param $idOrganizeMatch, $userLogin
     * @return void
     */
    public function cancel($idOrganizeMatch, $userLogin)
    {
        $stmt = $this->db->prepare("DELETE FROM participantespartido where idOrganizarPartido=? AND loginUsuario=?");
        $stmt->execute(array(
            $idOrganizeMatch,
            $userLogin
        ));
    }

    /**
     * Devuelve los participantes de un partido organizado
     *
     * @param $idOrganizeMatch
     * @return mixed participantes
     */
    public function getParticipants($idOrganizeMatch){
      $stmt = $this->db->prepare("SELECT * FROM participantespartido WHERE idOrganizarPartido =?");
      $stmt->execute(array(
          $idOrganizeMatch
      ));
      $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $array_participantes = array();

      foreach($toret_db as $to){
        array_push($array_participantes, $to["loginUsuario"]);
      }

      return $array_participantes;
    }
}
