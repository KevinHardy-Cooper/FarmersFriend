<?php

  $name = $_GET['name'];
  $rating = $_GET['rating'];

  $query = "SELECT farmID, name, latitude, longitude, imagePath, dateJoined, AVG(rating) as rating from Farms inner join reviews on Farms.farmID = reviews.farm";

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