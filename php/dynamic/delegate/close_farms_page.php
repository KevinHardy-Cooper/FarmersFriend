<!-- 
 - File: close_farms_page.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Contains the logic flow to find farms that are close to the user and display them
 -->

<?php 
	# enable sessions to persist
	session_start();

	# create a database connection
	include '../../query/database_connection.php';

	# query the database for close farms
	include '../../query/select_close_farms.php';

	# populate returned farms in results page
	include '../template/results_content.php'; 
?>