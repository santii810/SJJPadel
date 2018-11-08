<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");
$datos = $view->getVariable("datosUsuario");
$view->setVariable("title", "Editar Usuario");
?>

<h3><?php echo i18n("Editar") ?></h3>
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
            <?php if( $datos->getRol() == 'a' ){ ?>

            <div class="form-group">
              <select class="form-control" id="rol" name="rol">
                  <option selected="selected" value="a"><?php echo i18n("a") ?></option>
                  <option value="e"><?php echo i18n("e") ?></option>
                  <option value="d"><?php echo i18n("d") ?></option>
              </select>
            </div> 

            <?php } else if( $datos->getRol() == 'e' ) { ?>

              <div class="form-group">
              <select class="form-control" id="rol" name="rol">
                  <option value="a"><?php echo i18n("a") ?></option>
                  <option selected="selected" value="e"><?php echo i18n("e") ?></option>
                  <option value="d"><?php echo i18n("d") ?></option>
              </select>
            </div> 

            <?php } else { ?>  

              <select class="form-control" id="rol" name="rol">
                  <option value="a"><?php echo i18n("a") ?></option>
                  <option value="e"><?php echo i18n("e") ?></option>
                  <option selected="selected" value="d"><?php echo i18n("d") ?></option>
              </select>

            <?php } ?>
            
          </td> 
      </tr>
      <tr>
          <th>
            <?php echo i18n("genero") ?> 
          </th>
          <td>
          <?php if($datos->getGender() == 'masculino') { ?>
            <div class="form-group">
              <select class="form-control" id="genero" name="genero">
                  <option selected="selected" value="masculino"><?php echo i18n("masculino") ?></option>
                  <option value="femenino"><?php echo i18n("femenino") ?></option>
              </select>
            </div> 
          <?php } else { ?>
            <div class="form-group">
              <label for="genero" size="1">Genero</label>
              <select class="form-control" id="genero" name="genero">
                  <option value="masculino"><?php echo i18n("masculino") ?></option>
                  <option selected="selected" value="femenino"><?php echo i18n("femenino") ?></option>
              </select>
            </div> 
          <?php } ?>  
          </td> 
      </tr>
      </thead>
    </table>

    <input type="hidden" name="pass" value="<?php echo $datos->getPass() ?>">

    <button type="submit" class="btn btn-primary" value="submit" ><?= i18n("Editar") ?></button>
  </form>

