<?php
/**
* Vista deleteInscription (championship)
*
* Vista que muestra un formulario con la opción de eliminar 
* la inscripción a un campeonato
* 
*
*/
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");
$inscription = $view->getVariable("inscription");
$view->setVariable("title", i18n("Delete inscription"));

?>

<h3><?php echo i18n("Delete inscription") ?></h3>
<form
	action="index.php?controller=championship&amp;action=deleteInscription"
	method="POST">
	<table class="table">
		<thead class="thead-dark">

			<tr>
				<th>
            <?php echo i18n("Captain") ?> 
          </th>
				<td><input type="text" class="form-control" name="idCaptain"
					value="<?php echo $inscription->getIdCaptain() ?>"
					readonly="readonly"></td>
			</tr>

			<tr>
				<th>
            <?php echo i18n("Fellow") ?> 
          </th>
				<td><input type="text" class="form-control" name="idFellow"
					value="<?php echo $inscription->getIdFellow() ?>"
					readonly="readonly"></td>
			</tr>

			<tr>
				<th>
            <?php echo i18n("Level") ?> 
          </th>
				<td><input type="text" class="form-control" name="level"
					value="<?php echo $inscription->getLevel() ?>" readonly="readonly">
				</td>
			</tr>

			<tr>
				<th>
            <?php echo i18n("Sex") ?> 
          </th>
				<td><input type="text" class="form-control" name="sex"
					value="<?php echo $inscription->getSex() ?>" readonly="readonly"></td>
			</tr>

			<tr>
				<th>
            <?php echo i18n("Championship name") ?> 
          </th>
				<td><input type="text" class="form-control" name="championship_name"
					value="<?php echo $inscription->getNameChampionship() ?>"
					readonly="readonly"></td>
			</tr>

		</thead>
	</table>

	<input type="hidden" name="id"
		value="<?php echo $inscription->getIdPartner() ?>">

    <?= i18n("Are you sure to delete this inscription?") ?> <br>

	<button type="submit" class="btn btn-primary"
		value="<?php echo i18n("Delete inscription") ?>"><?php echo i18n("Delete inscription") ?></button>
</form>

