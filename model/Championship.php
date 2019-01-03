<?php
// file: model/Post.php
require_once (__DIR__ . "/../core/ValidationException.php");

class Championship
{

    private $id;

    private $fechaInicioInscripcion;

    private $fechaFinInscripcion;

    private $fechaInicioCampeonato;

    private $fechaFinCampeonato;

    private $nombreCampeonato;

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

    public function getId()
    {
        return $this->id;
    }

    public function getFechaInicioInscripcion()
    {
        return $this->fechaInicioInscripcion;
    }

    public function setFechaInicioInscripcion($fecha)
    {
        $this->fechaInicioInscripcion = $fecha;
    }

    public function getFechaFinInscripcion()
    {
        return $this->fechaFinInscripcion;
    }

    public function setFechaFinInscripcion($fecha)
    {
        $this->fechaFinInscripcion = $fecha;
    }

    public function getFechaInicioCampeonato()
    {
        return $this->fechaInicioCampeonato;
    }

    public function setFechaInicioCampeonato($fecha)
    {
        $this->fechaInicioCampeonato = $fecha;
    }

    public function getFechaFinCampeonato()
    {
        return $this->fechaFinCampeonato;
    }

    public function setFechaFinCampeonato($fecha)
    {
        $this->fechaFinCampeonato = $fecha;
    }

    public function getNombreCampeonato()
    {
        return $this->nombreCampeonato;
    }

    public function setNombreCampeonato($nombre)
    {
        $this->nombreCampeonato = $nombre;
    }

    public function getFase()
    {
        return $this->fase;
    }

    public function setFase($fase)
    {
        $this->fase = $fase;
    }

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
     * Checks if the current instance is valid
     * for being updated in the database.
     *
     * @throws ValidationException if the instance is
     *         not valid
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
