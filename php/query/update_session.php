<?php 
	$stmt = $pdo -> prepare("UPDATE Users SET sessionID = :sessionID WHERE userID = :userID");
	$stmt -> bindValue(':sessionID', $_SESSION['sessionID']);
	$stmt -> bindValue(':userID', $result[0]['userID']);
	$stmt -> execute();
?>