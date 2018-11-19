<?php
//file: view/confrontation/selectGroup.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");
$campeonatos = $view->getVariable("campeonatos");
$view->setVariable("title", i18n("Select championship") );

?>

<h3><?= i18n("Select championship")?></h3>
<form action="index.php?controller=confrontation&amp;action=showConfrontations" method="POST">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6 col-xs-12">
        <div class="form-group">
          <label for="idCampeonato" size="1"> <?= i18n("Championship") ?> </label>
          <select class="form-control" id="idCampeonato" name="idCampeonato">
            <option value=""> <?= i18n("Select championship") ?> </option>
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
          <label for="idCampeonato" size="1"> <?= i18n("Group") ?> </label>
          <select class="form-control" name="idGrupo" id="idGrupo">

          </select>
        </div>  
      </div>  
    </div>  
  </div>

  <button type="submit" class="btn btn-primary" value="" ><?= i18n("View confrontations")?></button>

</form>
