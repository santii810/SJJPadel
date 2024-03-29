<?php
/**
* selectclasification (confrontation)
*
* Vista que muestra un formulario para modificar,ver,borrar o editar 
* resultados
*
*/
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");
$partidos = $view->getVariable("partidos");
$idGrupo = $view->getVariable("idGrupo");
$fase = $view->getVariable("fase");
$parejas = $view->getVariable("parejas");
$view->setVariable("title", i18n("Enter match results"));
$cabecera = array(
    i18n("Date"),
    i18n("Hour"),
    i18n("Couple 1"),
    i18n("Couple 2"),
    i18n("Points couple 1"),
    i18n("Points couple 2"),
    i18n("Sets couple 1"),
    i18n("Sets couple 2")
);

?>

<h3> <?= i18n("Enter match results") ?> </h3>
<form action="index.php?controller=confrontation&amp;action=setresults"
	method="POST">

	<table class="table table-striped">
		<thead class="thead-dark">
			<tr>
			<?php foreach($cabecera as $valor) { ?>
				<th scope="col">
					<?php echo i18n( $valor ); ?>
				</th>
			<?php } ?>
		</tr>
		</thead>
		<tbody>
		<?php foreach($partidos as $partido) { ?>
			<input type="hidden" name="idEnfrentamiento[]"
				value="<?php echo $partido->getIdConfrontation() ?>">
			<tr>
				<td>
					<?php echo $partido->getDate(); ?>
				</td>
				<td>
					<?php echo $partido->getTime(); ?>
				</td>
				<td>
					<?php echo $parejas[$partido->getIdPartner1()]; ?>
				</td>
				<td>
					<?php echo $parejas[$partido->getIdPartner2()]; ?>
				</td>
				<td>
					<?php echo $partido->getPointsPartner1(); ?>
				</td>
				<td>
					<?php echo $partido->getPointsPartner2(); ?>
				</td>
				<td>
					<div class="col-xs-3">
						<input class="form-control" type="number" name="setsPareja1[]"
							value="<?= $partido->getSetsPartner1() ?>">
					</div>
				</td>
				<td>
					<div class="col-xs-3">
						<input class="form-control" type="number" name="setsPareja2[]"
							value="<?= $partido->getSetsPartner2() ?>">
					</div>
				</td>
			</tr>
		<?php } ?>
	</tbody>
	</table>

	<input type="hidden" name="idGrupo" value="<?php echo $idGrupo ?>"> <input
		type="hidden" name="fase" value="<?php echo $fase ?>">

	<p class="text-danger">
		</span><?= isset($errors["result"])? i18n($errors["result"]) : "" ;?>
</p>
	<br>

	<button type="submit" class="btn btn-primary" value=""> <?= i18n("Save") ?> </button>


</form>
