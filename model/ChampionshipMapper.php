<?php
// file: model/PostMapper.php
require_once (__DIR__ . "/../core/PDOConnection.php");

require_once (__DIR__ . "/../model/User.php");
require_once (__DIR__ . "/../model/Championship.php");
require_once (__DIR__ . "/../model/Group.php");
require_once (__DIR__ . "/../model/Category.php");

/**
* Clase ChampionshipMapper
*
* Interfaz de base de datos para entidades ChampionshipMapper
* 
*
*/

class ChampionshipMapper
{

    private $db;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }

    /**
     * Guarda un campeonato 
     *
     * @param $Championship
     * @return void
     */

    public function save($championship)
    {
        $stmt = $this->db->prepare("INSERT INTO campeonato(fechaInicioInscripcion, fechaFinInscripcion, fechaInicioCampeonato, fechaFinCampeonato, nombreCampeonato) values (?,?,?,?,?)");
        $stmt->execute(array(
            $championship->getFechaInicioInscripcion(),
            $championship->getFechaFinInscripcion(),
            $championship->getFechaInicioCampeonato(),
            $championship->getFechaFinCampeonato(),
            $championship->getNombreCampeonato()
        ));
        return $this->db->lastInsertId();
    }

    /**
     * Elimina un campeonato 
     *
     * @param $id
     * @return void
     */

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM campeonato where idCampeonato=?");
        $stmt->execute(array(
            $id
        ));
    }

    /**
     * Edita un campeonato 
     *
     * @param $Championship
     * @return void
     */

    public function edit($championship)
    {
        $stmt = $this->db->prepare("UPDATE campeonato set fechaInicioInscripcion=?,
      													fechaFinInscripcion=?,
      													fechaInicioCampeonato=?,
      													fechaFinCampeonato=?,
      													nombreCampeonato=?
      												where idCampeonato =?");
        $stmt->execute(array(
            $championship->getFechaInicioInscripcion(),
            $championship->getFechaFinInscripcion(),
            $championship->getFechaInicioCampeonato(),
            $championship->getFechaFinCampeonato(),
            $championship->getNombreCampeonato(),
            $championship->getId()
        ));
    }

    /**
     * Obtiene los datos de un campeonato
     *
     * @param int $idCampeonato
     *            identificador del campeonato
     * @return Championship Objeto con todos los datos del campeonato
     */
    public function getCampeonato($idCampeonato)
    {
        $stmt = $this->db->prepare("SELECT * FROM campeonato WHERE idCampeonato = ?");
        $stmt->execute(array(
            $idCampeonato
        ));
        $championship = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($championship != null) {
            return new Championship($championship["idCampeonato"], $championship["fechaInicioInscripcion"], $championship["fechaFinInscripcion"], $championship["fechaInicioCampeonato"], $championship["fechaFinCampeonato"], $championship["nombreCampeonato"], $championship["fase"]);
        }
    }

    /**
     * Devuelve todos los campeonatos
     *
     * 
     * @return mixed Championship
     */
    public function getCampeonatos()
    {
        $stmt = $this->db->query("SELECT *
			FROM campeonato");
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $championships = array();
        
        foreach ($toret_db as $championship) {
            array_push($championships, new Championship($championship["idCampeonato"], $championship["fechaInicioInscripcion"], $championship["fechaFinInscripcion"], $championship["fechaInicioCampeonato"], $championship["fechaFinCampeonato"], $championship["nombreCampeonato"], $championship["fase"]));
        }
        return $championships;
    }

    /**
     * Actualiza el campeonato indicado a la fase indicada
     *
     * @param Championship $idChampionship
     *            campeonato a actualizar
     * @param string $fase
     *            nueva fase
     */
    public function updateFase($idChampionship, $fase)
    {
        $stmt = $this->db->prepare("UPDATE campeonato set fase=? where idCampeonato =?");
        $stmt->execute(array(
            $fase,
            $idChampionship
        ));
    }

    /**
     * Devuelve campeonatos en curso
     *
     *
     * @return void
     */
    public function getCampeonatosInProgress()
    {
        $stmt = $this->db->query("SELECT * FROM campeonato where fechaInicioCampeonato < curdate()");
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $championships = array();
        
        foreach ($toret_db as $championship) {
            array_push($championships, new Championship($championship["idCampeonato"], $championship["fechaInicioInscripcion"], $championship["fechaFinInscripcion"], $championship["fechaInicioCampeonato"], $championship["fechaFinCampeonato"], $championship["nombreCampeonato"]));
        }
        return $championships;
    }

    /**
     * devuelve una lista de campeonatos con la fecha de incripcion finalizada y que no tengan grupos ya creados
     *
     * 
     * @return mixed Championship
     */

    
    public function getCampeonatosToGenerateGroups()
    {
        $stmt = $this->db->query("SELECT * FROM campeonato where fechaFinInscripcion <= curdate() and (Select count(idCampeonato) from grupo where campeonato.idCampeonato = grupo.idCampeonato ) = 0");
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $championships = array();
        
        foreach ($toret_db as $championship) {
            array_push($championships, new Championship($championship["idCampeonato"], $championship["fechaInicioInscripcion"], $championship["fechaFinInscripcion"], $championship["fechaInicioCampeonato"], $championship["fechaFinCampeonato"], $championship["nombreCampeonato"]));
        }
        
        return $championships;
    }

    
    /**
     * devuelve una lista de campeonatos con la fecha de incripcion finalziada y que no tengan grupos ya creados
     *
     * 
     * @return mixed Championship
     */

    public function getCampeonatosParaIncripcion()
    {
        $stmt = $this->db->query("SELECT * FROM campeonato where fechaInicioInscripcion <= curdate() and fechaFinInscripcion >= curdate()");
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $championships = array();
        
        foreach ($toret_db as $championship) {
            array_push($championships, new Championship($championship["idCampeonato"], $championship["fechaInicioInscripcion"], $championship["fechaFinInscripcion"], $championship["fechaInicioCampeonato"], $championship["fechaFinCampeonato"], $championship["nombreCampeonato"]));
        }
        
        return $championships;
    }

    /**
     * devuelve las categorias de un campeonato
     *
     * @param $idCampeonato
     * @return mixed Categories
     */

    public function getCategorias($idCampeonato)
    {
        $stmt = $this->db->prepare("SELECT cam.nombreCampeonato,cat.nivel,cat.sexo,catc.idCategoria,cam.idCampeonato,catc.idCategoriasCampeonato
			FROM campeonato cam,categoriascampeonato catc, categoria cat
			WHERE cam.idCampeonato = catc.idCampeonato AND
			catc.idCategoria = cat.idCategoria AND
			cam.idCampeonato = ?
			ORDER BY idCategoria");
        $stmt->execute(array(
            $idCampeonato
        ));
        
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $categories = array();
        
        foreach ($toret_db as $category) {
            array_push($categories, new Category($category["idCategoria"], $category["nivel"], $category["sexo"]));
        }
        
        return $categories;
    }

    /**
     * devuelve los grupos relacionados con una categoria de un campeonato
     *
     * @param $idCampeonato,$idCategoria
     * @return mixed groups
     */


    public function getGrupos($idCampeonato, $idCategoria)
    {
        $stmt = $this->db->prepare("SELECT g.idGrupo,g.nombreGrupo,g.idCategoria,g.idCampeonato
			FROM campeonato cam,grupo g,categoria c
			WHERE cam.idCampeonato = g.idCampeonato AND
			c.idCategoria = g.idCategoria AND
			cam.idCampeonato = ? AND
			c.idCategoria = ? ");
        $stmt->execute(array(
            $idCampeonato,
            $idCategoria
        ));
        
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $groups = array();
        
        foreach ($toret_db as $group) {
            array_push($groups, new Group($group["idGrupo"], $group["idCategoria"], $group["idCampeonato"], $group["nombreGrupo"]));
        }
        
        return $groups;
    }

    /**
     * devuelve el nombre de un campeonato
     *
     * @param $idCampeonato
     * @return string
     */

    public function getNombreCampeonato($idCampeonato)
    {
        $stmt = $this->db->prepare("SELECT nombreCampeonato FROM campeonato WHERE idCampeonato = ? AND fechaInicioCampeonato <= curdate() AND fechaFinCampeonato >= curdate()");
        $stmt->execute(array(
            $idCampeonato
        ));
        $toret_db = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($toret_db != null) {
            return $toret_db["nombreCampeonato"];
        }
    }

    /**
     * valida la fecha de finalización con la actual
     *
     * @param $idCampeonato,$idCategoria
     * @return boolean
     */

    public function validateHour($idChampionship, $fechaOffer)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM campeonato WHERE idCampeonato = ? AND fechaInicioCampeonato <= ? AND fechaFinCampeonato >= ? AND ? > curdate()");
        $stmt->execute(array(
            $idChampionship,
            $fechaOffer,
            $fechaOffer,
            $fechaOffer
        ));
        $toret_db = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($toret_db["count"] == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * devuelve los datos de un campeonato
     *
     * @param $id
     * @return Championship
     */

    public function getDatos($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM campeonato where idCampeonato=?");
        $stmt->execute(array(
            $id
        ));
        
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $championship = null;
        
        foreach ($toret_db as $datos) {
            $championship = new Championship($datos["idCampeonato"], $datos["fechaInicioInscripcion"], $datos["fechaFinInscripcion"], $datos["fechaInicioCampeonato"], $datos["fechaFinCampeonato"], $datos["nombreCampeonato"]);
        }
        
        return $championship;
    }

    /**
     * Comprueba si el campeonato esta en una fase determinada
     *
     * @param $idCampeonato,$fase
     * @return boolean
     */

    public function checkPhase($idCampeonato, $fase)
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM campeonato where idCampeonato=? and fase=?");
        $stmt->execute(array(
            $idCampeonato,
            $fase
        ));
        
        if ($stmt->fetchColumn() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * devuelve las parejas que estan en un campeonato
     *
     * 
     * @return mixed 
     */

    public function getCouplesPerChampionship()
    {        
        $stmt = $this->db->prepare("select count(idPareja) as num, ca.nombreCampeonato as name 
            FROM pareja p, categoriasCampeonato c , campeonato ca 
            WHERE p.idCategoriaCampeonato = c.idCategoriasCampeonato AND c.idCampeonato = ca.idCampeonato 
            GROUP BY c.idCampeonato");
        $stmt->execute();
        
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $torret = array();
        
        foreach ($results as $result) {
            array_push($torret, array(
                "left" => $result["name"],
                "rigth" => $result["num"]
            ));
        }
        return $torret;
    }
}

