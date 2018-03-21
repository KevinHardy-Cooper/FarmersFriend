<!-- 
 - File: log_out.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Contains the logic flow to log the user out of the session
 -->

<?php
	# enable sessions to persist
	session_start();

	# unset session variables regarding logging in
	unset($_SESSION['loggedIn']);
	unset($_SESSION['sessionID']);

	# redirect user to index.php
	header("Location: ../../../index.php");
?>
