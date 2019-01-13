<?php
// file: controller/BaseController.php
require_once (__DIR__ . "/../core/ViewManager.php");
require_once (__DIR__ . "/../core/I18n.php");

require_once (__DIR__ . "/../model/User.php");
require_once (__DIR__ . "/../model/UserMapper.php");

/**
 * Clase BaseController
 *
 * Implementa un super constructor básico para
 * Los controladores en la aplicación de blog.
 * Básicamente, proporciona algo de protección.
 * Atributos y variables de vista.
 *
 * @author lipido <lipido@gmail.com>
 */
class BaseController
{

    /**
     * Instancia view manager
     *
     * @var ViewManager
     */
    protected $view;

    /**
     * instancia usuario actual
     *
     * @var User
     */
    protected $currentUser;

    public function __construct()
    {
        $this->view = ViewManager::getInstance();
        
        // get the current user and put it to the view
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if (isset($_SESSION["currentuser"])) {
            $userMapper = new UserMapper();
            $datosUser = $userMapper->getDatos($_SESSION["currentuser"]);
            
            // new User($_SESSION["currentuser"],$nombre,$apellidos,$pass,$rol,$genero);
            // Tiene todos los datos del usuario logeado
            $this->currentUser = $datosUser;
            
            // add current user to the view, since some views require it
            $this->view->setVariable("currentusername", $this->currentUser->getLogin());
            $this->view->setVariable("currentGender", $this->currentUser->getGender());
            $this->view->setVariable("currentRol", $this->currentUser->getRol());
        }
    }
}
