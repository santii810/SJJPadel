<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Login");
$errors = $view->getVariable("errors");
?>

<h3><?= i18n("Login") ?></h3>
<?= isset($errors["general"])?$errors["general"]:"" ?>

<form class="form-inline" action="index.php?controller=users&amp;action=login" method="POST">
  <label for="login">Login:</label>
  <input type="text" class="form-control" id="login" name="login">

  <label for="pwd">Contraseña:</label>
  <input type="password" class="form-control" id="pass" name="pass">

  <div class="form-check mb-2 mr-sm-2">
    <label class="form-check-label">
      <input class="form-check-input" type="checkbox"> Remember me
    </label>
  </div>
  <button type="submit" class="btn btn-primary" value="Iniciar sesion">Iniciar sesión</button>
</form>

<p><?= i18n("Not user?")?> <a href="index.php?controller=users&amp;action=register"><?= i18n("Register here!")?></a></p>
<?php $view->moveToFragment("css");?>
<link rel="stylesheet" type="text/css" src="css/style2.css">
<?php $view->moveToDefaultFragment(); ?>
