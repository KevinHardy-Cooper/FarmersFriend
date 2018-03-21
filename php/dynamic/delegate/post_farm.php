<!-- 
 - File: post_farm.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Contains the logic flow to submit a new farm
 -->

<?php 
	# enable sessions to persist
	session_start();

	# create a database connection
	include '../../query/database_connection.php';

	# query the database for if a a valid user exists given the session token
	include '../../query/select_user_based_on_session.php'; 

	# if a valid user is returned then proceed and validate the data submitted as a new farm
	if (isset($result[0]['userID'])) {
		include 'validate_farm.php';
	} else {

		# if the user is using a fake token, then direct them to the sign in page
		header('Location: ../../static/sign_in.php?session=notLoggedIn');
	}
?>
