<?php

  $name = $_GET['name'];
  $rating = $_GET['rating'];

  $query = "SELECT * FROM Farms INNER JOIN Reviews ON Farms.farmID = Reviews.farm";

  if ($name == "" && $rating == 0) {

  } elseif ($name == "" && $rating != 0) {
    $query = $query . " WHERE Reviews.rating = " . $rating;
  } elseif ($name != "" && $rating == 0) {
    $query = $query . " WHERE Farms.name LIKE '%" . $name . "%'";
  } else {
    $query = $query . " LIKE '%" . $name . "%' AND Reviews.rating = " . $rating;
  }
  
  $result = mysqli_query($mysqli, $query);

    $rows = [];
    while($row = mysqli_fetch_array($result)) {
      $rows[] = $row;
    }
    $json_rows = json_encode($rows);
  
  $mysqli->close();

?>