<?php
// file: view/layouts/default.php
$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");
$currentGender = $view->getVariable("currentGender");
$currentRol = $view->getVariable("currentRol");
?>
<!DOCTYPE html>
<html lang="en">
<head>

<title><?= $view->getVariable("title", "no title") ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="shortcut icon" href="images/favicon.ico" />

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
	integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
	crossorigin="anonymous">
<link rel="stylesheet"
	href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
	integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
	crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
	integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
	crossorigin="anonymous"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
	integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
	crossorigin="anonymous"></script>
<script type="text/javascript" src="fusioncharts/js/fusioncharts.js"></script>





<script src="index.php?controller=language&amp;action=i18njs">
	</script>
	<?= $view->getFragment("css") ?>
	<?= $view->getFragment("javascript") ?>

	<link rel="stylesheet" href="css/style.css" type="text/css">


<!-- provisional (hasta que sepa como meterlo con el viewManager)-->

<script language="javascript">
		$(document).ready(function(){
			$("#idCampeonato").change(function () {

				$("#idCampeonato option:selected").each(function () {
					$('#idGrupo').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
					var idCampeonato = $(this).val();

					$.post("includes/getCategorias.php", { idCampeonato: idCampeonato }, function(data){
						$("#idCategoria").html(data);
					});

				});
			})
		});

		$(document).ready(function(){
			$("#idCategoria").change(function () {
				$("#idCategoria option:selected").each(function () {
					var idCategoria = $(this).val();
					var idCampeonato = $("#idCampeonato").val();

					$.post("includes/getGrupos.php", { idCategoria: idCategoria,idCampeonato: idCampeonato }, function(data){
						$("#idGrupo").html(data);
					});
				});
			})
		});
	</script>


