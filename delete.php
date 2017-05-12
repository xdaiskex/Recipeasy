<?php
	include "connection.php";
	session_start();

	if(isset($_POST['id']) && isset($_SESSION['user_id'])){
		$id = $_POST['id'];
		$user = $_SESSION['user_id'];

		//Delete selected recipe from favorites=
		$delete = "DELETE from recipe WHERE id = '$id'";

		$result = $mysqli->query($delete);

		$results = 0;

		$select = "SELECT
			id,
			recipe,
			image,
			link,
			user_id
		FROM recipe
		WHERE user_id = '$user'";

		$result2 = $mysqli->query($select);

		//Repopulate favorites section
		while($row = $result2->fetch_array(MYSQLI_ASSOC)){
			echo "<div class='col l4 m12 s12'>";
				echo "<div class='card'>";
					echo "<div class='card-image'>";
						echo "<img src='".$row['image']."' alt='".$row['id']."' class='food_image'>";
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
		//Check to see if anything was added to your favorites
		if($results == 0){
			echo "<p class='noFavorite center'> No recipes were added to your favorites </p>";
		}
	}
	else{
		echo "error";
	}
?>