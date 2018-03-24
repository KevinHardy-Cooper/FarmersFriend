<!-- 
 - File: select_user.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Executes a query on the database that selects a user based on the email and the password
 -->
<?php 

	# don't forget, we need a database connection in oder to do anything with the database
	require('database_connection.php');

	# receiving values from submitted form data
	$email = $_POST['sign-in-email'];
	$password = $_POST['sign-in-password'];

	# create a prepared statement that will be used to select user based on email and encrypted password
	$stmt = $pdo -> prepare("SELECT * FROM Users WHERE email = :email AND password = SHA2(CONCAT(:password, salt), 0)");

	# binding values to prevent SQL injection
	$stmt -> bindValue(':email', $email);
	$stmt -> bindValue(':password', $password);

	# execute query on database
	$stmt -> execute();

	# get an array of the results
	$result = $stmt -> fetchAll();
	
	# if no users exist given the email and password then do
	if (sizeof($result) == 0) {

		# load the sign in page but include a little feedback to the user that they can't sign in using those credentials
		include '../static/sign_in.php';
		echo '<div class = \'errorStatus horiz-div\'>Invalid login credentials</div>';
	} else {

		# valid user login, so start the session
		session_start();

		# set session variables to represent if the user has been logged in
		$_SESSION['loggedIn'] = true;
		$_SESSION['sessionID'] = bin2hex(random_bytes(20));

		# update the user's sessionID with the current one
		include 'update_session.php';

		# direct the user to the landing page
		header( 'Location: ../../index.php' );
	}
?>