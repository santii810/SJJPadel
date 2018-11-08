<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");
$datos = $view->getVariable("datosUsuario");
$view->setVariable("title", "Editar Usuario");
?>

<h3>Usuarios</h3>
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
            <?php echo i18n("Nombre") ?> 
          </th>
          <td>
            <input type="text" class="form-control" name="nombre" value="<?php echo $datos->getUserName() ?>">
          </td> 
      </tr>
      <tr>
          <th>
            <?php echo i18n("Apellidos") ?> 
          </th>
          <td>
            <input type="text" class="form-control" name="apellidos" value="<?php echo $datos->getSurName() ?>">
          </td> 
      </tr>
      <tr>
          <th>
            <?php echo i18n("Rol") ?> 
          </th>
          <td>
            <input type="text" class="form-control" name="rol" value="<?php echo $datos->getRol() ?>">
          </td> 
      </tr>
      <tr>
          <th>
            <?php echo i18n("Genero") ?> 
          </th>
          <td>
          <?php if($datos->getGender() == 'masculino') { ?>
            <div class="form-group">
              <select class="form-control" id="genero" name="genero">
                  <option selected="selected" value="masculino"><?php echo i18n("Masculino") ?></option>
                  <option value="femenino"><?php echo i18n("Femenino") ?></option>
              </select>
            </div> 
          <?php } else { ?>
            <div class="form-group">
              <label for="genero" size="1">Genero</label>
              <select class="form-control" id="genero" name="genero">
                  <option value="masculino"><?php echo i18n("Masculino") ?></option>
                  <option selected="selected" value="femenino"><?php echo i18n("Femenino") ?></option>
              </select>
            </div> 
          <?php } ?>  
          </td> 
      </tr>
      </thead>
    </table>

    <input type="hidden" name="pass" value="<?php echo $datos->getPass() ?>">

    <button type="submit" class="btn btn-primary" value="submit" >Submit</button>
  </form>

