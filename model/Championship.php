<?php
// file: model/Post.php
require_once (__DIR__ . "/../core/ValidationException.php");

/**
* Clase Championship
*
* Representa los campeonatos
* Contiene los atributos del objecto campeonato
* 
* 
*
*/

class Championship
{

    /**
    * Id del campeonato
    * @var int
    */

    private $id;

    /**
    * fecha inicio inscripción
    * @var date
    */

    private $fechaInicioInscripcion;

    /**
    * fecha fin inscripción
    * @var date
    */

    private $fechaFinInscripcion;

    /**
    * fecha inicio campeonato
    * @var date
    */

    private $fechaInicioCampeonato;

    /**
    * fecha fin campeonato
    * @var date
    */

    private $fechaFinCampeonato;

    /**
    * nombre del campeonato
    * @var string
    */

    private $nombreCampeonato;

    /**
    * fase del campeonato
    * @var string
    */

    private $fase;

    public function __construct($id = NULL, $fechaInicioInscripcion = NULL, $fechaFinInscripcion = NULL, $fechaInicioCampeonato = NULL, $fechaFinCampeonato = NULL, $nombreCampeonato = NULL, $fase = NULL)
    {
        $this->id = $id;
        $this->fechaInicioInscripcion = $fechaInicioInscripcion;
        $this->fechaFinInscripcion = $fechaFinInscripcion;
        $this->fechaInicioCampeonato = $fechaInicioCampeonato;
        $this->fechaFinCampeonato = $fechaFinCampeonato;
        $this->nombreCampeonato = $nombreCampeonato;
        $this->fase = $fase;
    }

    /**
    * Devuelve el Id del campeonato
    *
    * @return id
    */

    public function getId()
    {
        return $this->id;
    }

    /**
    * Devuelve la fecha de inicio de inscripción
    *
    * @return date
    */

    public function getFechaInicioInscripcion()
    {
        return $this->fechaInicioInscripcion;
    }

    /**
    * Cambia valor de la fecha inicio inscripción
    *
    * @return void
    */

    public function setFechaInicioInscripcion($fecha)
    {
        $this->fechaInicioInscripcion = $fecha;
    }

    /**
    * Devuelve la fecha de fin de inscripción
    *
    * @return date
    */

    public function getFechaFinInscripcion()
    {
        return $this->fechaFinInscripcion;
    }

    /**
    * Cambia valor de la fecha fin inscripción
    *
    * @return void
    */

    public function setFechaFinInscripcion($fecha)
    {
        $this->fechaFinInscripcion = $fecha;
    }

    /**
    * Devuelve la fecha de inicio del campeonato
    *
    * @return date
    */

    public function getFechaInicioCampeonato()
    {
        return $this->fechaInicioCampeonato;
    }

    /**
    * Cambia valor de la fecha inicio campeonato
    *
    * @return void
    */

    public function setFechaInicioCampeonato($fecha)
    {
        $this->fechaInicioCampeonato = $fecha;
    }

    /**
    * Devuelve la fecha de fin del campeonato
    *
    * @return date
    */

    public function getFechaFinCampeonato()
    {
        return $this->fechaFinCampeonato;
    }

    /**
    * Cambia valor de la fecha fin campeonato
    *
    * @return void
    */


    public function setFechaFinCampeonato($fecha)
    {
        $this->fechaFinCampeonato = $fecha;
    }

    /**
    * Devuelve el nombre del campeonato
    *
    * @return string
    */

    public function getNombreCampeonato()
    {
        return $this->nombreCampeonato;
    }

    /**
    * Cambia valor del nombre del campeonato
    *
    * @return void
    */

    public function setNombreCampeonato($nombre)
    {
        $this->nombreCampeonato = $nombre;
    }

    /**
    * Devuelve la fase del campeonato
    *
    * @return string
    */

    public function getFase()
    {
        return $this->fase;
    }

    public function setFase($fase)
    {
        $this->fase = $fase;
    }

    /**
    * Comprueba si la instancia actual es válida
    * Por estar actualizado en la base de datos.
    *
    * @throws ValidationException si la instancia es
    * no es válido
    *
    * @return void
    */

    public function checkIsValidForCreate()
    {
        $errors = array();
        
        if (strlen(trim($this->fechaInicioInscripcion)) == 0) {
            $errors["fechaInicioInscripcion"] = "Registration start date is mandatory";
        }
        if (strlen(trim($this->fechaFinInscripcion)) == 0) {
            $errors["fechaFinInscripcion"] = "Registration limit date is mandatory";
        }
        if (strlen(trim($this->fechaInicioCampeonato)) == 0) {
            $errors["fechaInicioCampeonato"] = "Championship start date is mandatory";
        }
        if (strlen(trim($this->fechaFinCampeonato)) == 0) {
            $errors["fechaFinCampeonato"] = "Championship finish date is mandatory";
        }
        if (strlen(trim($this->nombreCampeonato)) == 0) {
            $errors["nombreCampeonato"] = "Championship name is mandatory";
        }
        if (sizeof($errors) > 0) {
            throw new ValidationException($errors, "Championship is not valid");
        }
    }

    /**
     * Comprueba si la instancia actual es válida
     * Por estar actualizado en la base de datos.
     *
     * @throws ValidationException si la instancia es
     *         no es válido
     *
     * @return void
     */
    public function checkIsValidForUpdate()
    {
        $errors = array();
        
        if (! isset($this->id)) {
            $errors["id"] = "id is mandatory";
        }
        
        try {
            $this->checkIsValidForCreate();
        } catch (ValidationException $ex) {
            foreach ($ex->getErrors() as $key => $error) {
                $errors[$key] = $error;
            }
        }
        if (sizeof($errors) > 0) {
            throw new ValidationException($errors, "Championship is not valid");
        }
    }

    /**
     * Retorna true en caso de que se deban generar enfrentamientos y false en caso de que aun no sea posible
     * @return boolean
     */
    public function needGenerateCalendar()
    {
        // Si está en fase de incripcion y se ha acabado el plazo de incripcion se puede avanzar
        if ($this->fase == "Inscripcion" && strtotime($this->getFechaFinInscripcion()) < strtotime(date("Y-m-d"))) {
            return true;
        } else if ($this->fase == "Final") {
            return false;
        } else {
            $confrontationMapper = new ConfrontationMapper();
            $groupMapper = new GroupMapper();
            
            $groups = $groupMapper->getGroupsFromChampionship($this->id);
            foreach ($groups as $group) {
                // si algun enfrentamiento NO tiene resultado retorno false
                if (! $confrontationMapper->hasAllConfrontationsResult($group->getIdGroup())) {
                    return false;
                }
            }
            // Si ningun grupo tiene entrentamientos pendientes se puede avanzar de ronda
            return true;
        }
        
        return false;
    }
}
