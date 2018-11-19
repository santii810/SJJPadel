<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");
$campeonatos = $view->getVariable("campeonatos");

$view->setVariable("title", i18n("Selecionar Campeonato") );

?>

<h3> <?= i18n("Selecionar Campeonato") ?> </h3>
<form action="index.php?controller=confrontation&amp;action=selectClasification" method="POST">

  <div class="form-group">
    <label for="idCampeonato" size="1"> <?= i18n("Campeonato") ?> </label>
    <select class="form-control" id="idCampeonato" name="idCampeonato">
      <option value=""> <?= i18n("Selecionar Campeonato") ?> </option>
      <?php foreach($campeonatos as $campeonato) {?>
        <option value="<?php echo $campeonato->getId() ?>"><?php echo $campeonato->getNombreCampeonato() ?> </option>
      <?php } ?>
    </select>
  </div> 

  <div class="form-group">
    <label for="idCampeonato" size="1"> <?= i18n("Categoria") ?> </label>
    <select class="form-control" name="idCategoria" id="idCategoria">    
    </select>
</div>
  
      
  <div class="form-group">
    <label for="idCampeonato" size="1"> <?= i18n("Grupo") ?> </label>
    <select class="form-control" name="idGrupo" id="idGrupo">
      
    </select>
  </div>

  <button type="submit" class="btn btn-primary" value="" > <?= i18n("Submit") ?> </button>

</form>
