<?php
// file: view/oragnizeMatch/add.php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$reservations = $view->getVariable("reservations");
$view->setVariable("title", "Ver Partidos Organizados");
$currentRol = $view->getVariable("currentRol");

?>

<h2><?= i18n("View My Reservations"); ?></h2>
<?php if(empty($reservations)): ?>
</br>
<h3><?= i18n("Not have reservations"); ?></h3>
<?php else: ?>
<table class="table">
	<thead class="thead-dark">
		<tr>
			<th scope="col">
        <?= i18n("Date"); ?>
      </th>
			<th scope="col">
        <?= i18n("Time"); ?>
      </th>
		</tr>
	</thead>
	<tbody>
    <?php foreach($reservations as $reservation): ?>
      <tr>
  			<td>
          <?= $reservation->getDateReservation(); ?>
        </td>
  			<td>
          <?= $reservation->getHourReservation(); ?>
        </td>
  		<tr>
    <?php endforeach; ?>

	</tbody>
</table>
<?php endif; ?>
