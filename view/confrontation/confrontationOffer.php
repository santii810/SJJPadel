<?php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");

$category_wt_tournament = $view->getVariable("category_wt_tournament");
$view->setVariable("title", i18n("Select championship") );

?>

<?php if(empty($category_wt_tournament)): ?>
  <h2><?= i18n("You arent registered in a championship in game"); ?></h2>
<?php else: ?>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">
        <?= i18n("Championship Name"); ?>
      </th>
      <th scope="col">
        <?= i18n("Gender"); ?>
      </th>
      <th scope="col">
        <?= i18n("Level"); ?>
      </th>
      <th scope="col" colspan="2">
        <?= i18n("Options"); ?>
      </th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($category_wt_tournament as $category): ?>
    <tr>
      <td>
        <?= $category[0] ?>
      </td>
      <td>
        <?= $category[1] ?>
      </td>
      <td>
        <?= $category[2] ?>
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
