<?php
	session_start();
	unset($_SESSION['loggedIn']);
	unset($_SESSION['sessionId']);
?>
<h2> You are now logged out </h2>