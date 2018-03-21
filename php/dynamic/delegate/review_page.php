<!-- 
 - File: review_page.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Contains the logic flow to review a farm
 -->

<?php 
	# enable sessions to persist
	session_start();

	# create a database connection
	include '../../query/database_connection.php';

	# query the database for if a a valid user exists given the session token
	include '../../query/select_user_based_on_session.php'; 

	# if a valid user is returned then proceed and show the review page
	if (isset($result[0]['userID'])) {

		# query the database for the farm
		include '../../query/select_farm.php';

		# display the content required to submit a review
		include '../template/review_content.php';
	} else {

		# if the user is using a fake token, then direct them to the sign in page
		header('Location: ../../static/sign_in.php?session=notLoggedIn');
	}
 ?>