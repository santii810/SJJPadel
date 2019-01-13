<?php

// file: /core/ViewManager.php

/**
 * Clase ViewManager
 *
 * Esta clase implementa el pegamento entre el controlador.
 * y la vista.
 *
 * Esta clase es un singleton. Deberías usar getInstance ()
 * para obtener la instancia del gestor de vista.
 *
 * Las principales responsabilidades son:
 *
 * 1. Guardar las variables desde el controlador y ponerlas a disposición
 * para las vistas. Esto incluye variables "flash", que son
 * variables guardadas en sesión que se eliminan justo después
 * Se recuperan. Utilice métodos como setVariable, getVariable y
 * setFlash.
 *
 * 2.Render vistas. Esto básicamente realiza una 'inclusión' de la vista
 * archivo, pero con más parámetros orientados a MVC
 * (nombre del controlador y nombre de la vista).
 *
 * 3.Layout (o plantillas) del sistema. Basado en buffers de salida PHP
 * (funciones ob_). Una vez que se inicializa el gestor de vistas,
 * El búfer de salida está habilitado. Por defecto, todos los contenidos que están
 * generado dentro de sus vistas se guardará en un DEFAULT_FRAGMENT.
 * El DEFAULT_FRAGMENT se usa normalmente como el contenido "principal" de
 * El diseño resultante. Sin embargo, puedes generar contenidos para
 * Otros fragmentos que entrarán en el diseño. Por ejemplo, dentro
 * sus vistas, debe llamar a moveToFragment (fragmentName) antes
 * Generación de contenido para un fragmento deseado. Este fragmento normalmente
 * se recuperará después del diseño (mediante llamadas a getFragment).
 * Los fragmentos típicos son 'css', 'javascript', por lo que puede especificar
 * css y javascripts adicionales desde sus vistas específicas.
 *
 * @author lipido <lipido@gmail.com>
 */
class ViewManager
{

    /**
     * clave para el fragmento por defecto
     *
     * @var string
     */
    const DEFAULT_FRAGMENT = "__default__";

    /**
     * Contenidos amortiguados acumulados por cada fragmento.
     *
     * @var mixed
     */
    private $fragmentContents = array();

    /**
     * Valores de las variables de vista.
     *
     * @var mixed
     */
    private $variables = array();

    /**
     * El nombre del fragmento actual donde se está produciendo la salida.
     * acumulado
     *
     * @var string
     */
    private $currentFragment = self::DEFAULT_FRAGMENT;

    /**
     * El nombre del diseño que se utilizará en renderLayout
     *
     * @var string
     */
    private $layout = "default";

