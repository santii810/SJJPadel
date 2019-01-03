<?php
// file: view/oragnizeMatch/add.php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$deleteMatch = $view->getVariable("deleteMatch");
$view->setVariable("title", "Borrar Partido Organizado");
$currentRol = $view->getVariable("currentRol");

?>


<h3><?= i18n("Delete Organized Match"); ?></h3>
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
              <?= $deleteMatch->getIdOrganizarPartido(); ?>
            </td>
			<td>
              <?= $deleteMatch->getFecha(); ?>
            </td>
			<td>
              <?= $deleteMatch->getHora(); ?>
            </td>
			<td>
              <?php foreach($deleteMatch->getParticipants() as $participant): ?>
                <div>
                  <?= $participant ?>
                </div>
              <?php endforeach; ?>
            </td>
		
		
		<tr>
	
	</tbody>
</table>

<form action="index.php?controller=organizeMatch&amp;action=delete"
	method="POST">
	<input type="hidden"
		value="<?= $deleteMatch->getIdOrganizarPartido(); ?>"
		name="idOrganizeMatch" id="idOrganizeMatch" /> <input
		class="button-organize" type="submit" value="<?= i18n("Delete"); ?>" />
</form>
