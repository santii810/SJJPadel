<?php
// file: controller/LanguageController.php
require_once (__DIR__ . "/../core/I18n.php");

/**
 * Clase LanguageController
 *
 * Controlador para gestionar el idioma de la sesión.
 * Le permite cambiar el idioma actual
 * estableciéndolo en la instancia de I18n singleton
 * @author lipido <lipido@gmail.com>
 */
class LanguageController
{

    const LANGUAGE_SETTING = "__language__";

    /**
     * Acción para cambiar la lengua actual
     *
     *
     * @return void
     */
    public function change()
    {
        if (! isset($_GET["lang"])) {
            throw new Exception("no lang parameter was provided");
        }
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        I18n::getInstance()->setLanguage($_GET["lang"]);
        
        // go back to previous page
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        die();
    }

    /**
     * La acción obtiene un script de Javascript con una función ji18n (clave)
     *
     * Esto es útil para traducir cadenas dentro de sus archivos javascript (.js)
     * Tienes que incluir un <script src = "index.php? Controller = languages ​​& action = i18njs">
     * </script> etiqueta antes de todos sus scripts (en el diseño, por ejemplo).
     *
     * @return void
     */
    public function i18njs()
    {
        header('Content-type: application/javascript');
        echo "var i18nMessages = [];\n";
        echo "function ji18n(key) { if (key in i18nMessages) return i18nMessages[key]; else return key;}\n";
        foreach (I18n::getInstance()->getAllMessages() as $key => $value) {
            echo "i18nMessages['$key'] = '$value';\n";
        }
    }
}