    private function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        ob_start();
    }

    // / BUFFER MANAGEMENT
    /**
     * Guarda el contenido del buffer de salida en
     * El fragmento actual.
     * Limpia el búfer de salida
     *
     * @return void
     */
    private function saveCurrentFragment()
    {
        
        $this->fragmentContents[$this->currentFragment] .= ob_get_contents();
       
        ob_clean();
    }

    /**
     * Cambia el fragmento actual donde se está acumulando la salida.
     *
     * La salida de corriente se guarda antes de cambiar.
     * Las salidas posteriores se acumularán en la especificada.
     * fragmento.
     *
     * @param string $name
     *            El nombre del fragmento para mover a
     * @return void
     */
    public function moveToFragment($name)
    {
        
        $this->saveCurrentFragment();
        $this->currentFragment = $name;
    }

    /**
     * Cambios en el fragmento por defecto.
     *
     * La salida de corriente se guarda antes de cambiar.
     * Las salidas posteriores se acumularán en el fragmento por defecto.
     *
     * @return void
     */
    public function moveToDefaultFragment()
    {
        $this->moveToFragment(self::DEFAULT_FRAGMENT);
    }

    /**
     * Obtiene los contenidos en un fragmento especificado.
     *
     * @param string $fragment
     *            El fragmento para recuperar los contenidos de.
     * @param string $default
     *            El contenido por defecto si el fragmento $ hace
     *            no existe
     * @return string Los contenidos del fragmento.
     */
    public function getFragment($fragment, $default = "")
    {
        if (! isset($this->fragmentContents[$fragment])) {
            return $default;
        }
        return $this->fragmentContents[$fragment];
    }

    // / GESTION DE VARIABLES
    
    /**
     * Establece una variable para la vista.
     *
     * Las variables también podrían mantenerse en sesión (a través del parámetro $ flash)
     *
     * @param string $varname
     *            El nombre de la variable
     * @param Object $value
     *            El valor de la variable.
     * @param boolean $flash
     *            Si el valor variable debe ser mantenido
     *            en sesión
     */
    public function setVariable($varname, $value, $flash = false)
    {
        $this->variables[$varname] = $value;
        if ($flash == true) {
            
            if (! isset($_SESSION["viewmanager__flasharray__"])) {
                $_SESSION["viewmanager__flasharray__"][$varname] = $value;
                print_r($_SESSION["viewmanager__flasharray__"]);
            } else {
                $_SESSION["viewmanager__flasharray__"][$varname] = $value;
            }
        }
    }

    /**
     * Recupera una variable previamente establecida.
     *
     * Si la variable es una variable flash, la elimina
     * de la sesión después de ser recuperado
     *
     * @param string $varname
     *            El nombre de la variable
     * @param $default Objecto
     *            Valor de la variable a devolver.
     * si la variable no existe
     * @return Valor del objeto de la variable.
     */
    public function getVariable($varname, $default = NULL)
    {
        if (! isset($this->variables[$varname])) {
            if (isset($_SESSION["viewmanager__flasharray__"]) && isset($_SESSION["viewmanager__flasharray__"][$varname])) {
                $toret = $_SESSION["viewmanager__flasharray__"][$varname];
                unset($_SESSION["viewmanager__flasharray__"][$varname]);
                return $toret;
            }
            return $default;
        }
        return $this->variables[$varname];
    }

    /**
     * Establece un mensaje flash.
     *
     * Los mensajes flash son útiles para pasar texto de una página a otra.
     * A través de redirecciones HTTP, sinde se mantienen en sesión.
     *
     * @param string $flashMessage
     *            El mensaje para guardar en sesión.
     * @return void
     */
    public function setFlash($flashMessage)
    {
        $this->setVariable("__flashmessage__", $flashMessage, true);
    }

    /**
     * Recupera el mensaje flash (y lo saca)
     *
     * @return cadena el mensaje flash
     */
    public function popFlash()
    {
        return $this->getVariable("__flashmessage__", "");
    }

    // / REPRESENTACIÓN
    
    /**
     * Establece el diseño que se utilizará cuando se llamará renderLayout
     *
     * @param string $layout
     *            El diseño a utilizar.
     * @return void
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * Representa una vista específica de un controlador específico
     *
     * Si el $ controller = mycontroller y $ view = myview, el
     * el archivo php seleccionado será: view / mycontroller / myview.php
     *
     * Utiliza el diseño seleccionado (a través de setLayout)
     * o el diseño predeterminado si no se ha especificado antes
     * llamando al método setLayout
     *
     * @param string $controller
     *            Nombre del controlador (en formato URL
     *            e.j: "posts")
     * @param string $viewname
     *            Nombre de la vista
     * @return void
     */
    public function render($controller, $viewname)
    {
        include (__DIR__ . "/../view/$controller/$viewname.php");
        $this->renderLayout();
    }

    /**
     * Envía una redirección HTTP 302 a una acción dada
     * dentro de un controlador
     *
     * @param string $controller
     *            El nombre del controlador
     * @param string $action
     *            El nombre de la acción
     * @param string $queryString
     *            Una cadena de consulta opcional
     * @return void
     */
    public function redirect($controller, $action, $queryString = NULL)
    {
        header("Location: index.php?controller=$controller&action=$action" . (isset($queryString) ? "&$queryString" : ""));
        
        die();
    }

    /**
     * Envía una redirección HTTP 302 a la página de referencia, que
     * es la página donde estaba el usuario, justo antes de hacer el actual
     * solicitud.
     *
     * @param string $queryString
     *            Una cadena de consulta opcional
     * @return void
     */
    public function redirectToReferer($queryString = NULL)
    {
        header("Location: " . $_SERVER["HTTP_REFERER"] . (isset($queryString) ? "&$queryString" : ""));
        die();
    }

    /**
     * Representa el diseño.
     *
     * Básicamente incluye el /view/layouts/[layout◆.php.
     * Normalmente, dentro del archivo de diseño, habrá llamadas a
     * recuperar contenido del fragmento, especialmente el fragmento predeterminado
     * contenidos.
     */
    private function renderLayout()
    {
        
        $this->moveToFragment("layout");
        
        
        include (__DIR__ . "/../view/layouts/" . $this->layout . ".php");
        
        ob_flush();
    }

    
    private static $viewmanager_singleton = NULL;

    public static function getInstance()
    {
        if (self::$viewmanager_singleton == null) {
            self::$viewmanager_singleton = new ViewManager();
        }
        return self::$viewmanager_singleton;
    }
}


ViewManager::getInstance();
