<?php
/**
* selectclasification (confrontation)
*
* Vista que muestra los enfrentamientos de un grupo
* 
*
*/
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");
$confrontations = $view->getVariable("confrontations");
$view->setVariable("title", i18n("Enfrentamientos"));
$cabecera = array(
    "Pareja1",
    "Pareja2",
    "Fecha",
    "Hora",
    "Sets Pareja1",
    "Sets Pareja2"
);
?>

<h3><?= i18n("Enfrentamientos")?></h3>

<form action="index.php?controller=confrontation&amp;action=setresults"
	method="POST">

	<table class="table table-striped">
		<thead class="thead-dark">
    <?php foreach($cabecera as $valor) { ?>
        <th scope="col">
          <?php echo $valor; ?>
        </th>
      <?php } ?>
  </thead>
		<tbody>
   <?php foreach($confrontations as $confrontation) { ?>
      <tr>
				<td scope="col">
          <?php echo $confrontation->getPartner1Names(); ?>
        </td>
				<td scope="col">
          <?php echo $confrontation->getPartner2Names(); ?>
        </td>
				<td scope="col">
          <?php
    if ($confrontation->getDate() != null) {
        echo date_format(DateTime::createFromFormat("Y-m-d", $confrontation->getDate()), "d-m-Y");
    }
    ?>
        </td>
				<td scope="col">
          <?php echo substr($confrontation->getTime(), 0,5); ?>
        </td>
				<td scope="col">
          <?php echo $confrontation->getSetsPartner1(); ?>
        </td>
				<td scope="col">
          <?php echo $confrontation->getSetsPartner2(); ?>
        </td>
			</tr>
      <?php } ?>
  </tbody>
	</table>

	<input type="hidden" name="idGrupo" value="<?php echo $idGrupo ?>">

</form>
