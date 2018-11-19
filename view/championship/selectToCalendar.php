<?php
//file: view/championship/selectToCalendar.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");
$campeonatos = $view->getVariable("campeonatos");
$view->setVariable("title", i18n("Select championship"));

?>

<h3><?= i18n("Select championship")?></h3>
<form action="index.php?controller=championship&amp;action=generateCalendar" method="POST">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6 col-xs-12">
        <div class="form-group">
          <select class="form-control" id="idCampeonato" name="idCampeonato">
            <option value="0"><?= i18n("Select championship")?></option>
            <?php foreach($campeonatos as $campeonato) {?>
              <option value="<?php echo $campeonato->getId() ?>"><?php echo $campeonato->getNombreCampeonato() ?> </option>
            <?php } ?>
          </select>
        </div> 
      </div> 
    </div> 
  </div>
  <button type="submit" class="btn btn-primary" value=""><?= i18n("Generate calendar")?></button>
</form>