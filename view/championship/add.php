<?php
// file: view/users/register.php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$championship = $view->getVariable("championship");
$view->setVariable("title", i18n("Create championship"));
?>

<h3><?= i18n("Create championship")?></h3>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-sm-6 col-xs-12">
			<form action="index.php?controller=championship&amp;action=add"
				method="POST">
				<br> <br>

				<div class="form-group">
					<label for="nombreCampeonato"><?= i18n("Championship name")?></label> <input
						type="text" class="form-control" id="nombreCampeonato"
						name="nombreCampeonato" placeholder="Enter name"
						value="<?= $championship->getNombreCampeonato() ?>">
    <?= isset($errors["nombreCampeonato"])?i18n($errors["nombreCampeonato"]):"" ?><br>
				</div>

				<div class="form-group">
					<label for="fechaInicioInscripcion"><?= i18n("Registration start date")?></label>
					<input type="date" class="form-control" id="fechaInicioInscripcion"
						name="fechaInicioInscripcion" aria-describedby="loginHelp"
						placeholder="" value="" required>
    <?= isset($errors["fechaInicioInscripcion"])?i18n($errors["fechaInicioInscripcion"]):"" ?><br>
				</div>

				<div class="form-group">
					<label for="fechaFinInscripcion"><?= i18n("Registration limit date")?></label> <input
						type="date" class="form-control" id="fechaFinInscripcion"
						name="fechaFinInscripcion" aria-describedby="loginHelp"
						placeholder="" value="">
    <?= isset($errors["fechaFinInscripcion"])?i18n($errors["fechaFinInscripcion"]):"" ?><br>
				</div>

				<div class="form-group">
					<label for="fechaInicioCampeonato"><?= i18n("Championship start date")?></label>
					<input type="date" class="form-control" id="fechaInicioCampeonato"
						name="fechaInicioCampeonato" aria-describedby="loginHelp"
						placeholder="" value="">
    <?= isset($errors["fechaInicioCampeonato"])?i18n($errors["fechaInicioCampeonato"]):"" ?><br>
				</div>

				<div class="form-group">
					<label for="fechaFinCampeonato"><?= i18n("Championship finish date")?></label> <input
						type="date" class="form-control" id="fechaFinCampeonato"
						name="fechaFinCampeonato" aria-describedby="loginHelp"
						placeholder="" value="">
    <?= isset($errors["fechaFinCampeonato"])?i18n($errors["fechaFinCampeonato"]):"" ?><br>
				</div>
				<button type="submit" class="btn btn-primary" value=""><?= i18n("Register championship")?></button>

			</form>
		</div>
	</div>
</div>




