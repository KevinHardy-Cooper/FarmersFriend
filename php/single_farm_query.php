<?php

  $farmID = $_GET['farm'];

  $query = "SELECT * FROM Farms INNER JOIN Reviews ON Farms.farmID = Reviews.farm WHERE farmID = " . $farmID;
  
  $result = mysqli_query($mysqli, $query);

  $row = mysqli_fetch_array($result);
   
  $json_row = json_encode($row);
  
  $mysqli->close();

?>