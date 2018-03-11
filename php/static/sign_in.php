<!-- Including common head elements -->
<?php include '../inc/head.inc' ?>

		<!-- Page description -->
		<meta name = "description" content = "Sign into your account to review farms, and post farms"/>

		<!-- Importing external stylesheet -->
		<link href = "/stylesheets/global.css" type="text/css" rel="stylesheet"/>
		<link href = "/stylesheets/sign_in.css" type="text/css" rel="stylesheet"/>

<!-- Including common navbar elements -->
<?php $active = 'sign_in'; include '../inc/navbar.inc.php'; ?>

				<!-- Headline for the page -->
				<h1 class = "horiz-div">
					Sign in.
				</h1>

				<!-- Skipping some lines for formatting -->
				<br>
				<br>
				<br>
				
				<!-- Search Form begins... -->
				<div class = "middle-div large-text">

					<!-- After successful login, email / username will be displayed where "Sign In" is in the navbar -->
					<form method = "post" action = "/php/query/select_user.php">

						<!-- Email field -->
						<label>
							Email:
							<input class = "large-field" type = "email" placeholder = "user@farm.com" name = "sign-in-email" maxlength = "40" required/>
						</label>

						<br>
						
						<!-- Password field -->
						<label>
							Password:			
							<input class = "large-field" type = "password" placeholder = "***********" name = "sign-in-password" maxlength = "40" required/>
						</label>	
						
						<br>
						
						<!-- Submit button field -->
						<input class = "large-field" type = "submit" value = "Sign In"/>
					</form>
				</div>		
			</article>

			<picture>
				<img class = "animal" alt = "Image of a horse" src = "/assets/img/vector-horse.png"/>
			</picture>

		</main>

		<!-- Including common footer element -->
		<?php include '../../php/inc/footer.inc'; ?>
		
	</body>
</html>
