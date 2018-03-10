<?php

  $name = $_GET['name'];
  $rating = $_GET['rating'];

  $query = "select * from farms inner join (select farm, avg(rating) as averageRating from reviews group by farm) as averages on farms.farmID = averages.farm";

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