</head>
<body>
	<div class="contenedor">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<img class="img-circle icono" src="images/icono.png">
		<?php if (isset($currentuser)): ?>

			<img class="icono" src="images/<?php echo $currentGender; ?>.png"> <span
				class="username">
				<?= sprintf(i18n("%s"), $currentuser) ?>
			</span>
		<?php endif ?>

		<button class="navbar-toggler" type="button" data-toggle="collapse"
				data-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">

				<?php if($currentRol == 'a'): ?>

					<li class="nav-item"><a class="nav-link"
						href="index.php?controller=users&amp;action=showall"><?= i18n("Users") ?></a>
					</li>

				<?php endif ?>

				<?php if($currentRol == 'a'): ?>

					<li class="nav-item"><a class="nav-link"
						href="index.php?controller=championship&amp;action=showall"><?= i18n("Championships") ?></a>
					</li>

				<?php endif ?>

				<?php if($currentRol == 'a'): ?>

					<li class="nav-item"><a class="nav-link"
						href="index.php?controller=category&amp;action=showall"><?= i18n("Categories") ?></a>
					</li>

				<?php endif ?>

				<?php if($currentRol == 'd' || $currentRol == 'a' || $currentRol == 'e'): ?>

					<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
						href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false">
							<?php echo i18n("Championship") ?>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">

							<!-- Acciones administrador-->
							<?php if($currentRol == 'beta'): ?>
								<a class="dropdown-item"
								href="index.php?controller=championship&amp;action=add"><?php echo i18n("Create championship") ?></a>
							<?php endif ?>

							<?php if($currentRol == 'a'): ?>
								<a class="dropdown-item"
								href="index.php?controller=confrontation&amp;action=select"><?php echo i18n("Manage results") ?></a>
							<?php endif ?>

							<!-- Acciones jugadores/deportistas -->
							<?php if($currentRol == 'd' || $currentRol == 'e'): ?>
								<a class="dropdown-item"
								href="index.php?controller=partner&amp;action=selectChampionship"><?php echo i18n("Inscript to championship") ?></a>
							<?php endif ?>

							<?php if($currentRol == 'd' || $currentRol == 'e'): ?>
								<a class="dropdown-item"
								href="index.php?controller=confrontationOffer&amp;action=view"><?php echo i18n("Match Offer") ?></a>
							<?php endif ?>

							<?php if($currentRol == 'd' || $currentRol == 'a' || $currentRol == 'e'): ?>
								<a class="dropdown-item"
								href="index.php?controller=confrontation&amp;action=selectclasification"><?php echo i18n("Show clasification") ?></a>
							<?php endif ?>


							<?php if($currentRol == 'd' || $currentRol == 'a' || $currentRol == 'e'): ?>
								<a class="dropdown-item"
								href="index.php?controller=confrontation&amp;action=selectGroup"><?php echo i18n("View confrontations") ?></a>
							<?php endif ?>

							<?php if($currentRol == 'd' || $currentRol == 'a' || $currentRol == 'e'): ?>
								<a class="dropdown-item"
								href="index.php?controller=championship&amp;action=showallInscriptionCurrentUser"><?php echo i18n("View yours Inscriptions") ?></a>
							<?php endif ?>

							<?php if($currentRol == 'a'): ?>
								<a class="dropdown-item"
								href="index.php?controller=championship&amp;action=showallInscriptionAllUsers"><?php echo i18n("View Inscriptions all users") ?></a>
							<?php endif ?>

						</div></li>
				<?php endif ?>

				<?php if($currentRol == 'd' || $currentRol == 'a' || $currentRol == 'e'): ?>

					<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
						href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false">
							<?php echo i18n("Match") ?>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<!-- Acciones admin -->
							<?php if($currentRol == 'a'): ?>
								<a class="dropdown-item"
								href="index.php?controller=organizeMatch&amp;action=add"><?= i18n("Organize Match") ?></a>
							<?php endif ?>

							<!-- Acciones jugadores/deportistas -->
							<?php if($currentRol == 'd' || $currentRol == 'a' || $currentRol == 'e'): ?>
								<a class="dropdown-item"
								href="index.php?controller=reservation&amp;action=showAvaliableSchedules"><?= i18n("Reserve court") ?></a>
							<?php endif ?>

							<?php if($currentRol == 'd' || $currentRol == 'a' || $currentRol == 'e'): ?>
								<a class="dropdown-item"
								href="index.php?controller=organizeMatch&amp;action=viewAll"><?= i18n("View Organized Matches") ?></a>
							<?php endif ?>
						</div></li>



					<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
						href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false">
							<?php echo i18n("Statistics") ?>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<!-- Acciones admin -->

							<a class="dropdown-item"
								href="index.php?controller=statistics&amp;action=championshipStatistics">
						<?= i18n("Championship statistics") ?></a> <a
								class="dropdown-item"
								href="index.php?controller=statistics&amp;action=reservationStatistics">
						<?= i18n("Reservation statistics") ?></a>

						<?php if($currentRol == 'd' || $currentRol == 'e'): ?>
						<a class="dropdown-item"
								href="index.php?controller=statistics&amp;action=personalStatistics">
						<?= i18n("Personal statistics") ?></a>
						<?php endif ?>


						</div></li>
				<?php endif ?>

				<?php if($currentRol == 'd' || $currentRol == 'e'): ?>
					<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
						href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false">
							<?php echo i18n("Schedule") ?>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<!-- Acciones admin -->

							<a class="dropdown-item"
									href="index.php?controller=schedule&amp;action=viewChampionshipMatches">
									<?= i18n("Championship Matches") ?></a>

							<a class="dropdown-item"
									href="index.php?controller=schedule&amp;action=viewReservations">
									<?= i18n("Reservations") ?></a>

							<a class="dropdown-item"
									href="index.php?controller=schedule&amp;action=viewOrganizedMatches">
									<?= i18n("Organized Matches") ?></a>

						</div>
					</li>
				<?php endif ?>








				</ul>

			</div>
			<li class="nav-item">
			<?php include(__DIR__."/language_select_element.php"); ?>
		</li>
			<li class="nav-item">
			<?php if (isset($currentuser)): ?>
				<a href="index.php?controller=users&amp;action=logout"> <img
					src="images/salir.png" class="rounded icono"
					alt="Im�genes responsive">
			</a>
				<?php else: ?>
					<a href="index.php?controller=users&amp;action=login"> <img
					src="images/entrar.png" class="rounded icono"
					alt="Im�genes responsive">
			</a>
				<?php endif ?>
			</li>
		</nav>

		<!-- Container -->
		<div class="container">
			<!-- Jumbotron -->
			<div class="jumbotron">
				<div id="flash">
					<?= i18n( $view->popFlash() ) ?>
				</div>

				<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
			</div>
		</div>

		<footer id="myFooter">
			<div class="container">
				<div class="row">
					<div class="col-sm-3 myCols"></div>
				</div>
				<div class="social-networks"></div>
				<div class="footer-copyright">
					<p>� 2018 SJJPadel Company</p>
				</div>

		</footer>
	</div>


</body>
</html>
