<?php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");

$posibleOffers = $view->getVariable("posibleOffers");
$view->setVariable("title", i18n("Confrontation Select") );

?>

<?php if(empty($posibleOffers)): ?>
  <h2><?= i18n("No offers available"); ?></h2>
<?php else: ?>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">
        <?= i18n("Fecha"); ?>
      </th>
      <th scope="col" colspan="2">
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
        <?= $offer->getFecha(); ?>
      </td>
      <td>
        <?= $offer->getHora(); ?>
      </td>
      <td>
        <a href="index.php?controller=confrontationOffer&amp;action=select&amp;idCategoriaCampeonato=<?= $category[3] ?>&amp;idCampeonato=<?= $category[4] ?>&amp;idCategoria=<?= $category[5] ?>&amp;idPareja=<?= $category[6] ?>">
          <i class="fas fa-angle-right"></i>
        </a>
      </td>
    <tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php endif; ?>

