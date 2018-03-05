<!-- Including common head elements -->
<?php include '../php/inc/head.inc' ?>

		<!-- Page description -->
		<meta name = "description" content = "Search for farms"/>

		<!-- Importing external stylesheet -->
		<link href="../stylesheets/global.css" type="text/css" rel="stylesheet"/>
		<link href="../stylesheets/search.css" type="text/css" rel="stylesheet"/>
	</head>
	<body>
		<header>

			<!-- Navbar -->
			<nav>
				<ul>
					<li class = "justify-left">
						<a href = "../index.php">
							Farmer's Friend
						</a>
					</li>
					<li class = "justify-right">
						<a href = "sign_in.php">
							Sign In
						</a>
					</li>
					<li class = "justify-right">
						<a href = "registration.php">
							Sign Up
						</a>
					</li>
					<li class = "justify-right">
						<a href = "submission.php">
							Register Farm
						</a>
					</li>
					<li class = "justify-right">

					<!-- When on this page, show tab as coloured -->
						<a class = "active" href = "search.php">
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
					Find an amazing farm.
				</h1>
				
				<!-- Skipping some lines for formatting -->
				<br>
				<br>
				<br>

				<!-- Search Form begins... -->
				<div class = "middle-div large-text">
					<form method = "get" action = "search_results.php">

						<!-- Name field -->
						<label>
							Search
							<input class = "large-field" type = "search" placeholder = "Names" name = "name" maxlength = "40" />
						</label>
						<label>
							or
						<!-- Ratings field -->
							<select class = "large-field thick-border" name = "rating">
								<option value = "0"> 
									Ratings 
								</option>
								<option value = "1"> 
									&#9734; 
								</option>
								<option value = "2"> 
									&#9734; &#9734; 
								</option>
								<option value = "3"> 
									&#9734; &#9734; &#9734; 
								</option>
								<option value = "4"> 
									&#9734; &#9734; &#9734; &#9734;
								</option>
								<option value = "5"> 
									&#9734; &#9734; &#9734; &#9734; &#9734; 
								</option>
							</select>
						</label>	
						
						<!-- Submit button field -->
						<button type = "submit" class = "large-field">
							<picture>
								<source srcset = "../assets/img/magnifying-glass.png">
								<img alt = "Search" class = "mag-glass" src = "../assets/img/magnifying-glass.png"/>
							</picture>
						</button>
					</form>
					<br>
					Don't know what you're looking for?
					<button type = "button" onclick = "getLocation()" class = "large-field">
						Find Farms Near You
					</button>
					
					<!-- will contain the status regarding the geolocation services -->
					<div id = "geoResults" class = "errorStatus"></div>

					<!-- will contain the spinner, if we need it -->
					<div id = "spinner" class = "spinner"></div>

				</div>
			</article>

			<picture>
				<img class = "animal" alt = "Image of a chicken" src = "../assets/img/vector-chicken.png"/>
			</picture>

		</main>
		
		<!-- Including common footer element -->
		<?php include '../php/inc/footer.inc' ?>

		<!-- Importing external javascript here because the DOM must be loaded prior to importing -->
		<script src = "../js/global.js"></script>
		<script src = "../js/search.js"></script>
	</body>
</html>