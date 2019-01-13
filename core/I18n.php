<?php

// file: /core/I18n.php

/**
 * Clase I18n
 *
 * Esta clase implementa una clase auxiliar para la internacionalización (I18n).
 * Básicamente, esta clase Singleton administra un conjunto de archivos de traducción.
 * (ubicado en /view/messages/language_[lang◆.php) y proporciona un
 * función de traducción: i18n (cadena)
 * También puede cambiar el idioma actual con la función setLanguage.
 * El último idioma seleccionado se guarda en la sesión del usuario por lo que es el
 * idioma recuperado cada vez que se crea una instancia de esta clase.
 * Además, este archivo crea una función global, i18n (), como acceso directo
 * a la función.
 * @author lipido <lipido@gmail.com>
 */
class I18n
{

    private $messages;

    const DEFAULT_LANGUAGE = "es";

    const CURRENT_LANGUAGE_SESSION_VAR = "__currentlang__";

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if (isset($_SESSION[self::CURRENT_LANGUAGE_SESSION_VAR])) {
            $this->setLanguage($_SESSION[self::CURRENT_LANGUAGE_SESSION_VAR]);
        } else {
            $this->setLanguage(self::DEFAULT_LANGUAGE);
        }
    }

    /**
     * Establece el idioma (y lo mantiene en la sesión de usuario)
     *
     * @param string $language
     *            
     * @return void
     */
    public function setLanguage($language)
    {
        // include language file
        include (__DIR__ . "/../view/messages/messages_$language.php");
        $this->messages = $i18n_messages;
        
        // save the language in session
        $_SESSION[self::CURRENT_LANGUAGE_SESSION_VAR] = $language;
    }

    /**
     * Encuentra la traducción actual de una clave dada.
     *
     * @param string $key
     *            La clave para traducir
     * @return string La traducción de la clave dada.
     */
    public function i18n($key)
    {
        if (isset($this->messages[$key])) {
            return $this->messages[$key];
        } else {
            return $key;
        }
    }

    // singleton
    private static $i18n_singleton = null;

    /**
     * Obtiene la instancia singleton de esta clase.
     *
     * @return I18n instancia singelton
     */
    public static function getInstance()
    {
        if (self::$i18n_singleton == NULL) {
            self::$i18n_singleton = new I18n();
        }
        return self::$i18n_singleton;
    }

    /**
     * Obtiene todos los mensajes en el idioma actual.
     *
     * @return Arrray de traducciones
     */
    public function getAllMessages()
    {
        return $this->messages;
    }
}

/**
 * Función i18n global de acceso directo para
 * @link I18n::i18n()
 *
 * @param string $key
 *            La clave para traducir
 * @return string La traducción de la clave dada.
 */
function i18n($key)
{
    return I18n::getInstance()->i18n($key);
}
