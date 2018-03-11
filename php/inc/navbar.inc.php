<?php 

echo '</head>
	<body>
		<header>
		<!-- Navbar -->
			<nav>
				<ul>';

if ($active == 'index') {
	displayNavItem("/index.php", "Farmer's Friend", "class = 'active'", "'justify-left'");
	displayNavItem("/php/static/sign_in.php", "Sign In", "not_active", "'justify-right'");
	displayNavItem("/php/static/registration.php", "Sign Up", "not_active", "'justify-right'");
	displayNavItem("/php/static/submission.php", "Register Farm", "not_active", "'justify-right'");
	displayNavItem("/php/static/search.php", "Search", "not_active", "'justify-right'");

} elseif ($active == 'search') {
	displayNavItem("/index.php", "Farmer's Friend", "not_active", "'justify-left'");
	displayNavItem("/php/static/sign_in.php", "Sign In", "not_active", "'justify-right'");
	displayNavItem("/php/static/registration.php", "Sign Up", "not_active", "'justify-right'");
	displayNavItem("/php/static/submission.php", "Register Farm", "not_active", "'justify-right'");
	displayNavItem("/php/static/search.php", "Search", "class = 'active'", "'justify-right'");
} elseif ($active == 'register') {
	displayNavItem("/index.php", "Farmer's Friend", "not_active", "'justify-left'");
	displayNavItem("/php/static/sign_in.php", "Sign In", "not_active", "'justify-right'");
	displayNavItem("/php/static/registration.php", "Sign Up", "not_active", "'justify-right'");
	displayNavItem("/php/static/submission.php", "Register Farm", "class = 'active'", "'justify-right'");
	displayNavItem("/php/static/search.php", "Search", "not_active", "'justify-right'");
} elseif ($active == 'sign_up') {
	displayNavItem("/index.php", "Farmer's Friend", "not_active", "'justify-left'");
	displayNavItem("/php/static/sign_in.php", "Sign In", "not_active", "'justify-right'");
	displayNavItem("/php/static/registration.php", "Sign Up", "class = 'active'", "'justify-right'");
	displayNavItem("/php/static/submission.php", "Register Farm", "not_active", "'justify-right'");
	displayNavItem("/php/static/search.php", "Search", "not_active", "'justify-right'");
} elseif ($active == 'sign_in') {
	displayNavItem("/index.php", "Farmer's Friend", "not_active", "'justify-left'");
	displayNavItem("/php/static/sign_in.php", "Sign In", "class = 'active'", "'justify-right'");
	displayNavItem("/php/static/registration.php", "Sign Up", "not_active", "'justify-right'");
	displayNavItem("/php/static/submission.php", "Register Farm", "not_active", "'justify-right'");
	displayNavItem("/php/static/search.php", "Search", "not_active", "'justify-right'");
} else {
	displayNavItem("/index.php", "Farmer's Friend", "not_active", "'justify-left'");
	displayNavItem("/php/static/sign_in.php", "Sign In", "not_active", "'justify-right'");
	displayNavItem("/php/static/registration.php", "Sign Up", "not_active", "'justify-right'");
	displayNavItem("/php/static/submission.php", "Register Farm", "not_active", "'justify-right'");
	displayNavItem("/php/static/search.php", "Search", "not_active", "'justify-right'");
}

echo '</ul>
		</nav>
		</header>

		<!-- Skipping some lines for formatting -->
		<br>
		<br>

		<main>
			<article>';

function displayNavItem($link, $title, $active, $justify){
	echo '<li class = '. $justify . '>';
	if ($active != "not_active") {
		echo '<a ' . $active . 'href = ' . $link . '>' . $title;
	} else {
		echo '<a href = ' . $link . '>' . $title;
	}
	echo '</a></li>';
}

?>