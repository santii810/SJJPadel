<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");
$category = $view->getVariable("category");
$view->setVariable("title", i18n("Delete Category") );

?>

<h3><?php echo i18n("Delete Category") ?></h3>
  <form action="index.php?controller=category&amp;action=delete" method="POST">
    <table class="table">
      <thead class="thead-dark">

        <tr>
          <th>
            <?php echo i18n("Level") ?> 
          </th>
          <td>
            <input type="text" class="form-control" name="level" value="<?php echo $category->getNivel() ?>" readonly="readonly">
          </td> 
      </tr>
      <tr>
          <th>
            <?php echo i18n("Sex") ?> 
          </th>
          <td>
            <input type="text" class="form-control" name="sex" value="<?php echo $category->getSexo() ?>" readonly="readonly">
          </td> 
      </tr>
      
      </thead>
    </table>

    <input type="hidden" name="id" value="<?php echo $category->getId() ?>">

    <?= i18n("Are you sure to delete this category?") ?> <br>

    <button type="submit" class="btn btn-primary" value="<?php echo i18n("Delete") ?>" ><?php echo i18n("Delete") ?></button>
  </form>

