<?php
require_once (__DIR__ . "/../core/ViewManager.php");
require_once (__DIR__ . "/../core/I18n.php");

require_once (__DIR__ . "/../model/User.php");
require_once (__DIR__ . "/../model/UserMapper.php");

require_once (__DIR__ . "/../controller/BaseController.php");

/**
* Clase UsersController
*
* Controlador para realizar las operaciones de altas,bajas,modificaciones y
* consulta (CRUD)
* 
*
*/

class UsersController extends BaseController
{

    /**
     * Referencia UserMapper interaciona con
     * la base de datos
     *
     * @var UserMapper
     */

    private $userMapper;

    public function __construct()
    {
        parent::__construct();
        
        $this->userMapper = new UserMapper();
    }

    /**
    * Acción que muestra la página inicial 
    *
    * Muestra un mensaje de bienvenida al usuario
    *
    * @return void
    */

    public function index()
    {
        // put the array containing Post object to the view
        // $this->view->setVariable("posts", $posts);
        
        // render the view (/view/posts/index.php)
        $this->view->render("users", "start");
    }

    /**
    * Acción que muestra el formulario de logeo
    *
    * Muestra un formulario de logeo al usuario en el que se inserta
    * el nick del usuario y su contraseña
    * 
    * @return void
    */

    public function login()
    {
        if (! isset($_SESSION["currentuser"])) {
            if (isset($_POST["login"])) { // reaching via HTTP Post...
                                         // process login form
                if ($this->userMapper->isValidUser($_POST["login"], $_POST["pass"])) {
                    
                    $_SESSION["currentuser"] = $_POST["login"];
                    // send user to the restricted area (HTTP 302 code)
                    $this->view->redirect("users", "index");
                } else {
                    $errors = array();
                    $errors["general"] = "Login is not valid";
                    $this->view->setVariable("errors", $errors);
                    // render the view (/view/users/login.php)
                    $this->view->render("users", "login");
                }
            } else {
                // render the view (/view/users/login.php)
                $this->view->render("users", "login");
            }
        } else {
            // render the view (/view/users/login.php)
            $this->view->redirect("users", "index");
        }
    }

    /**
    * Acción que muestra el formulario de registro
    *
    * Muestra un formulario de registro al usuario en el que se insertan
    * el nick,nombre,apellidos,contraseña y genero
    * 
    * @return void
    */

    public function register()
    {
        $user = new User();
        
        if (isset($_POST["username"])) { // reaching via HTTP Post...
                                        
            // populate the User object with data form the form
            $user->setLogin($_POST["login"]);
            $user->setUsername($_POST["username"]);
            $user->setSurname($_POST["surname"]);
            $user->setPass($_POST["pass"]);
            $user->setRol('d');
            $user->setGender($_POST["gender"]);
            
            try {
                $user->checkIsValidForRegister(); // if it fails, ValidationException
                                                  
                // check if user exists in the database
                if (! $this->userMapper->loginExists($_POST["login"])) {
                    
                    // save the User object into the database
                    $this->userMapper->save($user);
                    
                    // POST-REDIRECT-GET
                    // Everything OK, we will redirect the user to the list of posts
                    // We want to see a message after redirection, so we establish
                    // a "flash" message (which is simply a Session variable) to be
                    // get in the view after redirection.
                    $this->view->setFlash("User successfully added. Please login now");
                    
                    // perform the redirection. More or less:
                    // header("Location: index.php?controller=users&action=login")
                    // die();
                    $this->view->redirect("users", "login");
                } else {
                    $errors = array();
                    $errors["login"] = "Login already exists";
                    $this->view->setVariable("errors", $errors);
                }
            } catch (ValidationException $ex) {
                // Get the errors array inside the exepction...
                $errors = $ex->getErrors();
                // And put it to the view as "errors" variable
                $this->view->setVariable("errors", $errors);
            }
        }
        
        // Put the User object visible to the view
        $this->view->setVariable("user", $user);
        
        // render the view (/view/users/register.php)
        $this->view->render("users", "register");
    }

    /**
    * Acción que muestra a todos los usuarios registrados
    *
    * Muestra una tabla con todos usuarios registrados en el sistema
    * 
    * 
    * @return void
    * @throws Exception Para mostrar usuarios es necesario ser administrador
    */

    public function showall()
    {
        if (! isset($this->currentUser)) {
            throw new Exception("Not in session. see users requires admin");
        }
        
        $userMapper = new UserMapper();
        
        $usuarios = $userMapper->getUsuarios();
        
        // Put the User object visible to the view
        $this->view->setVariable("usuarios", $usuarios);
        
        // render the view (/view/users/register.php)
        $this->view->render("users", "showall");
    }

