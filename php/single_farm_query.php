<?php

  $farmID = $_GET['farm'];

  $query = "SELECT Farms.farmID, Farms.name, Farms.latitude, Farms.longitude, Farms.description, Farms.imagePath, Farms.dateJoined, Reviews.content, Reviews.dateWritten, Reviews.rating, Users.name FROM Reviews inner join Farms ON Farms.farmID = Reviews.farm INNER JOIN Users ON Users.userID = Reviews.reviewer WHERE farmID = " . $farmID;
  
  $result = mysqli_query($mysqli, $query);

    $rows = [];
    while($row = mysqli_fetch_array($result)) {
      $rows[] = $row;
    }
    $json_row = json_encode($rows[0]);
  
  
  $mysqli->close();

?>