<?php
	$email = $_POST['sign-in-email'];
	$password = $_POST['sign-in-password'];

	$query = "SELECT * FROM Users WHERE email = '" . $email . "' AND password = '" . $password . "'";
	  
	$result = mysqli_query($mysqli, $query);

	$row = mysqli_fetch_array($result);

	if (!$row) {
		echo 'no';
	} else {
		echo 'yes';
		$newquery = "UPDATE Users SET isLoggedIn = 'true' WHERE userID = " . $row['userID'];
		mysqli_query($mysqli, $newquery);
		header( 'Location: ../index.php' );
	}
?>