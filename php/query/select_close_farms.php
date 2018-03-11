<?php
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];

	$stmt = $pdo -> prepare("SELECT farmID, name, latitude, longitude, imagePath, dateJoined, averageRating, 111.045* DEGREES(ACOS(COS(RADIANS(latpoint)) * COS(RADIANS(latitude)) * COS(RADIANS(longpoint) - RADIANS(longitude)) + SIN(RADIANS(latpoint)) * SIN(RADIANS(latitude)))) AS distance_in_km FROM Farms JOIN ( SELECT :latitude AS latpoint, :longitude AS longpoint ) AS p ON 1=1 LEFT JOIN (SELECT farm, avg(rating) AS averageRating FROM reviews GROUP BY farm) AS averages ON farms.farmID = averages.farm HAVING distance_in_km < 30 ORDER BY distance_in_km LIMIT 15");

	$stmt -> bindValue(':latitude', $latitude);
	$stmt -> bindValue(':longitude', $longitude);
	$stmt -> execute();

	$result = $stmt -> fetchAll();

    $json_rows = json_encode($result);
?>