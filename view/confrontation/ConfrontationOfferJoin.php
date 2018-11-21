<?php
//file: view/oragnizeMatch/add.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$ofertaEnfrentamiento = $view->getVariable("ofertaEnfrentamiento");
$view->setVariable("title", "Aceptar oferta enfrentamiento");

?>

<h3><?= i18n("View Organized Matches"); ?></h3>
  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">
        <?= i18n("Partner Members"); ?>
      </th>
      <th scope="col">
        <?= i18n("Date"); ?>
      </th>
      <th scope="col">
        <?= i18n("Time"); ?>
      </th>
    </tr>
  </thead>
  <tbody>
        <tr>
            <td>
              <?= $ofertaEnfrentamiento->getIdGrupo(); ?>
            </td>
            <td>
              <?= $ofertaEnfrentamiento->getFecha(); ?>
            </td>
            <td>
              <?= $ofertaEnfrentamiento->getHora(); ?>
            </td>
        <tr>
  </tbody>
</table>
  <form action="index.php?controller=confrontationOffer&amp;action=join" method="POST">
    <input type="hidden" value="<?= $ofertaEnfrentamiento->getIdOfertaEnfrentamiento(); ?>" name="ifOfertaEnfrentamiento" id="ifOfertaEnfrentamiento"/>
    <input class="button-organize" type="submit" value="<?= i18n("Join"); ?>"/>
  </form>
