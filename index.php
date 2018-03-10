<!-- Including common head elements -->
<?php include 'php/inc/head.inc' ?>

		<!-- Page description -->
		<meta name = "description" content = "Find and review farms"/>

		<!-- Importing external stylesheet -->
		<link href="stylesheets/global.css" type="text/css" rel="stylesheet"/>
		<link href="stylesheets/index.css" type="text/css" rel="stylesheet"/>

	</head>
	<body>
		<header>

			<!-- Navbar -->
			<nav>
				<ul>
					<li class = "justify-left">

						<!-- When on this page, show tab as coloured -->
						<a class = "active" href = "index.php">
							Farmer's Friend
						</a>
					</li>
					<li class = "justify-right">
						<a href = "php/static/sign_in.php">
							Sign In
						</a>
					</li>
					<li class = "justify-right">
						<a href = "php/static/registration.php">
							Sign Up
						</a>
					</li>
					<li class = "justify-right">
						<a href = "php/static/submission.php">
							Register Farm
						</a>
					</li>
					<li class = "justify-right">
						<a href = "php/static/search.php">
							Search
						</a>
					</li>
				</ul>
			</nav>
		</header>

		<!-- Skipping some lines for formatting -->
		<br>
		<br>
		<br>

		<main>
			<article>

				<!-- Headline for the page -->
				<h1 class = "horiz-div">
					Find and review farms.
				</h1>
				
				<picture>

					<!-- Nice image of barn -->
					<img class = "middle-div barn-image" alt = "Image of a barn" src = "assets/img/vector-farm.png"/>
				</picture>
			</article>

		</main>
		
		<!-- Including common footer element -->
		<?php include 'php/inc/footer.inc' ?>

	</body>
</html>
