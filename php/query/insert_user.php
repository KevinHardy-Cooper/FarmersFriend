<?php 
	$salt = bin2hex(random_bytes(20));
	$stmt = $pdo -> prepare("INSERT INTO Users VALUES (0, :name, :birthdate, :email, SHA2(CONCAT(:password, :salt), 0), :purpose, :isFarmer, :isLoggedIn, :salt)");

	$stmt -> bindValue(':name', $name);
	$stmt -> bindValue(':birthdate', $birthday);
	$stmt -> bindValue(':email', $email);
	$stmt -> bindValue(':password', $password);
	$stmt -> bindValue(':salt', $salt);
	$stmt -> bindValue(':purpose', $purpose);
	$stmt -> bindValue(':isFarmer', $user_is_farmer);
	$stmt -> bindValue(':isLoggedIn', 'false');

	$stmt -> execute();
?>