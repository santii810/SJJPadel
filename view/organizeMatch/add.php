<?php
//file: view/oragnizeMatch/add.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$view->setVariable("title", "Organizar Partido");
?>

<h1>Organizar Partido</h1>
<form action="index.php?controller=organizeMatch&amp;action=add" method="POST">

  <div class="form-group">
    <label for="fechaInicioInscripcion">Fecha</label>
    <input type="date" class="form-control" id="dateOrganizeMatch" name="dateOrganizeMatch" aria-describedby="loginHelp">
    <?= isset($errors["dateIncorrect"])?i18n($errors["dateIncorrect"]):"" ?>
    <?= isset($errors["emptyDate"]) ? i18n($errors["emptyDate"]):"" ?>
  </div>

  <div class="form-group">
    <label for="fechaFinInscripcion">Hora</label>
    <select class="form-control" id="timeOrganizeMatch" name="timeOrganizeMatch" aria-describedby="loginHelp">
      <option value="10:00">10:00</option>
      <option value="11:30">11:30</option>
      <option value="13:00">13:00</option>
      <option value="16:00">16:00</option>
      <option value="17:30">17:30</option>
      <option value="19:00">19:00</option>
      <option value="20:30">20:30</option>
    </select>
    <?= isset($errors["timeEmpty"])?i18n($errors["timeEmpty"]):"" ?></br>
  </div>

  <button type="submit" class="btn btn-primary">Crear</button>

</form>
