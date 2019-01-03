<?php
// file: model/Post.php
require_once (__DIR__ . "/../core/ValidationException.php");

class Category
{

    private $id;

    private $nivel;

    private $sexo;

    public function __construct($id = NULL, $nivel = NULL, $sexo = NULL)
    {
        $this->id = $id;
        $this->nivel = $nivel;
        $this->sexo = $sexo;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNivel()
    {
        return $this->nivel;
    }

    public function setNivel($nivel)
    {
        $this->nivel = $nivel;
    }

    public function getSexo()
    {
        return $this->sexo;
    }

    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

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
            throw new ValidationException($errors, "Category is not valid");
        }
    }
}
