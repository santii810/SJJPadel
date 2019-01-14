<?php
/**
* Vista calendarGenerated (championship)
*
* Vista que muestra un formulario para generar el calendario de campeonato
* 
*
*/
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");
$campeonatos = $view->getVariable("campeonatos");
$view->setVariable("title", i18n("Select championship"));
$message = $view->getVariable("messageToShow");
$showButton = $view->getVariable("showButton");

?>

<h3><?= i18n("Select championship")?></h3>
<form action="index.php?controller=confrontation&amp;action=selectGroup"
	method="POST">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-sm-8 col-xs-12">
				<br>
				<p class="text-center font-weight-bold"><?= $message ?> </p>
				<br>
				<?php if($showButton):?>
					<button type="submit" class="btn btn-primary" value=""><?= i18n("View confrontations")?></button>
				<?php endif;?>
			</div>
		</div>
	</div>
</form>