<?php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");

$user = $view->getVariable("user");

$campeonatos = $view->getVariable("campeonatos");


$view->setVariable("title", i18n("Sign up for championship") );

?>

<h3> <?= i18n("Sign up for championship") ?> </h3>



<form class="justify-content-center align-items-center" action="index.php?controller=partner&amp;action=selectChampionship" method="POST">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-sm-6 col-xs-12">

				<label for="login"> <?= i18n("Couple username") ?> </label>

				<div class="form-group">
					<input type="text" class="form-control input-lg" id="login" name="login" aria-describedby="loginHelp" placeholder="<?=i18n("Couple username")?>" value="">
					<span class="text-danger"><?= isset($errors["login"])?i18n($errors["login"]):"" ?></span><br>
				</div>
				

				<label for="idCampeonato" size="1"> <?= i18n("Championship") ?> </label>

				<div class="form-group">
					<select class="form-control" id="idCampeonato" name="idCampeonato">
						<?php foreach($campeonatos as $campeonato) {?>
							<option value="<?php echo $campeonato->getId() ?>"><?php echo $campeonato->getNombreCampeonato() ?> </option>
						<?php } ?>
					</select>
				</div>
				

				<button type="submit" class="btn btn-primary" value="" > <?= i18n("Sign up") ?> </button>

			</div></div></div>
		</form>
