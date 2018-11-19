<?php
//file: view/confrontation/selectGroup.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");
$confrontations = $view->getVariable("confrontations");
$view->setVariable("title", i18n("Confrontations"));
$cabecera = array("Pareja 1","Pareja 2","Fecha","Hora","Sets P1", "Sets P2");
?>

<h3><?= i18n("Confrontations")?></h3>

<form action="index.php?controller=confrontation&amp;action=setresults" method="POST">

  <table class="table table-striped">
  <thead>
    <?php foreach($cabecera as $valor) { ?>
        <th scope="col">
          <?php echo $valor; ?>
        </th>
      <?php } ?>
  </thead>
  <tbody>
   <?php foreach($confrontations as $confrontation) { ?>
      <tr>
        <td scope="col">
          <?php echo $confrontation->getPartner1Names(); ?>
        </td>
        <td scope="col">
          <?php echo $confrontation->getPartner2Names(); ?>
        </td>
        <td scope="col">
          <?php echo $confrontation->getDate(); ?>
        </td>
        <td scope="col">
          <?php echo $confrontation->getTime(); ?>
        </td>
        <td scope="col">
          <?php echo $confrontation->getSetsPartner1(); ?>
        </td>
        <td scope="col">
          <?php echo $confrontation->getSetsPartner2(); ?>
        </td>
      </tr>
      <?php } ?>
  </tbody>
</table>

<input type="hidden" name="idGrupo" value="<?php echo $idGrupo ?>">

</form>
