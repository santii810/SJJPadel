<?php
// file: view/oragnizeMatch/add.php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$statistics = $view->getVariable("statistics");
$titles = $view->getVariable("titles");
$view->setVariable("title", i18n("Statistics"));
$currentRol = $view->getVariable("currentRol");
?>

<h3><?= i18n("Reservation statistics"); ?></h3>
<?php for ($i=0;$i< sizeof($titles);$i++):?>
<table class="table">

	<thead class="thead-dark">
		<tr>
			<th scope="col" colspan="2">
        <?= i18n($titles[$i]); ?>
    	</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach ($statistics[$i] as $stats) :
        ?>
      <tr>
			<td><?= i18n($stats["left"]); ?></td>
			<td> <?= $stats["rigth"]?></td>
		<tr>
      <?php endforeach; ?>
	</tbody>
</table>
<?php endfor;?>

