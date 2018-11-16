<?php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");

$user = $view->getVariable("user");

$campeonatos = $view->getVariable("campeonatos");

$view->setVariable("title", "Inscripción");

?>

<h1>Inscripcion</h1>


<form class="justify-content-center align-items-center" action="index.php?controller=partner&amp;action=selectChampionship" method="POST">
	
	<label for="login">Login</label>
    <div class="form-group">
        <input type="text" class="form-control input-lg" id="login" name="login" aria-describedby="loginHelp" placeholder="Enter login" value="">
	   	<?= isset($errors["login"])?i18n($errors["login"]):"" ?><br>
    </div>
	
    <label for="idCampeonato" size="1">Campeonato</label>
	<div class="form-group">
		<select class="form-control" id="idCampeonato" name="idCampeonato">
			<?php foreach($campeonatos as $campeonato) {?>
				 <option value="<?php echo $campeonato->getId() ?>"><?php echo $campeonato->getNombreCampeonato() ?> </option>
			<?php } ?>
		</select>
	</div>
		
	 

  <button type="submit" class="btn btn-primary" value="" >Submit</button>

</form>
