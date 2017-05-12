<?php
	session_start();
	session_unset(); 
	session_destroy(); 
	header("refresh: 2; url = index.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Logout</title>

	<!-- Reset CSS -->
	<link rel="stylesheet" type="text/css" href="css/reset.css">

	<!-- Latest compiled and minified Materialize CSS -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">

  	<!-- Icons -->
  	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
	<nav>
		<div class="nav-wrapper container">
			<a href="index.php" class="brand-logo">RecipEasy</a>
			<a href="#" data-activates="mobile-demo" class="button-collapse">
				<i class="material-icons">menu</i>
			</a>
			<ul id="nav-mobile" class="right hide-on-med-and-down desktop-nav">
				<li>
					<a href="index.php">Home</a>
				</li>
				<li>
					<a href="profile.php">Profile</a>
				</li>
				<li>
					<a href="login.html">Login</a>
				</li>
			</ul>
			<ul class="side-nav" id="mobile-demo">
		        <li>
					<a href="index.php">Home</a>
				</li>
				<li>
					<a href="profile.php">Profile</a>
				</li>
				<li>
					<a href="login.html">Login</a>
				</li>
	      	</ul>
		</div>
	</nav>

	<div id="main">
		<div class="container">
			<div class="row">
				<div class="col s12 m6 offset-m3 center">
					<h2 class="loggedout">Successfully logged out!</h2>
					<br>
					<h3>Redirecting to home page...</h3>
					<img src="img/loading2.gif" alt="loading">
				</div>
			</div>
		</div>
	</div>

	<!--  jQuery -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <!-- Latest compiled and minified Materialize JavaScript -->
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>

  	<!-- Mobile nav -->
  	<script src="js/init.js"></script>

  	<!-- Recipe API -->
  	<script src="js/recipe.js"></script>

  	<!-- Custom Ajax -->
  	<script src="js/ajax.js"></script>

  	<!-- Custom jQuery -->
  	<script src="js/jquery.js"></script>
</body>
</html>