    /**
    * Acción que borra a un usuario registrado
    *
    * Muestra al usuario seleccionado con sus datos y con la opción de borrado
    * 
    * 
    * @return void
    * @throws Exception Para borrar usuarios es necesario ser administrador
    */

    public function delete()
    {
        if (! isset($this->currentUser)) {
            throw new Exception("Not in session. delete user requires login");
        }
        
        $userMapper = new UserMapper();
        
        if (isset($_POST['login']) && isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['rol']) && isset($_POST['genero'])) {
            
            $userMapper->borrar($_POST['login']);
            
            $this->view->setFlash("successfully delete");
            
            $this->view->redirect("users", "showall");
            
        }
        
        $datos = $userMapper->getDatos($_REQUEST['login']);
        
        // Put the User object visible to the view
        $this->view->setVariable("datosUsuario", $datos);
        
        // render the view (/view/users/register.php)
        $this->view->render("users", "delete");
    }

    /**
    * Acción que edita a un usuario registrado
    *
    * Muestra al usuario seleccionado con sus datos y la posibilidad
    * de modificarlos
    * 
    * @return void
    * @throws Exception Para editar usuarios necesario ser administrador
    */

    public function edit()
    {
        if (! isset($this->currentUser)) {
            throw new Exception("Not in session. edit user requires sesion");
        }
        
        $userMapper = new UserMapper();
        
        if (isset($_POST['login']) && isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['rol']) && isset($_POST['genero'])) {
            
            $userMapper->editar($_POST['login'], $_POST['nombre'], $_POST['apellidos'], $_POST['pass'], $_POST['rol'], $_POST['genero']);
            
            $this->view->setFlash("successfully modify");
            
            $this->view->redirect("users", "showall");
        }
        
        $datos = $userMapper->getDatos($_REQUEST['login']);
        
        // Put the User object visible to the view
        $this->view->setVariable("datosUsuario", $datos);
        
        // render the view (/view/users/register.php)
        $this->view->render("users", "edit");
    }

    /**
    * Acción que muestra el formulario de añadir un usuario
    *
    * Muestra un formulario para añadir un usuario en el que se insertan
    * el nick,nombre,apellidos,contraseña y genero
    * 
    * @return void
    */

    public function add()
    {
        $user = new User();
        
        if (isset($_POST["username"])) { // reaching via HTTP Post...
                                        
            // populate the User object with data form the form
            $user->setLogin($_POST["login"]);
            $user->setUsername($_POST["username"]);
            $user->setSurname($_POST["surname"]);
            $user->setPass($_POST["pass"]);
            $user->setRol($_POST['rol']);
            $user->setGender($_POST["gender"]);
            
            try {
                $user->checkIsValidForRegister(); // if it fails, ValidationException
                                                  
                // check if user exists in the database
                if (! $this->userMapper->loginExists($_POST["login"])) {
                    
                    // save the User object into the database
                    $this->userMapper->save($user);
                    
                    // POST-REDIRECT-GET
                    // Everything OK, we will redirect the user to the list of posts
                    // We want to see a message after redirection, so we establish
                    // a "flash" message (which is simply a Session variable) to be
                    // get in the view after redirection.
                    $this->view->setFlash("User successfully added. Please login now");
                    
                    // perform the redirection. More or less:
                    // header("Location: index.php?controller=users&action=login")
                    // die();
                    $this->view->redirect("users", "login");
                } else {
                    $errors = array();
                    $errors["login"] = "Login already exists";
                    $this->view->setVariable("errors", $errors);
                }
            } catch (ValidationException $ex) {
                // Get the errors array inside the exepction...
                $errors = $ex->getErrors();
                // And put it to the view as "errors" variable
                $this->view->setVariable("errors", $errors);
            }
        }
        
        // Put the User object visible to the view
        $this->view->setVariable("user", $user);
        
        // render the view (/view/users/register.php)
        $this->view->render("users", "add");
    }

    /**
    * Acción que borra la sesión actual de un usuario
    *
    * Elimina la sesión del actual usuario logeado devolviendolo
    * a la vista de logeo
    * 
    * 
    * @return void
    */

    public function logout()
    {
        session_destroy();
        
        // perform a redirection. More or less:
        // header("Location: index.php?controller=users&action=login")
        // die();
        $this->view->redirect("users", "login");
    }
}
