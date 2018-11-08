<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Login");
$errors = $view->getVariable("errors");
?>

<div class="login-form">
  <div class="main-div">
    <div class="panel">
   <h2><?= i18n("Users Login")?></h2>
   <p><?= i18n("Please enter your login and password")?></p>
   </div>
    <form id="Login" action="index.php?controller=users&amp;action=login" method="POST">
      <div class="form-group">
          <input type="text" class="form-control" id="login" name="login" placeholder="<?= i18n("Login here") ?>">
      </div>
      <div class="form-group">
          <input type="password" class="form-control" id="pass" name="pass" placeholder="<?= i18n("Password here") ?>">
      </div>
      <div class="forgot">
      <a href="index.php?controller=users&amp;action=register"><?= i18n("Register here!")?></a>
      </div>
        
        <button type="submit" class="btn btn-primary"><?= i18n("Iniciar sesion")?></button>

    </form>
  </div>
</div>







<!-- 

<h3><?= i18n("Login") ?></h3>
<?= isset($errors["general"])?$errors["general"]:"" ?>

<form class="form-inline" action="index.php?controller=users&amp;action=login" method="POST">
  <label for="login"> <?php echo i18n("Campeonato") ?> </label>
  <input type="text" class="form-control" id="login" name="login">

  <label for="pwd"><?php echo i18n("Contraseña") ?>:</label>
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

-->
