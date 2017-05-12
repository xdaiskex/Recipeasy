<?php
	include "connection.php";
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>

	<!-- Reset CSS -->
	<link rel="stylesheet" type="text/css" href="css/reset.css">

	<!-- Latest compiled and minified Materialize CSS -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">

  	<!-- Icons -->
  	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  	<!-- Animate CSS -->
  	<link rel="stylesheet" type="text/css" href="css/animate.css">
  	
	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
	<nav>
		<div class="nav-wrapper container">
			<a href="index.php" class="brand-logo">RecipEasy</a>
			<a data-activates="mobile-demo" class="button-collapse">
				<i class="material-icons">menu</i>
			</a>
			<ul id="nav-mobile" class="right hide-on-med-and-down desktop-nav ">
				<li>
					<a href="index.php">Home</a>
				</li>
				<li>
					<a href="profile.php">Profile</a>
				</li>
				<li>
					<?php 
						if(isset($_SESSION['fullName']) && isset($_SESSION['user_id'])){
						?>
							<a href="logout.php">Logout</a>
						<?php
						}
						else{
							?>
							<a href="login.html">Login</a>
						<?php
						}
					?>
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
					<?php 
						if(isset($_SESSION['fullName']) && isset($_SESSION['user_id'])){
						?>
							<a href="logout.php">Logout</a>
						<?php
						}
						else{
							?>
							<a href="login.html">Login</a>
						<?php
						}
					?>
				</li>
	      	</ul>
		</div>
	</nav>

	<div id="main">
		<div class="header">
			<div class="container">
				<div class="row">
					<h4 class="center welcome">
						<?php 
							if(isset($_SESSION['first']) && isset($_SESSION['user_id'])){
								echo "Hello ".$_SESSION['first'].", what would you like to attempt to cook today?";
							}
							else{
								echo "Welcome visitor, please login to add recipes to your favorites.";
							}
						?>
					</h4>
					<p class="element"></p>
				</div>
				<div class="center row">
					<input type="text" id="foodSearch" placeholder="Search now for recipes" class="col s12 l6 offset-l3">
					<h3 id="error" class="center col s12">No results found</h3>
					<div class="center col s12" id="loading">
						<img src="img/loading.gif" alt="loading">
					</div>
				</div>
			</div>
			<div class="center" id="start">
				<a href="#food" class="red btn btn-large waves-effect waves-light col m4 offset-m4">Start Cooking</a>
			</div>
		</div>
		<div class="container foodContainer">
			<div class="row">
				<div id="food"></div>
			</div>	
		</div>
	</div>

	<!--  jQuery -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <!-- Latest compiled and minified Materialize JavaScript -->
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>

  	<!-- Type effect -->
  	<script src="js/typed.js"></script>

  	<!-- Mobile nav -->
  	<script src="js/init.js"></script>

  	<!-- Type effect -->
  	<script src="js/smoothscroll.js"></script>

  	<!-- Recipe API -->
  	<script src="js/recipe.js"></script>

  	<!-- Custom Ajax -->
  	<script src="js/ajax.js"></script>

  	<!-- Custom jQuery -->
  	<script src="js/jquery.js"></script>
</body>
</html>