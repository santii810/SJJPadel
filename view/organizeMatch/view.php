<?php
//file: view/oragnizeMatch/add.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$organizedMatches = $view->getVariable("organizedMatches");
$view->setVariable("title", "Ver Partidos Organizados");
$currentRol = $view->getVariable("currentRol");

?>

  <h3><?= i18n("View Organized Matches"); ?></h3>
    <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">
          <?= i18n("IDMatch"); ?>
        </th>
        <th scope="col">
          <?= i18n("Date"); ?>
        </th>
        <th scope="col">
          <?= i18n("Time"); ?>
        </th>
        <th scope="col" colspan="2">
          <?= i18n("Opciones"); ?>
        </th>
      </tr>
    </thead>
    <tbody>
        <?php foreach($organizedMatches as $match): ?>
          <tr>
              <td>
                <?= $match->getIdOrganizarPartido() ; ?>
              </td>
              <td>
                <?= $match->getFecha(); ?>
              </td>
              <td>
                <?= $match->getHora(); ?>
              </td>
              <td>
                <?php if($currentRol == 'd'): ?>
                  <a href="index.php?controller=organizeMatch&amp;action=join&amp;idOrganizeMatch=<?=$match->getIdOrganizarPartido(); ?>"><i class="fas fa-plus-circle color-1"></i></a>
                <?php endif; ?>
                <?php if ($currentRol == 'a'): ?>
                  <a href="index.php?controller=organizeMatch&amp;action=delete&amp;idOrganizeMatch=<?=$match->getIdOrganizarPartido(); ?>"><i class="fas fa-trash-alt color-1"></i></a>
                <?php endif; ?>
              </form>
              </td>
          <tr>
        <?php endforeach; ?>
    </tbody>
  </table>
