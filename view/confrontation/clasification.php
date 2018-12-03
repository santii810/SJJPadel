<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");

$clasificacion = $view->getVariable("clasificacion");
$idGrupo = $view->getVariable("idGrupo");
$parejas = $view->getVariable("parejas");

$view->setVariable("title", i18n("Clasification") );
$cabecera = array(i18n("Position"),i18n("Couple"),i18n("Total points"),i18n("Total sets"));

?>

<h3><?= i18n("Clasification") ?></h3>

<form action="index.php?controller=confrontation&amp;action=setresults" method="POST">

  <table class="table table-striped">
    <thead class="thead-dark">
      <?php foreach($cabecera as $valor) { ?>
        <th scope="col">
          <?php echo i18n( $valor ); ?>
        </th>
      <?php } ?>
    </thead>
    <tbody>
     <?php foreach($clasificacion as $key => $valor) { ?>
      <tr>
        <td scope="col">
          <?php echo $key + 1; ?>
        </td>
        <td scope="col">
          <?php echo $parejas[$valor[0]]; ?>
        </td>
        <td scope="col">
          <?php echo $valor[1]; ?>
        </td>
        <td scope="col">
          <?php echo $valor[2]; ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<table cellpadding="0" cellspacing="0" class="eliminatoria">
  <thead>
  <tr>
    <td colspan="2">Cuartos</td>
    <td colspan="2">Semifinales</td>
    <td colspan="3">Final</td>
    <td>Ganador</td>
  </tr>
  </thead>

  <tbody>
  <tr>
    <td>Equipo Rnd1</td>
    <td><img src="images/arriba.gif"></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>

  <tr>
    <td></td>
    <td><img src="images/mid.gif"></td>
    <td>Equipo Rnd2</td>
    <td><img src="images/arriba.gif"></td>
    <td></td>
  </tr>

  <tr>
    <td>Equipo Rnd1</td>
    <td><img src="images/abajo.gif"></td>
    <td></td>
    <td><img src="images/mid.gif"></td>
    <td></td>
  </tr>

  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td><img src="images/mid.gif"></td>
    <td>Equipo Rnd3</td>
    <td><img src="images/arriba.gif"></td>
  </tr>

  <tr>
    <td>Equipo Rnd1</td>
    <td><img src="images/arriba.gif"></td>
    <td></td>
    <td><img src="images/mid.gif"></td>
    <td></td>
    <td><img src="images/mid.gif"></td>
  </tr>

  <tr>
    <td></td>
    <td><img src="images/mid.gif"></td>
    <td>Equipo Rnd2</td>
    <td><img src="images/abajo.gif"></td>
    <td></td>
    <td><img src="images/mid.gif"></td>
  </tr>

  <tr>
    <td>Equipo Rnd1</td>
    <td><img src="images/abajo.gif"></td>
    <td></td>
    <td></td>
    <td></td>
    <td><img src="images/mid.gif"></td>
  </tr>

  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td><img src="images/mid.gif"></td>
    <td><img src="images/no.gif"></td>
    <td>Equipo Ganador</td>
  </tr>

  <tr>
    <td>Equipo Rnd1</td>
    <td><img src="images/arriba.gif"></td>
    <td></td>
    <td></td>
    <td></td>
    <td><img src="images/mid.gif"></td>
  </tr>

  <tr>
    <td></td>
    <td><img src="images/mid.gif"></td>
    <td>EquipoRnd2</td>
    <td><img src="images/arriba.gif"></td>
    <td></td>
    <td><img src="images/mid.gif"></td>
  </tr>

  <tr>
    <td>Equipo Rnd1</td>
    <td><img src="images/abajo.gif"></td>
    <td></td>
    <td><img src="images/mid.gif"></td>
    <td></td>
    <td><img src="images/mid.gif"></td>
  </tr>

  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td><img src="images/mid.gif"></td>
    <td>Equipo Rnd3</td>
    <td><img src="images/abajo.gif"></td>
  </tr>

  <tr>
    <td>Equipo Rnd1</td>
    <td><img src="images/arriba.gif"></td>
    <td></td>
    <td><img src="images/mid.gif"></td>
    <td></td>
  </tr>

  <tr>
    <td></td>
    <td><img src="images/mid.gif"></td>
    <td>Equipo Rnd2</td>
    <td><img src="images/abajo.gif"></td>
  </tr>

  <tr>
    <td>Equipo Rnd1</td>
    <td><img src="images/abajo.gif"></td>
    <td></td>
    <td></td>
  </tr>
  </tbody>
</table>

<input type="hidden" name="idGrupo" value="<?php echo $idGrupo ?>">

</form>
