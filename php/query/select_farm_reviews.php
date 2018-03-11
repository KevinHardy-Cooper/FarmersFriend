<?php

  $farmID = $_GET['farm'];

  # First check if the farm has been reviewed yet
  $stmt = $pdo -> prepare("SELECT * FROM Reviews WHERE farm = :farmID");
  $stmt -> bindValue(':farmID', $farmID);
  $stmt -> execute();
  $result = $stmt -> fetchAll();

  if (sizeof($result) != 0) {
    $stmt = $pdo -> prepare("SELECT Farms.farmID, Farms.name AS farmName, Farms.latitude, Farms.longitude, Farms.description, Farms.imagePath, Farms.dateJoined, Reviews.content, Reviews.dateWritten, Reviews.rating, Users.name AS userName FROM Reviews INNER JOIN Farms ON Farms.farmID = Reviews.farm INNER JOIN Users ON Users.userID = Reviews.reviewer WHERE farmID = :farmID");
    $stmt -> bindValue(':farmID', $farmID);
    $stmt -> execute();
    $result = $stmt -> fetchAll();
    $json_farm_info = json_encode($result);

    $average_stmt = $pdo -> prepare("SELECT AVG(rating) AS averageRating FROM Reviews WHERE farm = :farmID");
    $average_stmt -> bindValue(':farmID', $farmID);
    $average_stmt -> execute();
    $average_rating = $average_stmt -> fetchAll();
    $average_rating = $average_rating[0];
  } else {
    $stmt = $pdo -> prepare("SELECT Farms.farmID, Farms.name AS farmName, Farms.latitude, Farms.longitude, Farms.description, Farms.imagePath FROM Farms WHERE farmID = :farmID");
    $stmt -> bindValue(':farmID', $farmID);
    $stmt -> execute();
    $result = $stmt -> fetchAll();
    $json_farm_info = json_encode($result);    
    $average_rating['averageRating'] = 0;
  }
?>