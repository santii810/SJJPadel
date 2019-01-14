<?php
require_once (__DIR__ . "/../core/PDOConnection.php");

/**
* Clase ConfrontationOfferMapper
*
* Interfaz de base de datos para entidades ConfrontationOfferMapper
* 
*
*/
class ConfrontationOfferMapper
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
     * Obtiene las ofertas de enfrentamiento por grupo 
     *
     * @param $idGrupo
     * @return mixed ConfrontationOffer
     */
    public function getConfrontationOffersForGroup($idGrupo)
    {
        $stmt = $this->db->prepare("SELECT * FROM ofertaenfrentamiento WHERE idGrupo=?");
        $stmt->execute(array(
            $idGrupo
        ));
        $ofertasEnfrentamientos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $enfrentamientos_array = array();

        if ($ofertasEnfrentamientos != null) {
            foreach ($ofertasEnfrentamientos as $enfrentamiento) {
                $fecha = new DateTime($enfrentamiento["fecha"]);
                $enf = new ConfrontationOffer($enfrentamiento["idOfertaEnfrentamiento"], $enfrentamiento["idPareja"], $enfrentamiento["idGrupo"], $enfrentamiento["hora"], $fecha->format('d-m-Y'));
                array_push($enfrentamientos_array, $enf);
            }
        }
        return $enfrentamientos_array;
    }

    /**
     * Devuelve una oferta enfrentamiento
     *
     * @param $idOfertaEnfrentamiento
     * @return ConfrontationOffer
     */
    public function getOffer($idOfertaEnfrentamiento)
    {
        $stmt = $this->db->prepare("SELECT * FROM ofertaenfrentamiento WHERE idOfertaEnfrentamiento=?");
        $stmt->execute(array(
            $idOfertaEnfrentamiento
        ));
        $ofertaEnfrentamientos = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($ofertaEnfrentamientos != null) {
            return new ConfrontationOffer($ofertaEnfrentamientos["idOfertaEnfrentamiento"], $ofertaEnfrentamientos["idPareja"], $ofertaEnfrentamientos["idGrupo"], $ofertaEnfrentamientos["hora"], $ofertaEnfrentamientos["fecha"]);
        }
    }

    /**
     * Guarda una oferta de enfrentamiento
     *
     * @param $confrontationOffer
     * @return void
     */
    public function save(ConfrontationOffer $confrontationOffer)
    {
        $stmt = $this->db->prepare("INSERT INTO ofertaenfrentamiento (idPareja, idGrupo, fecha, hora)
												values (?,?,?,?)");
        $stmt->execute(array(
            $confrontationOffer->getIdPareja(),
            $confrontationOffer->getIdGrupo(),
            $confrontationOffer->getFecha(),
            $confrontationOffer->getHora()
        ));
    }

    /**
     * Elimina una oferta de enfrentamiento
     *
     * @param $idOfertaEnfrentamiento
     * @return void
     */
    public function delete($idOfertaEnfrentamiento)
    {
        $stmt = $this->db->prepare("DELETE FROM ofertaenfrentamiento where idOfertaEnfrentamiento=?");
        $stmt->execute(array(
            $idOfertaEnfrentamiento
        ));
    }
}
