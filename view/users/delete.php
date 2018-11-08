<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");
$datos = $view->getVariable("datosUsuario");
$view->setVariable("title", "Borrar Usuario");
$cabecera = array("login","nombre","apellidos","rol","genero");

?>

<h3><?php echo i18n("Eliminar") ?></h3>
  <form action="index.php?controller=users&amp;action=delete" method="POST">
      <form action="index.php?controller=users&amp;action=edit" method="POST">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th>
            <?php echo i18n("Login") ?> 
          </th>
          <td>
            <input type="text" class="form-control" name="login" value="<?php echo $datos->getLogin() ?>" readonly="readonly">
          </td> 
      </tr>
      <tr>
          <th>
            <?php echo i18n("nombre") ?> 
          </th>
          <td>
            <input type="text" class="form-control" name="nombre" value="<?php echo $datos->getUserName() ?>">
          </td> 
      </tr>
      <tr>
          <th>
            <?php echo i18n("apellidos") ?> 
          </th>
          <td>
            <input type="text" class="form-control" name="apellidos" value="<?php echo $datos->getSurName() ?>">
          </td> 
      </tr>
      <tr>
          <th>
            <?php echo i18n("rol") ?> 
          </th>
          <td>
            <input type="text" class="form-control" name="rol" value="<?php echo i18n($datos->getRol()) ?>">
          </td> 
      </tr>
      <tr>
        <th>
            <?php echo i18n("genero") ?> 
        </th>
        <td>
          <input type="text" class="form-control" name="rol" value="<?php echo i18n($datos->getGender()) ?>">
        </td> 
      </tr>
      </thead>
    </table>

    <input type="hidden" name="pass" value="<?php echo $datos->getPass() ?>">

    <?= i18n("¿Estas seguro de eliminar a este usuario?") ?> <br>

    <button type="submit" class="btn btn-primary" value="submit" ><?php echo i18n("Eliminar") ?></button>
  </form>

