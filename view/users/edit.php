<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");
$datos = $view->getVariable("datosUsuario");
$view->setVariable("title", i18n("Edit Users") );
?>

<h3><?php echo i18n("Edit") ?></h3>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6 col-xs-12">
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
            <?php echo i18n("Name") ?> 
          </th>
          <td>
            <input type="text" class="form-control" name="nombre" value="<?php echo $datos->getUserName() ?>">
          </td> 
      </tr>
      <tr>
          <th>
            <?php echo i18n("Surname") ?> 
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
            <?php if( $datos->getRol() == 'a' ){ ?>

            <div class="form-group">
              <select class="form-control" id="rol" name="rol">
                  <option selected="selected" value="a"><?php echo i18n("admin") ?></option>
                  <option value="e"><?php echo i18n("trainer") ?></option>
                  <option value="d"><?php echo i18n("deportist") ?></option>
              </select>
            </div> 

            <?php } else if( $datos->getRol() == 'e' ) { ?>

              <div class="form-group">
              <select class="form-control" id="rol" name="rol">
                  <option value="a"><?php echo i18n("admin") ?></option>
                  <option selected="selected" value="e"><?php echo i18n("trainer") ?></option>
                  <option value="d"><?php echo i18n("deportist") ?></option>
              </select>
            </div> 

            <?php } else { ?>  

              <select class="form-control" id="rol" name="rol">
                  <option value="a"><?php echo i18n("admin") ?></option>
                  <option value="e"><?php echo i18n("trainer") ?></option>
                  <option selected="selected" value="d"><?php echo i18n("deportist") ?></option>
              </select>

            <?php } ?>
            
          </td> 
      </tr>
      <tr>
          <th>
            <?php echo i18n("Gender") ?> 
          </th>
          <td>
          <?php if($datos->getGender() == 'masculino') { ?>
            <div class="form-group">
              <select class="form-control" id="genero" name="genero">
                  <option selected="selected" value="masculino"><?php echo i18n("male") ?></option>
                  <option value="femenino"><?php echo i18n("female") ?></option>
              </select>
            </div> 
          <?php } else { ?>
            <div class="form-group">
              <label for="genero" size="1"> <?= i18n("Gender") ?> </label>
              <select class="form-control" id="genero" name="genero">
                  <option value="masculino"><?php echo i18n("male") ?></option>
                  <option selected="selected" value="femenino"><?php echo i18n("female") ?></option>
              </select>
            </div> 
          <?php } ?>  
          </td> 
      </tr>
      </thead>
    </table>

    <input type="hidden" name="pass" value="<?php echo $datos->getPass() ?>">

    <button type="submit" class="btn btn-primary" value="submit" ><?= i18n("Edit") ?></button>
  </form>
</div></div></div>

