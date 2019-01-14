<?php
/**
* login (User)
*
* Vista que muestra un formulario para logearse en la aplicación 
* 
*
*/
require_once (__DIR__ . "/../../core/ViewManager.php");
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
		<form id="Login" action="index.php?controller=users&amp;action=login"
			method="POST">
			<div class="form-group">
				<input type="text" class="form-control" id="login" name="login"
					placeholder="<?= i18n("Login here") ?>">
			</div>
			<div class="form-group">
				<input type="password" class="form-control" id="pass" name="pass"
					placeholder="<?= i18n("Password here") ?>">
			</div>
			<div class="forgot">
				<a href="index.php?controller=users&amp;action=register"><?= i18n("Register here!")?></a>
			</div>

			<button type="submit" class="btn btn-primary"><?= i18n("Log in")?></button>

		</form>
	</div>
</div>







