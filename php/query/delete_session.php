<!-- 
 - File: delete_session.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Executes a query on the database that rsets logged out user's session IDs to null
 -->
 <?php 

	# enable sessions to persist
	session_start();

	# create a prepared statement that will be update the user's sessionID to null
	$stmt = $pdo -> prepare("UPDATE Users SET sessionID = NULL WHERE sessionID = :sessionID");

	# binding values for the user to prevent SQL injection
	$stmt -> bindValue(':sessionID', $_SESSION['sessionID']);

	# execute query on database
	$stmt -> execute();
?>