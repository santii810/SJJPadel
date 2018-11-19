<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");
$partidos = $view->getVariable("partidos");
$idGrupo = $view->getVariable("idGrupo");
$parejas = $view->getVariable("parejas");
$view->setVariable("title", i18n("Enter match results") );
$cabecera = array("Id","Fecha","Hora","Pareja1","Pareja2","sets Pareja1","sets Pareja2");

?>

<h3> <?= i18n("Enter match results") ?> </h3>
<form action="index.php?controller=confrontation&amp;action=setresults" method="POST">

  <table class="table table-striped">
  <thead>
    <tr>
      <?php foreach($cabecera as $valor) { ?>
        <th scope="col">
          <?php echo i18n( $valor ); ?>
        </th>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
  <?php foreach($partidos as $partido) { ?>
    <input type="hidden" name="idEnfrentamiento[]" value="<?php echo $partido->getIdConfrontation() ?>">
    <tr>
      <td>
      <?php echo $partido->getIdConfrontation(); ?>
      </td>
      <td>
      <?php echo $partido->getDate(); ?>
      </td>
      <td>
      <?php echo $partido->getTime(); ?>
      </td>
      <td>
      <?php echo $parejas[$partido->getIdPartner1()]; ?>
      </td>
      <td>
      <?php echo $parejas[$partido->getIdPartner2()]; ?>
      </td>
      <td>
        <div class="col-xs-3">
          <input class="form-control" type="number" name="setsPareja1[]">
        </div>  
      </td>
      <td>
        <div class="col-xs-3">
          <input class="form-control" type="number" name="setsPareja2[]">
        </div>
      </td>
    </tr>
  <?php } ?>
  </tbody>
</table>

<input type="hidden" name="idGrupo" value="<?php echo $idGrupo ?>">
  
  <button type="submit" class="btn btn-primary" value="" > <?= i18n("Save") ?> </button>

</form>
