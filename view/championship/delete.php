<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");
$championship = $view->getVariable("championship");
$categories = $view->getVariable("categories");
$view->setVariable("title", i18n("Delete championship"));

?>

<h3><?php echo i18n("Delete championship") ?></h3>
  <form action="index.php?controller=championship&amp;action=delete" method="POST">
    <table class="table">
      <thead class="thead-dark">

        <tr>
          <th>
            <?php echo i18n("Championship name") ?> 
          </th>
          <td>
            <input type="text" class="form-control" name="name_championship" value="<?php echo $championship->getNombreCampeonato() ?>" readonly="readonly">
          </td> 
        </tr>

        <tr>
          <th>
            <?php echo i18n("Registration start date") ?> 
          </th>
          <td>
            <input type="text" class="form-control" name="date_start_inscription" value="<?php echo $championship->getFechaInicioInscripcion() ?>" readonly="readonly">
          </td> 
        </tr>

        <tr>
          <th>
            <?php echo i18n("Registration limit date") ?> 
          </th>
          <td>
            <input type="text" class="form-control" name="date_end_inscription" value="<?php echo $championship->getFechaFinInscripcion() ?>" readonly="readonly">
          </td> 
        </tr>

        <tr>
          <th>
            <?php echo i18n("Championship start date") ?> 
          </th>
          <td>
            <input type="text" class="form-control" name="date_start_championship" value="<?php echo $championship->getFechaInicioCampeonato() ?>" readonly="readonly">
          </td> 
        </tr>

        <tr>
          <th>
            <?php echo i18n("Championship finish date") ?> 
          </th>
          <td>
            <input type="text" class="form-control" name="date_end_championship" value="<?php echo $championship->getFechaFinCampeonato() ?>" readonly="readonly">
          </td> 
        </tr>
        
        <tr>
          <th>
            <?php echo i18n("Categories") ?> 
          </th>
          <td>
            <?php foreach ($categories as $category) {
              echo $category->getNivel() . "-" . $category->getSexo() . "<br/>";
            } ?>
          </td> 
        </tr>

      </thead>
    </table>

    <input type="hidden" name="id" value="<?php echo $championship->getId() ?>">

    <?= i18n("Are you sure to delete this championship?") ?> <br>

    <button type="submit" class="btn btn-primary" value="<?php echo i18n("Delete championship") ?>" ><?php echo i18n("Delete championship") ?></button>
  </form>

