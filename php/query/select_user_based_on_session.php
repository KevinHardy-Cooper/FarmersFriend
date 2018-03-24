<!-- 
 - File: select_user_based_on_session.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Executes a query on the database to validate that indeed the user is using a valid session
 -->
 <?php 

 	# create a prepared statement that will be used to select user based on sessionID
	$stmt = $pdo -> prepare("SELECT userID FROM Users WHERE sessionID = :sessionID");

	# binding values to prevent SQL injection	
	$stmt -> bindValue(':sessionID', $_SESSION['sessionID']);

	# execute query on database
	$stmt -> execute(); 

	# get an array of the results
	$result = $stmt -> fetchAll();
?>