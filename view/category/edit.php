<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$category = $view->getVariable("category");
$view->setVariable("title", i18n("Edit category") );
?>
<h3><?= i18n("Edit category")?></h3>
<form action="index.php?controller=category&amp;action=edit" method="POST">
  
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6 col-xs-12">
  <div class="form-group">
    <label for="level"> <?= i18n("Level") ?> </label>
    <input type="text" class="form-control" id="level" name="level" aria-describedby="loginHelp" placeholder="<?= i18n("Enter level") ?>" value="<?= $category->getNivel() ?>">
    <?= isset($errors["nivel"])?i18n($errors["nivel"]):"" ?><br>
  </div>

  <?php if ($category->getSexo() == 'male') { ?>
    <div class="form-group">
    <label for="sex" size="1"> <?= i18n("Sex") ?> </label>
      <select class="form-control" id="sex" name="sex">
          <option value="mixto"><?php echo i18n("mixed") ?></option>
          <option selected="selected" value="masculino"><?php echo i18n("male") ?></option>
          <option value="femenino"><?php echo i18n("female") ?></option>
      </select>
    </div>
  <?php } else if ($category->getSexo() == 'female' ) { ?>
    <div class="form-group">
      <label for="sex" size="1"> <?= i18n("Sex") ?> </label>
      <select class="form-control" id="sex" name="sex">
          <option value="mixto"><?php echo i18n("mixed") ?></option>
          <option value="masculino"><?php echo i18n("male") ?></option>
          <option selected="selected" value="femenino"><?php echo i18n("female") ?></option>
      </select>
    </div>
  <?php } else { ?>
    <div class="form-group">
    <label for="sex" size="1"> <?= i18n("Sex") ?> </label>
      <select class="form-control" id="sex" name="sex">
          <option selected="selected" value="mixto"><?php echo i18n("mixed") ?></option>
          <option value="masculino"><?php echo i18n("male") ?></option>
          <option value="femenino"><?php echo i18n("female") ?></option>
      </select>
    </div>
  <?php } ?>

  <input type="hidden" name="id" value="<?= $category->getId() ?>" />

  <button type="submit" class="btn btn-primary" value="<?= i18n("Edit category")?>" ><?= i18n("Edit category")?></button>
</div></div></div>
</form>
