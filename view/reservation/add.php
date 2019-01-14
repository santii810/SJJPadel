<?php
/**
* add (reservation)
*
* Vista que muestra una tabla con la información de la reserva 
* 
*
*/
require_once (__DIR__ . "/../../core/ViewManager.php");

$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$reservation = $view->getVariable("reservation");
$view->setVariable("title", "Pista reservada");

?>

<h2><?= i18n("Track reserved"); ?> </h2>
<p>
<div class="container">
	<div class="row">
		<div class="col-6 ">Fecha</div>
		<div class="col-6 ">
        <?php echo $reservation->getDateReservation();?>
      </div>
	</div>

	<div class="row">
		<div class="col-6 ">Hora</div>
		<div class="col-6 ">
        <?php echo $reservation->getHourReservation();?>
      </div>
	</div>
</div>