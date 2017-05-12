<?php
	include "connection.php";
	session_start();

	$_SESSION['validPass'] = false;

	if($_SESSION['validPass'] == false){
		//Check length of typed password
		if(isset($_POST['password'])){
			$_SESSION['password'] = $_POST['password'];
			$length = strlen($_SESSION['password']);
		}
		//Check to see if thep assword length is at least 6
		if(isset($_SESSION['password'])){
			if($length >= 6){
				$_SESSION['validPass'] = true;
			}
		}
	}

	if($_SESSION['validPass'] == true){
		echo "(Password length requirement met)";
	}
	else if($_SESSION['validPass'] == false && $length != 0){
		echo "(6 character length requirement)";
	}
?>