<!-- 
 - File: select_farm.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Executes a query on the database that retrieves a single farm
 -->
<?php

	# receiving values from url
	$farm = $_GET['farm'];

	# create a prepared statement that will be used to select a farm
	$stmt = $pdo -> prepare("SELECT farmID, name FROM Farms WHERE farmID = :farm");

	# binding values to prevent SQL injection
	$stmt -> bindValue(':farm', $farm);

	# execute query on database
	$stmt -> execute();

	# get an array of the results
	$result = $stmt -> fetchAll();
?>