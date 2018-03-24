<!-- 
 - File: navbar.inc.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Contains the logic for displaying the active tab in the navbar as well as the other tabs.  Also takes into account if the user is logged in or not
 -->
<?php 

	# enable sessions to persist
	session_start();

	# displaying the remaining elements of the head and starts the navbar elements
	echo '</head>
		<body>
			<header>
			<!-- Navbar -->
				<nav>
					<ul>';

	# the text to be displayed in the right-most navbar item
	$sign_in = "Sign In";

	# the link for the right-most navbar item
	$sign_in_url = "/php/static/sign_in.php";

	# check the session variable, if the user is logged in then do:
	if (isset($_SESSION['loggedIn'])) {

		# change the text to be displayed in the right-most navbar item to indicate that the user is logged in
		$sign_in = "Log Out";

		# when log out is clicked, the user will be logged out
		$sign_in_url = "/php/dynamic/delegate/log_out.php";
	}

	# if the user is on the landing page, set that navbar item to active
	if ($active == 'index') {
		displayNavItem("/index.php", "Farmer's Friend", "class = 'active'", "'justify-left'");
		displayNavItem($sign_in_url, $sign_in, "not_active", "'justify-right'");
		displayNavItem("/php/static/registration.php", "Sign Up", "not_active", "'justify-right'");
		displayNavItem("/php/dynamic/delegate/can_submit.php", "Register Farm", "not_active", "'justify-right'");
		displayNavItem("/php/static/search.php", "Search", "not_active", "'justify-right'");
	} elseif ($active == 'search') {

		# if the user is on the search page, set that navbar item to active
		displayNavItem("/index.php", "Farmer's Friend", "not_active", "'justify-left'");
		displayNavItem($sign_in_url, $sign_in, "not_active", "'justify-right'");
		displayNavItem("/php/static/registration.php", "Sign Up", "not_active", "'justify-right'");
		displayNavItem("/php/dynamic/delegate/can_submit.php", "Register Farm", "not_active", "'justify-right'");
		displayNavItem("/php/static/search.php", "Search", "class = 'active'", "'justify-right'");
	} elseif ($active == 'register') {

		# if the user is on the submission page, set that navbar item to active
		displayNavItem("/index.php", "Farmer's Friend", "not_active", "'justify-left'");
		displayNavItem($sign_in_url, $sign_in, "not_active", "'justify-right'");
		displayNavItem("/php/static/registration.php", "Sign Up", "not_active", "'justify-right'");
		displayNavItem("/php/dynamic/delegate/can_submit.php", "Register Farm", "class = 'active'", "'justify-right'");
		displayNavItem("/php/static/search.php", "Search", "not_active", "'justify-right'");
	} elseif ($active == 'sign_up') {

		# if the user is on the registration page, set that navbar item to active
		displayNavItem("/index.php", "Farmer's Friend", "not_active", "'justify-left'");
		displayNavItem($sign_in_url, $sign_in, "not_active", "'justify-right'");
		displayNavItem("/php/static/registration.php", "Sign Up", "class = 'active'", "'justify-right'");
		displayNavItem("/php/dynamic/delegate/can_submit.php", "Register Farm", "not_active", "'justify-right'");
		displayNavItem("/php/static/search.php", "Search", "not_active", "'justify-right'");
	} elseif ($active == 'sign_in') {

		# if the user is on the sign in page, set that navbar item to active
		displayNavItem("/index.php", "Farmer's Friend", "not_active", "'justify-left'");
		displayNavItem($sign_in_url, $sign_in, "class = 'active'", "'justify-right'");
		displayNavItem("/php/static/registration.php", "Sign Up", "not_active", "'justify-right'");
		displayNavItem("/php/dynamic/delegate/can_submit.php", "Register Farm", "not_active", "'justify-right'");
		displayNavItem("/php/static/search.php", "Search", "not_active", "'justify-right'");
	} else {

		# otherwise, no navbar items are active
		displayNavItem("/index.php", "Farmer's Friend", "not_active", "'justify-left'");
		displayNavItem($sign_in_url, $sign_in, "not_active", "'justify-right'");
		displayNavItem("/php/static/registration.php", "Sign Up", "not_active", "'justify-right'");
		displayNavItem("/php/dynamic/delegate/can_submit.php", "Register Farm", "not_active", "'justify-right'");
		displayNavItem("/php/static/search.php", "Search", "not_active", "'justify-right'");
	}

	# display the remaining tags to close the navbar, and also open some body elements
	echo '</ul>
			</nav>
			</header>

			<!-- Skipping some lines for formatting -->
			<br>
			<br>

			<main>
				<article>';


	# this method displays the navbar item given it's link, title, if it is active or not, and if it should be appended to the left or the right of the page
	function displayNavItem($link, $title, $active, $justify) {

		# set the justification of the navbar item
		echo '<li class = '. $justify . '>';

		# if the navbar item is to be set to active
		if ($active != "not_active") {
			echo '<a ' . $active . 'href = ' . $link . '>' . $title;
		} else {

			# if the navbar item is not to be set to active
			echo '<a href = ' . $link . '>' . $title;
		}

		# close the remaining navabr tags
		echo '</a></li>';
	}
?>