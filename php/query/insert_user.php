<?php 
	$stmt = $pdo -> prepare("INSERT INTO Users VALUES (0, :name, :birthdate, :email, :password, :purpose, :isFarmer, :isLoggedIn)");

	$stmt -> bindValue(':name', $name);
	$stmt -> bindValue(':birthdate', $birthday);
	$stmt -> bindValue(':email', $email);
	$stmt -> bindValue(':password', $password);
	$stmt -> bindValue(':purpose', $purpose);
	$stmt -> bindValue(':isFarmer', $user_is_farmer);
	$stmt -> bindValue(':isLoggedIn', 'false');

	$stmt -> execute();
?>