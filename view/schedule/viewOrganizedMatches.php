<?php
/**
* viewOrganizedMatches (Schedule)
*
* Vista que muestra los partidos organizados que le quedan por jugar a un jugador
*
*
*/
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$organizedMatchesReservation = $view->getVariable("organizedMatchesReservation");
$view->setVariable("title", "Ver Partidos Organizados");

?>

<h2><?= i18n("See participation in organized matches"); ?></h2>
<?php if(empty($organizedMatchesReservation)): ?>
</br>
<h3><?= i18n("Not participate in a organnized match"); ?></h3>
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
    <?php foreach($organizedMatchesReservation as $reservation): ?>
      <tr>
  			<td>
          <?= $reservation->getDateReservation(); ?>
        </td>
  			<td>
          <?= substr($reservation->getHourReservation(), 0, 5) ?>
        </td>
  		<tr>
    <?php endforeach; ?>

	</tbody>
</table>
<?php endif; ?>
