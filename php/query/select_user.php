<?php include 'database_connection.php'; ?>
<?php
	$email = $_POST['sign-in-email'];
	$password = $_POST['sign-in-password'];

	$stmt = $pdo -> prepare("SELECT * FROM Users WHERE email = :email AND password = SHA2(CONCAT(:password, salt), 0)");
	$stmt -> bindValue(':email', $email);
	$stmt -> bindValue(':password', $password);
	$stmt -> execute();
	$result = $stmt -> fetchAll();
	
	if (sizeof($result) == 0) {
		include '../static/sign_in.php';
		echo '<div class = \'errorStatus horiz-div\'>Invalid login credentials</div>';
	} else {

		session_start();
		$_SESSION['loggedIn'] = true;
		$_SESSION['sessionID'] = bin2hex(random_bytes(20));
		include 'update_session.php';
		header( 'Location: ../../index.php' );
	}
?>