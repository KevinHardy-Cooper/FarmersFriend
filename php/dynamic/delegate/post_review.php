<!-- 
 - File: post_review.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Contains the logic flow to submit a new review
 -->

<?php 
	# enable sessions to persist
	session_start();

	# create a database connection
	include '../../query/database_connection.php';

	# insert a new review to the database, no need to sanitize data because you only live once
	include '../../query/insert_review.php';

	# display the submitted page to the user to provide feedback
	include '../submitted.php';
?>

