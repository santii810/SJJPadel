<?php
// file: model/OrganizedMatchMapper.php
require_once (__DIR__ . "/../core/PDOConnection.php");

class OrganizedMatchMapper
{
  /**
   * Reference to the PDO connection
   *
   * @var PDO
   */
  private $db;

  public function __construct()
  {
      $this->db = PDOConnection::getInstance();
  }

  /**
   * Saves a OrganizedMatch into the database
   *
   * @param OrganizedMatch $organizedMarch
   *            The match to be saved
   * @throws PDOException if a database error occurs
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
  * Retrieves all the user participate organize matches
  *
  * @throws PDOException if a database error occurs
  * @return mixed Array of OrganizedMatch instances
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
   * Delete an organizedMatch
   *
   * @throws PDOException if a database error occurs
   */
  public function delete($idPartidoOrganizado)
  {
      $stmt = $this->db->prepare("DELETE FROM partidoorganizado where idPartidoOrganizado=?");
      $stmt->execute(array( $idPartidoOrganizado ));
  }
}
