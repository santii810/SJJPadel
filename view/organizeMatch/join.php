<?php
//file: view/oragnizeMatch/add.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$joinMatch = $view->getVariable("joinMatch");
$view->setVariable("title", "Unirse a Partido Organizado");
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
        <?= i18n("Participants"); ?>
      </th>
    </tr>
  </thead>
  <tbody>
        <tr>
            <td>
              <?= $joinMatch->getIdOrganizarPartido(); ?>
            </td>
            <td>
              <?= $joinMatch->getFecha(); ?>
            </td>
            <td>
              <?= $joinMatch->getHora(); ?>
            </td>
            <td>
              <?php foreach($joinMatch->getParticipants() as $participant): ?>
              <tr>
                <?= $participant ?>
              </tr>
            <?php endforeach; ?>
            </td>
        <tr>
  </tbody>
</table>

<form action="index.php?controller=organizeMatch&amp;action=join" method="POST">
  <input type="hidden" value="<?= $joinMatch->getIdOrganizarPartido(); ?>" name="idOrganizeMatch" id="idOrganizeMatch"/>
  <input class="button-organize" type="submit" value="<?= i18n("Join"); ?>"/>
</form>
