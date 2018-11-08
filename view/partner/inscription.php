<?php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");

$categorias = $view->getVariable("categorias");
$idCampeonato = $view->getVariable("idCampeonato");
$login = $view->getVariable("login");

$view->setVariable("title", "Inscripción");

?>

<h3>Inscripcion</h3>


<form action="index.php?controller=partner&amp;action=inscription" method="POST">

	<div class="form-group">
	<label for="exampleFormControlSelect1" size="1">Categoria/nivel</label>
	<select class="form-control" id="idCategoria" name="idCategoria">

	  <?php foreach($categorias as $categoria) {?>
	    <option value="<?php echo $categoria->getId() ?>"><?php echo $categoria->getNivel()."-".$categoria->getNivel() ?> </option>
	  <?php } ?>

	</select>
	<?= isset($errors["login"])?i18n($errors["login"]):"" ?><br>
	</div> 

	<input type="hidden" name="idCampeonato" value="<?php echo $idCampeonato ?>">
	<input type="hidden" name="login" value="<?php echo $login ?>">

  <button type="submit" class="btn btn-primary" name="" value="" >Submit</button>

</form>