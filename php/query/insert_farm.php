<!-- 
 - File: insert_farm.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Executes a query on the database that inserts a new farm
 -->
<?php
	
	# get the current date
	$date = getdate();

	# create a string that will be used to display the date
	$dateJoined = $date['year'] . "-" . $date['mon'] . "-" . $date['mday'];

	# create a prepared statement that will be used to insert a new farm
	$stmt = $pdo -> prepare("INSERT INTO Farms VALUES (0, :name, :latitude, :longitude, :description, :imagePath, :dateJoined)");

	# binding values for the farm to prevent SQL injection
	$stmt -> bindValue(':name', $name);
	$stmt -> bindValue(':description', $description);
	$stmt -> bindValue(':latitude', $latitude);
	$stmt -> bindValue(':longitude', $longitude);
	$stmt -> bindValue(':imagePath', $imagePath);
	$stmt -> bindValue(':dateJoined', $dateJoined);

	# execute query on database
	$stmt -> execute();
?>