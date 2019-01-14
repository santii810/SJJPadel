<?php
/**
* showAllInscriptionAllUser (championship)
*
* Vista que muestra una tabla con todas las inscripciones
* de los usuarios
*
*/
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");
$championships = $view->getVariable("championships");

$view->setVariable("title", i18n("Inscriptions users"));
$cabecera = array(
    "Captain",
    "Fellow",
    "Level",
    "Sex",
    "Name championship"
);
?>

<h3><?= i18n("Inscriptions users"); ?></h3>

<table class="table">
	<thead class="thead-dark">
		<tr>
      <?php foreach( $cabecera as $valor ) { ?>
        <th scope="col">
          <?php echo i18n( $valor ); ?>
        </th>
      <?php } ?>
      
    </tr>

	</thead>
	<tbody>
      <?php foreach( $championships as $championship ) {  ?>
        <tr>

			<td>
              <?php echo $championship->getIdCaptain() ; ?>
            </td>
			<td>
              <?php echo $championship->getIdFellow() ; ?>
            </td>
			<td>
              <?php echo $championship->getLevel() ; ?>
            </td>
			<td>
              <?php echo $championship->getSex() ; ?>
            </td>
			<td>
              <?php echo $championship->getNameChampionship() ; ?>
            </td>
		</tr>  
      <?php } ?>
  </tbody>
</table>

