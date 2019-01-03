<?php
// file: view/users/register.php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");

$clasificacion = $view->getVariable("clasificacion");
$idGrupo = $view->getVariable("idGrupo");
$parejas = $view->getVariable("parejas");

$cuartos = $view->getVariable("cuartos");
$semifinal = $view->getVariable("semifinal");
$final = $view->getVariable("final");

$view->setVariable("title", i18n("Clasification"));
$cabecera = array(
    i18n("Position"),
    i18n("Couple"),
    i18n("Total points"),
    i18n("Total sets")
);

?>

<h3><?= i18n("Clasification") ?></h3>

<form action="index.php?controller=confrontation&amp;action=setresults"
	method="POST">

	<table class="table table-striped">
		<thead class="thead-dark">
      <?php foreach($cabecera as $valor) { ?>
        <th scope="col">
          <?php echo i18n( $valor ); ?>
        </th>
      <?php } ?>
    </thead>
		<tbody>
     <?php foreach($clasificacion as $key => $valor) { ?>
      <tr>
				<td scope="col">
          <?php echo $key + 1; ?>
        </td>
				<td scope="col">
          <?php echo $parejas[$valor[0]]; ?>
        </td>
				<td scope="col">
          <?php echo $valor[1]; ?>
        </td>
				<td scope="col">
          <?php echo $valor[2]; ?>
        </td>
			</tr>
    <?php } ?>
  </tbody>
	</table>

	<table cellpadding="0" cellspacing="0" class="eliminatoria">
		<thead>
			<tr>
				<td colspan="2"><?= i18n("Quarter finals") ?></td>
				<td colspan="2"><?= i18n("Semifinal") ?></td>
				<td colspan="3"><?= i18n("Final") ?></td>
				<td><?= i18n("Champion") ?></td>
			</tr>
		</thead>

		<tbody>
			<tr>
				<td><?php if(!empty($cuartos[0])) echo $parejas[$cuartos[0]->getIdPartner1()] . " " . $cuartos[0]->getSetsPartner1() ?></td>
				<td><img src="images/arriba.gif"></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>

			<tr>
				<td></td>
				<td><img src="images/mid.gif"></td>
				<td><?php if(!empty($semifinal[0])) echo $parejas[$semifinal[0]->getIdPartner1()] . " " . $semifinal[0]->getSetsPartner1()?></td>
				<td><img src="images/arriba.gif"></td>
				<td></td>
			</tr>

			<tr>
				<td><?php if(!empty($cuartos[0])) echo $parejas[$cuartos[0]->getIdPartner2()] . " " . $cuartos[0]->getSetsPartner2()?></td>
				<td><img src="images/abajo.gif"></td>
				<td></td>
				<td><img src="images/mid.gif"></td>
				<td></td>
			</tr>

			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td><img src="images/mid.gif"></td>
				<td><?php if(!empty($final[0])) echo $parejas[$final[0]->getIdPartner1()] . " " . $final[0]->getSetsPartner1() ?></td>
				<td><img src="images/arriba.gif"></td>
			</tr>

			<tr>
				<td><?php if(!empty($cuartos[1])) echo $parejas[$cuartos[1]->getIdPartner1()] . " " . $cuartos[1]->getSetsPartner1() ?></td>
				<td><img src="images/arriba.gif"></td>
				<td></td>
				<td><img src="images/mid.gif"></td>
				<td></td>
				<td><img src="images/mid.gif"></td>
			</tr>

			<tr>
				<td></td>
				<td><img src="images/mid.gif"></td>
				<td><?php if(!empty($semifinal[0])) echo $parejas[$semifinal[0]->getIdPartner2()] . " " . $semifinal[0]->getSetsPartner2() ?></td>
				<td><img src="images/abajo.gif"></td>
				<td></td>
				<td><img src="images/mid.gif"></td>
			</tr>

			<tr>
				<td><?php if(!empty($cuartos[1])) echo $parejas[$cuartos[1]->getIdPartner2()] . " " . $cuartos[1]->getSetsPartner2() ?></td>
				<td><img src="images/abajo.gif"></td>
				<td></td>
				<td></td>
				<td></td>
				<td><img src="images/mid.gif"></td>
			</tr>

			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><img src="images/mid.gif"></td>
				<td><img src="images/no.gif"></td>
				<td>
      <?php
    if (! empty($final[0])) {
        if ($final[0]->getSetsPartner1() > $final[0]->getSetsPartner2()) {
            echo $parejas[$final[0]->getIdPartner1()];
        } else {
            echo $parejas[$final[0]->getIdPartner1()];
        }
    }
    ?>
    </td>
			</tr>

			<tr>
				<td><?php if(!empty($cuartos[2])) echo $parejas[$cuartos[2]->getIdPartner1()] . " " . $cuartos[2]->getSetsPartner1() ?></td>
				<td><img src="images/arriba.gif"></td>
				<td></td>
				<td></td>
				<td></td>
				<td><img src="images/mid.gif"></td>
			</tr>

			<tr>
				<td></td>
				<td><img src="images/mid.gif"></td>
				<td><?php if(!empty($semifinal[1])) echo $parejas[$semifinal[1]->getIdPartner1()] . " " . $semifinal[1]->getSetsPartner1() ?></td>
				<td><img src="images/arriba.gif"></td>
				<td></td>
				<td><img src="images/mid.gif"></td>
			</tr>

			<tr>
				<td><?php if(!empty($cuartos[2])) echo $parejas[$cuartos[2]->getIdPartner2()] . " " . $cuartos[2]->getSetsPartner2() ?></td>
				<td><img src="images/abajo.gif"></td>
				<td></td>
				<td><img src="images/mid.gif"></td>
				<td></td>
				<td><img src="images/mid.gif"></td>
			</tr>

			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td><img src="images/mid.gif"></td>
				<td><?php if(!empty($final[0])) echo $parejas[$final[0]->getIdPartner2()] . " " . $final[0]->getSetsPartner2() ?></td>
				<td><img src="images/abajo.gif"></td>
			</tr>

			<tr>
				<td><?php if(!empty($cuartos[3])) echo $parejas[$cuartos[3]->getIdPartner1()] . " " . $cuartos[3]->getSetsPartner1() ?></td>
				<td><img src="images/arriba.gif"></td>
				<td></td>
				<td><img src="images/mid.gif"></td>
				<td></td>
			</tr>

			<tr>
				<td></td>
				<td><img src="images/mid.gif"></td>
				<td><?php if(!empty($semifinal[0])) echo $parejas[$semifinal[1]->getIdPartner2()] . " " . $semifinal[1]->getSetsPartner2() ?></td>
				<td><img src="images/abajo.gif"></td>
			</tr>

			<tr>
				<td><?php if(!empty($cuartos[3])) echo $parejas[$cuartos[3]->getIdPartner2()] . " " . $cuartos[3]->getSetsPartner2() ?></td>
				<td><img src="images/abajo.gif"></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>

	<input type="hidden" name="idGrupo" value="<?php echo $idGrupo ?>">

</form>
