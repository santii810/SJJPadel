<?php
/**
* showAllInscriptionCurrentUser (championship)
*
* Vista que muestra una tabla con todas las inscripciones
* del usuario logeado
*
*/
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");
$championships = $view->getVariable("championships");

$view->setVariable("title", i18n("My inscriptions"));
$cabecera = array(
    "Captain",
    "Fellow",
    "Level",
    "Sex",
    "Name championship"
);
?>

<h3><?= i18n("My inscriptions"); ?></h3>

<table class="table">
	<thead class="thead-dark">
		<tr>
      <?php foreach( $cabecera as $valor ) { ?>
        <th scope="col">
          <?php echo i18n( $valor ); ?>
        </th>
      <?php } ?>
      <th scope="col" colspan="2">
        <?= i18n("Options"); ?>
      </th>
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
			<td><a
				href="index.php?controller=championship&amp;action=deleteInscription&amp;id=<?php echo $championship->getIdPartner() ?>">
					<img src="images/eliminarInscripcion.png" class="img-fluid"
					alt="Responsive image">
			</a></td>
		</tr>  
      <?php } ?>
  </tbody>
</table>