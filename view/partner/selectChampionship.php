<?php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");

$user = $view->getVariable("user");

$campeonatos = $view->getVariable("campeonatos");

$view->setVariable("title", "Inscripción");

?>

<h1>Inscripcion</h1>


<form action="index.php?controller=partner&amp;action=selectChampionship" method="POST">

	<div class="form-group">
    	<label for="login">Login</label>
    	<input type="text" class="form-control" id="login" name="login" aria-describedby="loginHelp" placeholder="Enter login" value="">
	   	<?= isset($errors["login"])?i18n($errors["login"]):"" ?><br>
	</div>	

	<div class="form-group">
		<label for="idCampeonato" size="1">Campeonato</label>
		<select class="form-control" id="idCampeonato" name="idCampeonato">
			<?php foreach($campeonatos as $campeonato) {?>
				 <option value="<?php echo $campeonato->getId() ?>"><?php echo $campeonato->getNombreCampeonato() ?> </option>
			<?php } ?>
		</select>
	</div> 

  <button type="submit" class="btn btn-primary" value="" >Submit</button>

</form>
