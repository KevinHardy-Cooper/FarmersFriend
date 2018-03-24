<!-- 
 - File: update_session.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Executes a query on the database that updates the user's session with the current sessionID
 -->
<?php

	# create a prepared statement that will be used to update the user's session
	$stmt = $pdo -> prepare("UPDATE Users SET sessionID = :sessionID WHERE userID = :userID");

	# binding values to prevent SQL injection
	$stmt -> bindValue(':sessionID', $_SESSION['sessionID']);
	$stmt -> bindValue(':userID', $result[0]['userID']); # this result array is from selecting a user based on a session

	# execute query on database
	$stmt -> execute();
?>