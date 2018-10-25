<!DOCTYPE html>
<html lang="en">
<head>
	<title>Plantilla CSS responsive mediante Bootstrap</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	<link rel="stylesheet" href="style.css"></link>
	
	
</head>
	<body>
		<div class="container">

	      <div class="masthead">
	        <h3 class="muted">SJJPadel</h3>
	        <div class="navbar">
	          <div class="navbar-inner">
	            <div class="container">
	              <ul class="nav">
	              	<div class="btn-group">
	              		<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
							<button type="button" class="btn btn-secondary">1</button>
							<button type="button" class="btn btn-secondary">2</button>

							<div class="btn-group" role="group">
								<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  Dropdown
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
							<div class="btn-group" role="group">
								<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  Dropdown
								</button>
								<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
								  <a class="dropdown-item" href="#">Dropdown link</a>
								  <a class="dropdown-item" href="#">Dropdown link</a>
								</div>
							</div>
						</div>

					</div>

	            </div>
	          </div>
	        </div><!-- /.navbar -->
	      </div>

	      <!-- Jumbotron -->
	      <div class="jumbotron">
	        <h1>Marketing stuff!</h1>
	        <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
	        <a class="btn btn-large btn-success" href="http://getbootstrap.com/2.3.2/examples/justified-nav.html#">Get started today</a>
	      </div>

	      <div class="footer">
	        <p>© Company 2013</p>
	      </div>

    </div> <!-- /container -->

	</body>
</html>
