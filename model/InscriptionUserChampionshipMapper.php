<?php
// file: model/PostMapper.php
require_once (__DIR__ . "/../core/PDOConnection.php");

require_once (__DIR__ . "/../model/InscriptionUserChampionship.php");

class InscriptionUserChampionshipMapper
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

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM pareja where idpareja=?");
        $stmt->execute(array(
            $id
        ));
    }

    public function getDatos($id)
    {
        $stmt = $this->db->prepare("SELECT pa.idPareja,pa.idCapitan,pa.idCompañero,cat.nivel,cat.sexo,cam.nombreCampeonato 
                FROM campeonato cam,categoria cat,categoriascampeonato cap,pareja pa
                WHERE cam.idCampeonato = cap.idCampeonato AND
                        cat.idCategoria = cap.idCategoria AND
                        cap.idCategoriasCampeonato = pa.idCategoriaCampeonato AND
                        pa.idPareja =?
                        ");
        $stmt->execute(array(
            $id
        ));
        
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $inscription = null;
        
        foreach ($toret_db as $datos) {
            $inscription = new InscriptionUserChampionship($datos["idPareja"], $datos["idCapitan"], $datos["idCompañero"], $datos["nivel"], $datos["sexo"], $datos["nombreCampeonato"]);
        }
        
        return $inscription;
    }

    public function getAllInscriptionsInChampionship()
    {
        $stmt = $this->db->query("SELECT pa.idPareja,pa.idCapitan,pa.idCompañero,cat.nivel,cat.sexo,cam.nombreCampeonato 
								FROM campeonato cam,categoria cat,categoriascampeonato cap,pareja pa
								WHERE cam.idCampeonato = cap.idCampeonato AND
      								  cat.idCategoria = cap.idCategoria AND
      								  cap.idCategoriasCampeonato = pa.idCategoriaCampeonato");
        
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $inscriptions = array();
        
        foreach ($toret_db as $datos) {
            array_push($inscriptions, new InscriptionUserChampionship($datos["idPareja"], $datos["idCapitan"], $datos["idCompañero"], $datos["nivel"], $datos["sexo"], $datos["nombreCampeonato"]));
        }
        
        return $inscriptions;
    }

    public function getInscriptionsCurrentUserInChampionship($login)
    {
        $stmt = $this->db->prepare("SELECT pa.idPareja,pa.idCapitan,pa.idCompañero,cat.nivel,cat.sexo,cam.nombreCampeonato 
								FROM campeonato cam,categoria cat,categoriascampeonato cap,pareja pa
								WHERE cam.idCampeonato = cap.idCampeonato AND
      							cat.idCategoria = cap.idCategoria AND
      							cap.idCategoriasCampeonato = pa.idCategoriaCampeonato AND
      							(pa.idCapitan =? OR pa.idCompañero =?)");
        $stmt->execute(array(
            $login,
            $login
        ));
        
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $inscriptions = array();
        
        foreach ($toret_db as $datos) {
            array_push($inscriptions, new InscriptionUserChampionship($datos["idPareja"], $datos["idCapitan"], $datos["idCompañero"], $datos["nivel"], $datos["sexo"], $datos["nombreCampeonato"]));
        }
        
        return $inscriptions;
    }
}

