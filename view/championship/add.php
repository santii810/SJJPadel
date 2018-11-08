<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$championship = $view->getVariable("championship");
$view->setVariable("title", "Crear Campeonato");
?>

<h1>Crear Campeonato</h1>
<form action="index.php?controller=championship&amp;action=add" method="POST">

  <div class="form-group">
    <label for="fechaInicioInscripcion">Fecha Inicio Inscripción</label>
    <input type="date" class="form-control" id="fechaInicioInscripcion" name="fechaInicioInscripcion" aria-describedby="loginHelp" placeholder="" value="">
    <?= isset($errors["fechaInicioInscripcion"])?i18n($errors["fechaInicioInscripcion"]):"" ?><br>
  </div>

  <div class="form-group">
    <label for="fechaFinInscripcion">Fecha Fin Inscripción</label>
    <input type="date" class="form-control" id="fechaFinInscripcion" name="fechaFinInscripcion" aria-describedby="loginHelp" placeholder="" value="">
    <?= isset($errors["fechaFinInscripcion"])?i18n($errors["fechaFinInscripcion"]):"" ?><br>
  </div>

  <div class="form-group">
    <label for="fechaInicioCampeonato">Fecha Inicio Campeonato</label>
    <input type="date" class="form-control" id="fechaInicioCampeonato" name="fechaInicioCampeonato" aria-describedby="loginHelp" placeholder="" value="">
    <?= isset($errors["fechaInicioCampeonato"])?i18n($errors["fechaInicioCampeonato"]):"" ?><br>
  </div>

  <div class="form-group">
    <label for="fechaFinCampeonato">Fecha Fin Campeonato</label>
    <input type="date" class="form-control" id="fechaFinCampeonato" name="fechaFinCampeonato" aria-describedby="loginHelp" placeholder="" value="">
    <?= isset($errors["fechaFinCampeonato"])?i18n($errors["fechaFinCampeonato"]):"" ?><br>
  </div>

  <div class="form-group">
    <label for="nombreCampeonato">Nombre Campeonato</label>
    <input type="text" class="form-control" id="nombreCampeonato" name="nombreCampeonato" placeholder="Enter name" value="<?= $championship->getNombreCampeonato() ?>">
    <?= isset($errors["nombreCampeonato"])?i18n($errors["nombreCampeonato"]):"" ?><br>
  </div>

  <button type="submit" class="btn btn-primary" value="" >Submit</button>

</form>
