<?php

  $name = $_GET['name'];
  $rating = $_GET['rating'];

  $query = "SELECT * FROM Farms LEFT JOIN (SELECT farm, avg(rating) AS averageRating FROM reviews GROUP BY farm) AS averages ON farms.farmID = averages.farm";

  if ($name != "" && $rating != 0) {
    $stmt = $pdo -> prepare($query . " WHERE name LIKE :name AND averageRating >= :rating ");
    $stmt -> bindValue(':name', "%".$name."%"); 
    $stmt -> bindValue(':rating', $rating);
  } elseif ($name == "" && $rating != 0) {
    $stmt = $pdo -> prepare($query . " WHERE averageRating >= :rating ");
    $stmt -> bindValue(':rating', $rating);
  } elseif ($name != "" && $rating == 0) {
    $stmt = $pdo -> prepare($query . " WHERE name LIKE :name");
    $stmt -> bindValue(':name', "%".$name."%");
  } else {
    $stmt = $pdo -> prepare($query);
  } 

  $stmt -> execute();

  $result = $stmt -> fetchAll();
  
  $json_rows = json_encode($result);
?>