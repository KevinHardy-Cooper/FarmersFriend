<!-- 
 - File: log_out.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Contains the logic flow to log the user out of the session
 -->
<?php
	# enable sessions to persist
	session_start();

	# create the database connection
	require("../../query/database_connection.php");

	# delete the session identifier for the user
	require('../../query/delete_session.php');

	# unset session variables regarding logging in
	unset($_SESSION['loggedIn']);
	unset($_SESSION['sessionID']);

	# redirect user to index.php
	header("Location: ../../../index.php");
?>
