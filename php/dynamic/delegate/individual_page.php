<!-- 
 - File: individual_page.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Contains the logic flow that retrieves and populates page for individual object
 -->

<?php 
	# enable sessions to persist
	session_start();

	# create a database connection
	include '../../query/database_connection.php';

	# query the database for individual farm info and reviews
	include '../../query/select_farm_reviews.php';

	# populate returned farm info and reviews on page
	include '../template/individual_content.php'; 
?>