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
    <thead>
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

<input type="hidden" name="idGrupo" value="<?php echo $idGrupo ?>">

</form>
