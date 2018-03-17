<?php 
	echo 'here';
	$stmt = $pdo -> prepare("SELECT userID FROM Users WHERE sessionID = :sessionID");

	$stmt -> bindValue(':sessionID', $_SESSION['sessionID']);
	$stmt -> execute(); 
	$result = $stmt -> fetchAll();
?>