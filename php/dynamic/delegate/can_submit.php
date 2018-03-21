<!-- 
 - File: can_submit.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Contains the logic flow that allows only logged in users to have access to registering a farm
 -->

<?php 
	# enable sessions to persist
	session_start();

	# check if session variable is not null
	if (isset($_SESSION['loggedIn'])) {

		# include to content that allows the user to register a farm
		include '../../static/submission.php';
	} else {

		# if the user is not logged in, redirect user to sign in page
		header('Location: ../../static/sign_in.php?session=notLoggedIn');
	}
?>