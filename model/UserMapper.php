<?php
// file: model/UserMapper.php
require_once (__DIR__ . "/../core/PDOConnection.php");

/**
* Clase UserMapper
*
* Interfaz de base de datos para entidades UserMapper
* 
*
*/
class UserMapper
{

    /**
     * Referencia a conexión PDO
     *
     * @var PDO
     */
    private $db;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }

    /**
     * Guarda un usuario 
     *
     * @param $user
     * @return void
     */
    public function save($user)
    {
        $stmt = $this->db->prepare("INSERT INTO usuario (login,nombre,apellidos,pass,rol,genero) 
												values (?,?,?,?,?,?)");
        $stmt->execute(array(
            $user->getLogin(),
            $user->getUsername(),
            $user->getSurname(),
            $user->getPass(),
            $user->getRol(),
            $user->getGender()
        ));
    }

    /**
     * Elimina un usuario 
     *
     * @param $login
     * @return void
     */
    public function borrar($login)
    {
        $stmt = $this->db->prepare("DELETE FROM usuario where login=?");
        $stmt->execute(array(
            $login
        ));
    }

    /**
     * Edita un usuario 
     *
     * @param $login, $nombre, $apellidos, $pass, $rol, $genero
     * @return void
     */
    public function editar($login, $nombre, $apellidos, $pass, $rol, $genero)
    {
        $stmt = $this->db->prepare("UPDATE usuario set nombre=?, apellidos=?, pass=?, rol=?, genero=? where login=?");
        $stmt->execute(array(
            $nombre,
            $apellidos,
            $pass,
            $rol,
            $genero,
            $login
        ));
    }

    /**
     * Comprueba si existe un usuario 
     *
     * @param $login
     * @return boolean
     */
    public function loginExists($login)
    {
        $stmt = $this->db->prepare("SELECT count(login) FROM usuario where login=?");
        $stmt->execute(array(
            $login
        ));
        
        if ($stmt->fetchColumn() > 0) {
            return true;
        }
    }

    /**
     * Comprueba si el usuario es valido
     *
     * @param $login, $pass
     * @return boolean
     */
    public function isValidUser($login, $pass)
    {
        $stmt = $this->db->prepare("SELECT count(login) FROM usuario where login=? and pass=?");
        $stmt->execute(array(
            $login,
            $pass
        ));
        
        if ($stmt->fetchColumn() > 0) {
            return true;
        }
    }

    /**
     * Devuelve los datos de un usuario 
     *
     * @param $login
     * @return User
     */
    public function getDatos($login)
    {
        $stmt = $this->db->prepare("SELECT * FROM usuario where login=?");
        $stmt->execute(array(
            $login
        ));
        
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $user = null;
        
        foreach ($toret_db as $datos) {
            $user = new User($datos['login'], $datos['nombre'], $datos['apellidos'], $datos['pass'], $datos['rol'], $datos['genero']);
        }
        
        return $user;
    }

    /**
     * Devuelve todos los usuarios 
     *
     * 
     * @return mixed User
     */
    public function getUsuarios()
    {
        $stmt = $this->db->query("SELECT *
								  FROM   usuario");
        $toret_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $users = array();
        
        foreach ($toret_db as $user) {
            array_push($users, new User($user['login'], $user['nombre'], $user['apellidos'], $user['pass'], $user['rol'], $user['genero']));
        }
        
        return $users;
    }
}
