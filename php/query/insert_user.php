<!-- 
 - File: insert_user.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Executes a query on the database that inserts a new user
 -->
<?php 
	
	# create the salt that we will be using to encrypt the user's password
	$salt = bin2hex(random_bytes(20));

	# create a prepared statement that will be used to insert a new user
	$stmt = $pdo -> prepare("INSERT INTO Users VALUES (0, :name, :birthdate, :email, SHA2(CONCAT(:password, :salt), 0), :purpose, :isFarmer, :salt, NULL)");

	# binding values for the user to prevent SQL injection
	$stmt -> bindValue(':name', $name);
	$stmt -> bindValue(':birthdate', $birthday);
	$stmt -> bindValue(':email', $email);
	$stmt -> bindValue(':password', $password);
	$stmt -> bindValue(':purpose', $purpose);
	$stmt -> bindValue(':isFarmer', $user_is_farmer);
	$stmt -> bindValue(':salt', $salt);

	# execute query on database
	$stmt -> execute();
?>