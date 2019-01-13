<?php
// file: model/Post.php
require_once (__DIR__ . "/../core/ValidationException.php");

/**
* Clase Category
*
* Representa las categorias de un campeonato
* Contiene los atributos del objecto categoria
* 
*
*/

class Category
{
    /**
    * Id de la categoria
    * @var int
    */

    private $id;

    /**
    * Nivel de la categoria
    * @var string
    */

    private $nivel;

    /**
    * Sexo de la categoria
    * @var string
    */

    private $sexo;

    public function __construct($id = NULL, $nivel = NULL, $sexo = NULL)
    {
        $this->id = $id;
        $this->nivel = $nivel;
        $this->sexo = $sexo;
    }

    /**
    * Devuelve id de la categoria
    *
    * @return int
    */

    public function getId()
    {
        return $this->id;
    }

    /**
    * Devuelve el nivel de la categoria
    *
    * @return string
    */

    public function getNivel()
    {
        return $this->nivel;
    }

    /**
    * Cambia valor del nivel
    *
    * @return void
    */

    public function setNivel($nivel)
    {
        $this->nivel = $nivel;
    }

    /**
    * Devuelve el sexo de la categoria
    *
    * @return string
    */

    public function getSexo()
    {
        return $this->sexo;
    }

    /**
    * Cambia valor del sexo
    *
    * @return void
    */

    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
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
        
        if (strlen(trim($this->nivel)) == 0) {
            $errors["nivel"] = "level in category is mandatory";
        }
        if (strlen(trim($this->sexo)) == 0) {
            $errors["sexo"] = "sex in category is mandatory";
        }
        if (sizeof($errors) > 0) {
            throw new ValidationException($errors, "Category is not valid");
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
            throw new ValidationException($errors, "Category is not valid");
        }
    }
}
