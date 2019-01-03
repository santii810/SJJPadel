<?php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");

$idCampeonato = $view->getVariable("idCampeonato");
$idPareja = $view->getVariable("idPareja");
$posibleOffers = $view->getVariable("posibleOffers");
$view->setVariable("title", i18n("Confrontation Select"));

?>
<div style="margin-bottom: 10px;">
	<a
		href="index.php?controller=confrontationOffer&amp;action=offer&amp;idPareja=<?= $idPareja ?>&amp;idCampeonato=<?= $idCampeonato ?>"><button
			class="button-organize"><?= i18n("Offer a Match"); ?></button></a>
</div>
<?php if(empty($posibleOffers)): ?>
<h2><?= i18n("No offers available"); ?></h2>
<?php else: ?>

<table class="table">
	<thead class="thead-dark">
		<tr>
			<th scope="col">
        <?= i18n("Partner Members"); ?>
      </th>
			<th scope="col">
        <?= i18n("Fecha"); ?>
      </th>
			<th scope="col">
        <?= i18n("Hour"); ?>
      </th>
			<th scope="col" colspan="2">
        <?= i18n("Options"); ?>
      </th>
		</tr>
	</thead>
	<tbody>
  <?php foreach ($posibleOffers as $offer): ?>
    <tr>
			<td>
        <?= $offer->getPareja()[0] ?> -
        <?= $offer->getPareja()[1] ?>
      </td>
			<td>
        <?= $offer->getFecha(); ?>
      </td>
			<td>
        <?= substr($offer->getHora(), 0, 5); ?>
      </td>
			<td><a
				href="index.php?controller=confrontationOffer&amp;action=join&amp;idOfertaEnfrentamiento=<?=$offer->getIdOfertaEnfrentamiento(); ?>&amp;idParejaOffer=<?= $offer->getIdPareja(); ?>&amp;idPareja=<?= $idPareja ?>"><i
					class="fas fa-plus-circle color-1"></i></a></td>
		</tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php endif; ?>
