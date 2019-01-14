<?php
/**
* inscription (partner)
*
* Vista que muestra un formulario para inscribirse 
* con un compañero a una categoria
*
*/
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");

$categorias = $view->getVariable("categorias");
$idCampeonato = $view->getVariable("idCampeonato");
$login = $view->getVariable("login");

$view->setVariable("title", i18n("Sign up for championship"));

?>

<h3> <?= i18n("Sign up for championship") ?> </h3>



<form action="index.php?controller=partner&amp;action=inscription"
	method="POST">

	<div class="form-group">

		<label for="exampleFormControlSelect1" size="1"> <?= i18n("Category") ?> </label>

		<select class="form-control" id="idCategoria" name="idCategoria">

	  <?php foreach($categorias as $categoria) {?>
	    <option value="<?php echo $categoria->getId() ?>"><?php echo $categoria->getNivel()."-".$categoria->getSexo() ?> </option>
	  <?php } ?>

	</select> <span class="text-danger"><?= isset($errors["login"])?i18n($errors["login"]):"" ?></span><br>
	</div>

	<input type="hidden" name="idCampeonato"
		value="<?php echo $idCampeonato ?>"> <input type="hidden" name="login"
		value="<?php echo $login ?>">


	<button type="submit" class="btn btn-primary" name="" value=""> <?= i18n("Sign up") ?> </button>


</form>