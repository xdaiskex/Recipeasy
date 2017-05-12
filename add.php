<?php
	include "connection.php";
	session_start();

	if(isset($_POST['name']) && isset($_POST['link']) && isset($_POST['image']) && isset($_SESSION['user_id'])){
		$name = $_POST['name'];
		$image = $_POST['image'];
		$link = $_POST['link'];
		$user = $_SESSION['user_id'];

		//Inserts selected recipe into your favorites
		$insert = "INSERT INTO recipe (
					recipe,
					image,
					link,
					user_id)
				VALUES (
					'$name', 
					'$image', 
					'$link',
					'$user')";

		$result = $mysqli->query($insert);

		echo "success";
	}
	else{
		echo "error";
	}
?>