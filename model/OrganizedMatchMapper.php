<?php
// file: model/OrganizedMatchMapper.php
require_once (__DIR__ . "/../core/PDOConnection.php");

/**
* Clase OrganizedMatchMapper
*
* Interfaz de base de datos para entidades OrganizedMatchMapper
* 
*
*/
class OrganizedMatchMapper
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
   * Guarda un partido organizado 
   *
   * @param $organizedMatch
   * @return void
   */
  public function save(OrganizedMatch $organizedMatch)
  {
      $stmt = $this->db->prepare("INSERT INTO partidoorganizado (idReserva, login1, login2, login3, login4)
                      values (?,?,?,?,?)");
      $stmt->execute(array(
          $organizedMatch->getIdReserva(),
          $organizedMatch->getLogin1(),
          $organizedMatch->getLogin2(),
          $organizedMatch->getLogin3(),
          $organizedMatch->getLogin4()
      ));
  }

  /**
   * Devuelve los partidos organizados de un usuario
   *
   * @param $login
   * @return mixed OrganizedMatch
   */
  public function getUserMatches($login){
    $stmt = $this->db->prepare("SELECT * FROM partidoorganizado WHERE login1=? OR login2=? OR login3=? OR login4=?");
    $stmt->execute(array(
        $login,
        $login,
        $login,
        $login
    ));
    $userOrganizedMatches = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $organizesMatches = array();

    foreach($userOrganizedMatches as $OrganizedMatch){
      array_push($organizesMatches, new OrganizedMatch($OrganizedMatch["idPartidoOrganizado"], $OrganizedMatch["idReserva"],
                                        $OrganizedMatch["login1"], $OrganizedMatch["login2"], $OrganizedMatch["login3"], $OrganizedMatch["login4"]));
    }

    return $organizesMatches;
  }


  /**
   * Elimina un partido organizado 
   *
   * @param $idPartidoOrganizado
   * @return void
   */
  public function delete($idPartidoOrganizado)
  {
      $stmt = $this->db->prepare("DELETE FROM partidoorganizado where idPartidoOrganizado=?");
      $stmt->execute(array( $idPartidoOrganizado ));
  }
}
