<!-- 
 - File: select_close_farms.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Executes a query on the database that searches for farms that are close to the user's location
 -->
<?php

	# receiving values from submitted form data
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];

	# create a prepared statement that will be used to search for close farms within a 30 km radius of the user
	# the following query uses the haversine function
	$stmt = $pdo -> prepare("SELECT farmID, name, latitude, longitude, imagePath, dateJoined, averageRating, 111.045* DEGREES(ACOS(COS(RADIANS(latpoint)) * COS(RADIANS(latitude)) * COS(RADIANS(longpoint) - RADIANS(longitude)) + SIN(RADIANS(latpoint)) * SIN(RADIANS(latitude)))) AS distance_in_km FROM Farms JOIN ( SELECT :latitude AS latpoint, :longitude AS longpoint ) AS p ON 1=1 LEFT JOIN (SELECT farm, avg(rating) AS averageRating FROM reviews GROUP BY farm) AS averages ON farms.farmID = averages.farm HAVING distance_in_km < 30 ORDER BY distance_in_km LIMIT 15");

	# binding values to prevent SQL injection
	$stmt -> bindValue(':latitude', $latitude);
	$stmt -> bindValue(':longitude', $longitude);
	
	# execute query on database
	$stmt -> execute();

	# get an array of the results
	$result = $stmt -> fetchAll();

	# convert this array to an array of JSONs
    $json_rows = json_encode($result);
?>