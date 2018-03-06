<?php

  $name = $_GET['name'];
  $rating = $_GET['rating'];

  $query = "select * from farms inner join (select farm, avg(rating) as averageRating from reviews group by farm) as averages on farms.farmID = averages.farm";

  if ($name == "" && $rating == 0) {

  } elseif ($name == "" && $rating != 0) {
    $query = $query . " WHERE averageRating >= " . $rating;
  } elseif ($name != "" && $rating == 0) {
    $query = $query . " WHERE name LIKE '%" . $name . "%'";
  } else {
    $query = $query . " WHERE name LIKE '%" . $name . "%' AND averageRating >= " . $rating;
  }
  
  $result = mysqli_query($mysqli, $query);

    $rows = [];
    while($row = mysqli_fetch_array($result)) {
      $rows[] = $row;
    }
    $json_rows = json_encode($rows);
  
  $mysqli->close();

?>