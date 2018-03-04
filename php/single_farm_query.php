<?php

  $farmID = $_GET['farm'];

  $query = "SELECT * FROM Farms INNER JOIN Reviews ON Farms.farmID = Reviews.farm WHERE farmID = " . $farmID;
  
  $result = mysqli_query($mysqli, $query);

    $rows = [];
    while($row = mysqli_fetch_array($result)) {
      $rows[] = $row;
    }
    $json_row = json_encode($rows[0]);
  
  
  $mysqli->close();

?>