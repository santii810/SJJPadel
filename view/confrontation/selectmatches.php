<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");
$campeonatos = $view->getVariable("campeonatos");
$view->setVariable("title", i18n("Select championship") );

?>

<h3><?= i18n("Select championship") ?></h3>
<form action="index.php?controller=confrontation&amp;action=select" method="POST">

  <div class="form-group">
    <label for="idCampeonato" size="1"><?= i18n("Championship") ?></label>
    <select class="form-control" id="idCampeonato" name="idCampeonato">
      <option value="0"><?= i18n("Select championship") ?></option>
      <?php foreach($campeonatos as $campeonato) {?>
        <option value="<?php echo $campeonato->getId() ?>"><?php echo $campeonato->getNombreCampeonato() ?> </option>
      <?php } ?>
    </select>
  </div> 

  <div class="form-group">
    <label for="idCampeonato" size="1"><?= i18n("Category") ?></label>
    <select class="form-control" name="idCategoria" id="idCategoria">    
    </select>
</div>
  
      
  <div class="form-group">
    <label for="idCampeonato" size="1"> <?= i18n("Group") ?> </label>
    <select class="form-control" name="idGrupo" id="idGrupo">
      
    </select>
  </div>

  <button type="submit" class="btn btn-primary" value="" ><?= i18n("Submit") ?></button>

</form>
