<?php

// file: core/ValidationException.php

/**
 * Clase ValidationException
 *
 * Una excepción simple que incluye una serie de errores.
 * Útil para la validación de formularios.
 * La matriz de errores contiene errores de validación, normalmente
 * indexado por formulario denominado parámetros.
 * @author lipido <lipido@gmail.com>
 */
class ValidationException extends Exception
{

    /**
     * Array de erroress
     *
     * @var mixed
     */
    private $errors = array();

    public function __construct(array $errors, $msg = NULL)
    {
        parent::__construct($msg);
        $this->errors = $errors;
    }

    /**
     * Obtiene los errores de validación.
     *
     * @return mixed Los errores de validación.
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
