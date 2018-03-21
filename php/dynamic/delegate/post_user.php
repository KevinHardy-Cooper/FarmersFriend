<!-- 
 - File: post_user.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Contains the logic flow to create a new user
 -->

<?php 
	# enable sessions to persist
	session_start();

	# create a database connection
	include '../../query/database_connection.php';

	# validate the data submitted as a new user
	include '../validator/validate_user.php'; 
?>
