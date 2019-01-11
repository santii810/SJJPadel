<?php
// file: model/OrganizedMatch.php
require_once (__DIR__ . "/../core/ValidationException.php");

class OrganizedMatch
{

      private $idPartidoOrganizado;

      private $idReserva;

      private $login1;

      private $login2;

      private $login3;

      private $login4;

      public function __construct($idPartidoOrganizado = NULL, $idReserva = NULL, $login1 = NULL, $login2 = NULL, $login3 = NULL, $login4 = NULL)
      {
          $this->idPartidoOrganizado = $idPartidoOrganizado;
          $this->idReserva = $idReserva;
          $this->login1 = $login1;
          $this->login2 = $login2;
          $this->login3 = $login3;
          $this->login4 = $login4;
      }

      public function getIdPartidoOrganizado()
      {
          return $this->idPartidoOrganizado;
      }

      public function setIdPartidoOrganizado($idPartidoOrganizado)
      {
          $this->idPartidoOrganizado = $idPartidoOrganizado;
      }

      public function getIdReserva()
      {
          return $this->idReserva;
      }

      public function setIdReserva($idReserva)
      {
          $this->idReserva = $idReserva;
      }

      public function getLogin1()
      {
          return $this->login1;
      }

      public function setLogin1($login1)
      {
          $this->login1 = $login1;
      }

      public function getLogin2()
      {
          return $this->login2;
      }

      public function setLogin2($login2)
      {
          $this->login2 = $login2;
      }

      public function getLogin3()
      {
          return $this->login3;
      }

      public function setLogin3($login3)
      {
          $this->login3 = $login3;
      }

      public function getLogin4()
      {
          return $this->login4;
      }

      public function setLogin4($login4)
      {
          $this->login4 = $login4;
      }

}
