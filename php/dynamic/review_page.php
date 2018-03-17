<?php 
	session_start();
	if (isset($_SESSION['loggedIn'])) {
		include '../query/database_connection.php';
		include '../query/select_farm.php';
		include 'templates/review_content.php';
	} else {
		header('Location: ../static/sign_in.php?session=notLoggedIn');
	}
 ?>