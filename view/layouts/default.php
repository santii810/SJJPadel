<?php
//file: view/layouts/default.php

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
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	

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
		<div class="container">

	      <div class="masthead">
	      	<img class="img-circle icono" src="images/icono.png">
	        
	        <div class="navbar">
	          <div class="navbar-inner">
	            <div class="container">
	              <ul class="nav">

	              	<?php if (isset($currentuser)): ?>
	              		
					<li>
						<img src="images/<?php echo $currentGender; ?>.png">
					</li>
					<li>
						<?= sprintf(i18n("%s"), $currentuser) ?>
					</li>
					<?php else: ?>
						<li>
							<a href="index.php?controller=users&amp;action=login">
								<img src="images/entrar.png" class="rounded" alt="Imágenes responsive">
							</a>
						</li>
					<?php endif ?>

	              	<div class="btn-group">
	              		<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
							<div class="btn-group" role="group">
								<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  Campeonato
								</button>
								<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
								  <a class="dropdown-item" href="index.php?controller=championship&amp;action=add">Crear</a>
								  <a class="dropdown-item" href="index.php?controller=partner&amp;action=selectChampionship">Inscripción</a>
								  <a class="dropdown-item" href="index.php?controller=confrontation&amp;action=select">Gestionar resultados</a>
								  <a class="dropdown-item" href="index.php?controller=confrontation&amp;action=selectClasification">Ver clasificación</a>
								</div>
							</div>
							<div class="btn-group" role="group">
								<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  Usuarios
								</button>
								<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
								  <a class="dropdown-item" href="index.php?controller=users&amp;action=showall">Mostrar Usuarios</a>
								  <a class="dropdown-item" href="#">Dropdown link</a>
								</div>
							</div>
							<div class="btn-group" role="group">
								<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  Pista
								</button>
								<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
								  <a class="dropdown-item" href="#">Dropdown link</a>
								  <a class="dropdown-item" href="#">Dropdown link</a>
								</div>
							</div>
							<div class="btn-group" role="group">
								<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  Partido
								</button>
								<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
								  <a class="dropdown-item" href="#">Dropdown link</a>
								  <a class="dropdown-item" href="#">Dropdown link</a>
								</div>
							</div>
							<div class="btn-group" role="group">
								<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  Dropdown
								</button>
								<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
								  <a class="dropdown-item" href="#">Dropdown link</a>
								  <a class="dropdown-item" href="#">Dropdown link</a>
								</div>
							</div>

							<?php if (isset($currentuser)): ?>
	              		
							<li>
								<a 	href="index.php?controller=users&amp;action=logout">
									<img src="images/salir.png" class="rounded" alt="Imágenes responsive">
								</a>
							</li>
			
							<?php endif ?>


						</div>

					</div>

	            </div>
	          </div>
	        </div><!-- /.navbar -->
	      </div>

	      <!-- Jumbotron -->
	      <div class="jumbotron">
	      	<div id="flash">
				<?= $view->popFlash() ?>
			</div>

			<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
	      </div>

	      <div class="footer">
	        <p>© Company 2013</p>
	        <?php
				include(__DIR__."/language_select_element.php");
			?>
	      </div>

    </div> <!-- /container -->

	</body>
</html>
