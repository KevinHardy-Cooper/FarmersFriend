<!-- Including common head elements -->
<?php include '../inc/head.inc' ?>

		<!-- Page description -->
		<meta name = "description" content = "Review a farm">

		<!-- Importing external stylesheets -->
		<link href="/stylesheets/global.css" type="text/css" rel="stylesheet"/>
		<link href="/stylesheets/review.css" type="text/css" rel="stylesheet"/>

<!-- Including common navbar elements -->
<?php $active = 'nope'; include '../inc/navbar.inc.php'; ?>

				<!-- Headline for the page -->
				<h1 class = "specific-padding">
					Review <?php echo $result[0]['name']; ?>.
				</h1>

				<!-- Form begins... -->
				<div class = "specific-padding large-text">

					<!-- TODO: Set action attribute to somewhere useful -->
					<form method = "post" action = "post_review.php">

						<!-- Description field, with maximium amount of characters set to 140 -->
						<div class = "input-spacing required">
							<label>
								Description:
								<textarea placeholder = "How was your experience?" name = "review_content" id = "review_content" maxlength = "140" required></textarea>
							</label>	
						</div>
						
						<!-- Choose image field -->
						<div class = "input-spacing required">
							<label>
								Rate the farm:
								<!-- Ratings field -->
								<select class = "large-field thick-border" name = "rating" required>
									<option value = ""> 
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
						</div>

						<div >
							<input name = "farm" value = <?php echo $result[0]['farmID']; ?> hidden>
						</div>

						<!-- Submit buttom field -->
						<div class = "input-spacing">
							<input class = "large-field" type = "submit" value = "Create">
						</div>
					</form>
				</div>
			</article>

			<picture>
				<img class = "animal animal-right" alt = "Image of a sheep" src = "/assets/img/vector-sheep.png">
			</picture>

		</main>

		<!-- Including common footer element -->
		<?php include '../inc/footer.inc' ?>
	</body>
</html>