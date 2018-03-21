<?php
	$date = getdate();
	$dateJoined = $date['year'] . "-" . $date['mon'] . "-" . $date['mday'];

	$stmt = $pdo -> prepare("INSERT INTO Farms VALUES (0, :name, :latitude, :longitude, :description, :imagePath, :dateJoined)");

	$stmt -> bindValue(':name', $name);
	$stmt -> bindValue(':description', $description);
	$stmt -> bindValue(':latitude', $latitude);
	$stmt -> bindValue(':longitude', $longitude);
	$stmt -> bindValue(':imagePath', $imagePath);
	$stmt -> bindValue(':dateJoined', $dateJoined);
	$stmt -> execute();
?>