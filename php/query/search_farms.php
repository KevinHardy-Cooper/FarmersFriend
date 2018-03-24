<!-- 
 - File: search_farms.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Executes a query on the database that searches for farms given certain parameters
 -->
<?php

  # receiving values from submitted form data
  $name = $_GET['name'];
  $rating = $_GET['rating'];

  # not a prepared statement yet, but will be soon...
  # this query is used to get all farms, and their average ratings
  $query = "SELECT * FROM Farms LEFT JOIN (SELECT farm, avg(rating) AS averageRating FROM reviews GROUP BY farm) AS averages ON farms.farmID = averages.farm";

  # if the user entered a name and a rating in their search
  if ($name != "" && $rating != 0) {

    # create a prepared statement with a where clause regarding name and averageRating
    $stmt = $pdo -> prepare($query . " WHERE name LIKE :name AND averageRating >= :rating ");

    # binding values to prevent SQL injection
    $stmt -> bindValue(':name', "%".$name."%"); 
    $stmt -> bindValue(':rating', $rating);

    # if the user entered only a rating to search by
  } elseif ($name == "" && $rating != 0) {

    # create a prepared statement with a where clause
    $stmt = $pdo -> prepare($query . " WHERE averageRating >= :rating ");

    # binding values to prevent SQL injection
    $stmt -> bindValue(':rating', $rating);

    # if the user entered only a name to search by
  } elseif ($name != "" && $rating == 0) {

    # create a prepared statement with a where clause
    $stmt = $pdo -> prepare($query . " WHERE name LIKE :name");

    # binding values to prevent SQL injection
    $stmt -> bindValue(':name', "%".$name."%");

    # if the user did not enter any values to search by
  } else {

    # create a prepared statement
    $stmt = $pdo -> prepare($query);
  } 

  # execute query on database
  $stmt -> execute();

  # get an array of the results
  $result = $stmt -> fetchAll();
  
  # convert this array to an array of JSONs
  $json_rows = json_encode($result);
?>