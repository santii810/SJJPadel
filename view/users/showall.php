<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");
$usuarios = $view->getVariable("usuarios");
$view->setVariable("title", "Usuarios");
$cabecera = array("login","nombre","apellidos","rol","genero");
?>

  <h3><?= i18n("Usuarios"); ?></h3>
  
  <a href="index.php?controller=users&amp;action=add">
    <img src="images/addUser.png" class="img-fluid" alt="Responsive image">
  </a>

  <table class="table">
  <thead class="thead-dark">
    <tr>
      <?php foreach($cabecera as $valor) { ?>
        <th scope="col">
          <?php echo i18n($valor); ?>
        </th>
      <?php } ?>
      <th scope="col" colspan="2">
        <?= i18n("Opciones"); ?>
      </th>
    </tr>
  </thead>
  <tbody>
      <?php foreach($usuarios as $user) { ?>
        <tr>
            <td>
              <?php echo $user->getLogin() ; ?>
            </td>
            <td>
              <?php echo $user->getUsername() ; ?>
            </td>
            <td>
              <?php echo $user->getSurname() ; ?>
            </td>
            <td>
              <?php echo i18n($user->getRol()) ; ?>
            </td>
            <td>
              <?php echo i18n($user->getGender()) ; ?>
            </td>
          <td>
            <a href="index.php?controller=users&amp;action=edit&amp;login=<?php echo $user->getLogin() ?>">
              <img src="images/editar.png" class="img-fluid" alt="Responsive image">
            </a>
            <a href="index.php?controller=users&amp;action=delete&amp;login=<?php echo $user->getLogin() ?>">
              <img src="images/eliminar.png" class="img-fluid" alt="Responsive image">
            </a>
          </td>
        <tr>  
      <?php } ?>
  </tbody>
</table>

