<?php
/**
* viewReservationMatches (Schedule)
*
* Vista que muestra las reservas de pista que tiene hechas un jugador
*
*
*/
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$reservations = $view->getVariable("reservations");
$view->setVariable("title", "Ver Partidos Organizados");
$errors = $view->getVariable("errors");

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
			<th scope="col">
        <?= i18n("Options"); ?>
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
				<td>
					<form action="index.php?controller=reservation&amp;action=cancel"
						method="POST">
						<input type="hidden"
							value="<?= $reservation->getIdReservation(); ?>"
							name="idReservation" id="idReservation" /> <input
							class="button-organize" type="submit" value="<?= i18n("Cancel reservation"); ?>" />
					</form>
        </td>
  		<tr>

    <?php endforeach; ?>

	</tbody>
</table>
<?php endif; ?>
