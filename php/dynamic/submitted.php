<!-- Including common head elements -->
<?php include '../inc/head.inc' ?>

		<!-- Page description -->
		<meta name = "description" content = "Review a farm">

		<!-- Importing external stylesheets -->
		<link href="/stylesheets/global.css" type="text/css" rel="stylesheet"/>
		<link href="/stylesheets/review.css" type="text/css" rel="stylesheet"/>
	</head>
	<body>
		<header>

			<!-- Navbar -->
			<nav>
				<ul>
					<li class = "justify-left">
						<a href = "/index.php">
							Farmer's Friend
						</a>
					</li>
					<li class = "justify-right">
						<a href = "/php/static/sign_in.php">
							Sign In
						</a>
					</li>
					<li class = "justify-right">
						<a href = "/php/static/registration.php">
							Sign Up
						</a>
					</li>
					<li class = "justify-right">
						<a href = "/php/static/submission.php">
							Register Farm
						</a>
					</li>
					<li class = "justify-right">
						<a href = "/php/static/search.php">
							Search
						</a>
					</li>
				</ul>
			</nav>
		</header>

		<!-- Skipping some lines for formatting -->
		<br>
		<br>

		<main>
			<article>

				<!-- Headline for the page -->
				<h1 class = "specific-padding">
					Thanks for submitting!
				</h1>


			<picture>
				<img class = "animal animal-right" alt = "Image of a sheep" src = "/assets/img/vector-sheep.png">
			</picture>

		</main>

		<!-- Including common footer element -->
		<?php include '../inc/footer.inc' ?>
	</body>
</html>