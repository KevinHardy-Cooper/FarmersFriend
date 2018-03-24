<!-- 
 - File: select_farm_reviews.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Executes a query on the database that selects reviews for a farm
 -->
<?php

  # receiving values from url
  $farmID = $_GET['farm'];

  # First check if the farm has been reviewed yet

  # create a prepared statement that will be used to retrieve all reviews for a farm
  $stmt = $pdo -> prepare("SELECT * FROM Reviews WHERE farm = :farmID");

  # binding values to prevent SQL injection
  $stmt -> bindValue(':farmID', $farmID);

  # execute query on database
  $stmt -> execute();

  # get an array of the results
  $result = $stmt -> fetchAll();

  # if the farm has been reviewed then do
  if (sizeof($result) != 0) {

    # create a prepared statement that will be used to retrieve all reviews for a farm, linking together users and userIDs
    $stmt = $pdo -> prepare("SELECT Farms.farmID, Farms.name AS farmName, Farms.latitude, Farms.longitude, Farms.description, Farms.imagePath, Farms.dateJoined, Reviews.content, Reviews.dateWritten, Reviews.rating, Users.name AS userName FROM Reviews INNER JOIN Farms ON Farms.farmID = Reviews.farm INNER JOIN Users ON Users.userID = Reviews.reviewer WHERE farmID = :farmID");

    # binding values to prevent SQL injection
    $stmt -> bindValue(':farmID', $farmID);

    # execute query on database
    $stmt -> execute();

    # get an array of the results
    $result = $stmt -> fetchAll();

    # convert this array to an array of JSONs
    $json_farm_info = json_encode($result);

    # it was too difficult to try to figure how i could get the average rating for a farm as well for that double inner join above, so decided to make another query.  
    # create a prepared statement that will be used to get the average rating for a farm based on the reviews for that farm
    $average_stmt = $pdo -> prepare("SELECT AVG(rating) AS averageRating FROM Reviews WHERE farm = :farmID");

    # binding values to prevent SQL injection
    $average_stmt -> bindValue(':farmID', $farmID);

    # execute query on database
    $average_stmt -> execute();

    # get an array of the results
    $average_rating = $average_stmt -> fetchAll();

    # we just want the first item
    $average_rating = $average_rating[0];

    # if no one has reviewed the farm yet
  } else {

    # we just want to create a prepared statement to get certain farm fields for a single farm
    $stmt = $pdo -> prepare("SELECT Farms.farmID, Farms.name AS farmName, Farms.latitude, Farms.longitude, Farms.description, Farms.imagePath FROM Farms WHERE farmID = :farmID");

    # binding values to prevent SQL injection
    $stmt -> bindValue(':farmID', $farmID);

    # execute query on database
    $stmt -> execute();

    # get an array of the results
    $result = $stmt -> fetchAll();

    # convert this array to an array of JSONs
    $json_farm_info = json_encode($result);    

    # since no one has reviewed the farm yet, the average rating would be null, but we want it to be 0, which is better to work with in the future and is an impossible value otherwise
    $average_rating['averageRating'] = 0;
  }
?>