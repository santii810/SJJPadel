<?php
/**
* viewChampionshipMatches (Schedule)
*
* Vista que muestra los partidos de un campeonato 
* 
*
*/
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$championshipMatches = $view->getVariable("championshipMatches");
$view->setVariable("title", "Ver Partidos Organizados");

?>

<h2><?= i18n("See participation in championship matches"); ?></h2>
<?php if(empty($championshipMatches)): ?>
</br>
<h3><?= i18n("Not participate in a championship match"); ?></h3>
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
    <?php foreach($championshipMatches as $championshipMatch): ?>
      <tr>
  			<td>
          <?= $championshipMatch->getDate(); ?>
        </td>
  			<td>
          <?= substr($championshipMatch->getTime(), 0, 5) ?>
        </td>
  		<tr>
    <?php endforeach; ?>

	</tbody>
</table>
<?php endif; ?>
