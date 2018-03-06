<?php include 'database.php' ?>

<?php
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];

	$query = "SELECT farmID, name, latitude, longitude, imagePath, dateJoined, averageRating, 111.045* DEGREES(ACOS(COS(RADIANS(latpoint)) * COS(RADIANS(latitude)) * COS(RADIANS(longpoint) - RADIANS(longitude)) + SIN(RADIANS(latpoint)) * SIN(RADIANS(latitude)))) AS distance_in_km FROM Farms JOIN ( SELECT " . $latitude . " AS latpoint, " . $longitude . " AS longpoint ) AS p ON 1=1 INNER JOIN (Select farm, avg(rating) as averageRating from reviews group by farm) as averages on farms.farmID = averages.farm HAVING distance_in_km < 30 ORDER BY distance_in_km LIMIT 15";

	$result = mysqli_query($mysqli, $query);
    $rows = [];
    while($row = mysqli_fetch_array($result)) {
      $rows[] = $row;
    }
     $json_rows = json_encode($rows);
?>

<?php include 'results_content.php' ?>