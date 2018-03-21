<!-- 
 - File: search_results.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Contains the logic flow to display the returned results fo the user's search
 -->

<?php 
	# enable sessions to persist
	session_start();

	# create a database connection
	include '../../query/database_connection.php';

	# query the database for applicable farms
	include '../../query/search_farms.php';

	# populate returned farms in results page
	include '../template/results_content.php'; 
?>

