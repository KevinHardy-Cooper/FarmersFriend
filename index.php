<!-- 
 - File: index.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Contains the static landing page
 -->
<?php 
	# enable the session to persist
	session_start();

	# Including common head elements
	include 'php/inc/head.inc' 
?>

		<!-- Page description -->
		<meta name = "description" content = "Find and review farms"/>

		<!-- Importing external stylesheet -->
		<link href="stylesheets/global.css" type="text/css" rel="stylesheet"/>
		<link href="stylesheets/index.css" type="text/css" rel="stylesheet"/>

<!-- Including common navbar elements -->
<?php $active = 'index'; include 'php/inc/navbar.inc.php'; ?>

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
