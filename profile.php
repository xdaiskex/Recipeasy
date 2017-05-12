<?php
	include "connection.php";
	session_start();

	if(isset($_SESSION['fullName']) && isset($_SESSION['user_id'])){
		$user = $_SESSION['user_id'];
		$fullname = $_SESSION['fullName'];
		$first = $_SESSION['first'];
		$username = $_SESSION['username'];
	}
	else{
		header("Location: login.html");
	}

	//Stuff for profile image upload
	if(isset($_POST['upload']) && isset($_SESSION['first'])){
		$target = "images/".basename($_FILES['image']['name']);
		$image = $_FILES['image']['name'];
		$first = $_SESSION['first'];
		$username = $_SESSION['username'];

		$insert = "UPDATE login SET profile = '$image' WHERE username = '$username'";
		$result = $mysqli->query($insert);

		$select = "SELECT profile FROM login WHERE username = '$username'";
		$result2 = $mysqli->query($select);

		while($row = $result2->fetch_array(MYSQLI_ASSOC)){
			$_SESSION['profile'] = "<img src='images/".$row['profile']."' alt='profile' class='profile' onError=\"this.onerror=null;this.src='img/cage.jpg';\">";
		}
		
		move_uploaded_file($_FILES['image']['tmp_name'], $target);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profile</title>

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
					<a href="logout.php">Logout</a>
				</li>
	      	</ul>
		</div>
	</nav>

	<div id="main">
		<div class="container container2">
			<div class="row row2">
				<div class ="header2">
					<div class="col s12 center">
						<!-- <img src="img/profile.png" class="profile"> -->
						<?php 
							$select = "SELECT profile FROM login WHERE username = '$username'";
							$result2 = $mysqli->query($select);
							$counter = 0;
							while($row = $result2->fetch_array(MYSQLI_ASSOC)){
								$counter++;
								if($row['profile'] != ""){
									echo "<img src='images/".$row['profile']."' alt='profile' class='profile' onError=\"this.onerror=null;this.src='img/cage.jpg';\">";
								}
								else{
									echo "<img src='img/profile.png' class='profile'>";
								}					
							}
							
							echo "<h3 class='fullName'>".$_SESSION['fullName']."</h3>";
						?>
						<form action="" method="post" id="profileForm" enctype="multipart/form-data" class="col s12 l6 offset-l3">
							<div class="file-field input-field">
								<div class="btn red">
	        						<span>Change Photo</span>
									<input type="file" name="image" class="file" accept="image/*">
								</div>
								<div class="file-path-wrapper">
	        						<input class="file-path validate white-text" type="text">
	      						</div>
							</div>
							<input type="submit" name="upload" value="upload" class="btn btn-large red">
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col s12" id="favorites">
					<?php
						$results = 0;

						$select = "SELECT
							id,
							recipe,
							image,
							link,
							user_id
						FROM recipe
						WHERE user_id = '$user'";

						$result = $mysqli->query($select);

						while($row = $result->fetch_array(MYSQLI_ASSOC)){
							echo "<div class='col l4 m12 s12'>";
								echo "<div class='card'>";
									echo "<div class='card-image'>";
										echo "<img src='".$row['image']."' alt='".$row['id']."' class='food_image' onError=\"this.onerror=null;this.src='img/dead.png';\">";
										echo "<a class='btn-floating halfway-fab waves-effect waves-light red delete'><i class='material-icons'>delete</i></a>";
									echo "</div>";
									echo "<div class='card-content'>";
										echo "<p class='profileRecipe'>".$row['recipe']."</p>";
									echo "</div>";
									echo "<div class='card-action'>";
										echo "<a href='".$row['link']."' target='blank' class='black-text'>Recipe Link</a>";
									echo "</div>";
								echo "</div>";
							echo "</div>";
							$results++;
						}
						if($results == 0){
							echo "<p class='noFavorite center'> No recipes were added to your favorites </p>";
						}
					?>
				</div>
			</div>
		</div>
	</div>

	<!-- <footer class="page-footer">
		<div class="container">
			<div class="row">
				<div class="col l6 s12">
					<h5 class="white-text">Footer Content</h5>
					<p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
				</div>
				<div class="col l4 offset-l2 s12">
					<h5 class="white-text">Links</h5>
					<ul>
						<li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
						<li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
						<li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
						<li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="footer-copyright">
			<div class="container">
				© 2017 Copyright 
			</div>
		</div>
	</footer> -->

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