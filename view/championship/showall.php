<?php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");
$championships = $view->getVariable("championships");
$view->setVariable("title", i18n("Championships"));
$cabecera = array(
    "Championship name",
    "Registration start date",
    "Registration limit date",
    "Championship start date",
    "Championship finish date"
);
?>

<h3><?= i18n("Championships"); ?></h3>

<a href="index.php?controller=championship&amp;action=add"> <img
	src="images/addCampeonato.png" class="img-fluid" alt="Responsive image" />
</a>

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
    <?php foreach( $championships as $championship ) { ?>
      <tr>
			<td>
          <?php echo $championship->getNombreCampeonato() ; ?>
        </td>
			<td>
          <?php echo $championship->getFechaInicioInscripcion() ; ?>
        </td>
			<td>
          <?php echo $championship->getFechaFinInscripcion() ; ?>
        </td>
			<td>
          <?php echo $championship->getFechaInicioCampeonato() ; ?>
        </td>
			<td>
          <?php echo $championship->getFechaFinCampeonato() ; ?>
        </td>
			<td>
				<div class="cointainer">
					<a
						href="index.php?controller=championship&amp;action=edit&amp;id=<?php echo $championship->getId() ?>"
						class="h-25 d-inline-block"> <img src="images/editCampeonato.png"
						class="img-fluid" alt="Responsive image">
					</a> <a
						href="index.php?controller=championship&amp;action=delete&amp;id=<?php echo $championship->getId() ?>"
						class="h-25 d-inline-block"> <img
						src="images/deleteCampeonato.png" class="img-fluid"
						alt="Responsive image">
					</a>
					<!-- Muestra el icono para generar calendario solo si es posible -->
            <?php if($championship->needGenerateCalendar()): ?>
              <a
						href="index.php?controller=championship&amp;action=generateCalendar&amp;id=<?php echo $championship->getId() ?>">
						<img src="images/calendar64.png" class="img-fluid"
						alt="Responsive image">
					</a>
            <?php endif;?>

          </div>
			</td>
		</tr>  
    <?php } ?>
  </tbody>
</table>

