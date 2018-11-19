<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $view->getVariable("user");
$view->setVariable("title", i18n("Register") );
?>
<h1><?= i18n("Register")?></h1>
<form action="index.php?controller=users&amp;action=register" method="POST">

  <div class="form-group">
    <label for="login"> <?= i18n("Login") ?> </label>
    <input type="text" class="form-control" id="login" name="login" aria-describedby="loginHelp" placeholder="Enter login" value="<?= $user->getLogin() ?>">
    <?= isset($errors["login"])?i18n($errors["login"]):"" ?><br>
  </div>

   <div class="form-group">
    <label for="username"> <?= i18n("Name") ?> </label>
    <input type="text" class="form-control" id="username" name="username" aria-describedby="nameHelp" placeholder="Enter Username" value="<?= $user->getUsername() ?>">
    <?= isset($errors["username"])?i18n($errors["username"]):"" ?><br>
  </div>

   <div class="form-group">
    <label for="surname"> <?= i18n("Surname") ?> </label>
    <input type="text" class="form-control" id="surname" name="surname" aria-describedby="surnameHelp" placeholder="Enter Surname" value="<?= $user->getSurname() ?>">
    <?= isset($errors["surname"])?i18n($errors["surname"]):"" ?><br>
  </div>

  <div class="form-group">
    <label for="pass"> <?= i18n("Password") ?> </label>
    <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" value="">
    <?= isset($errors["pass"])?i18n($errors["pass"]):"" ?><br>
  </div>

  <div class="form-group">
    <label for="gender" size="1"> <?= i18n("Gender") ?> </label>
    <select class="form-control" id="gender" name="gender">
        <option value="masculino"> <?= i18n("masculino") ?> </option>
        <option value="femenino"> <?= i18n("femenino") ?> </option>
    </select>
  </div> 

  <button type="submit" class="btn btn-primary" value="<?= i18n("Register")?>" >Submit</button>

</form>
