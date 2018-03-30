<!-- 
 - File: submission.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Contains the static page used for creating a new farm
 -->
 <?php 
	# enable the session to persist
	session_start();

	# Including common head elements
	include '../../inc/head.inc' 
?>
		<!-- Page description -->
		<meta name = "description" content = "Post farm to be searched for and reviewed">

		<!-- Importing external stylesheets -->
		<link href="/stylesheets/global.css" type="text/css" rel="stylesheet"/>
		<link href="/stylesheets/submission.css" type="text/css" rel="stylesheet"/>

<!-- Including common navbar elements -->
<?php $active = 'register'; include '../../inc/navbar.inc.php'; ?>

				<!-- Headline for the page -->
				<h1 class = "specific-padding">
					Register your farm.
				</h1>

				<!-- Form begins... -->
				<div class = "specific-padding large-text">

					<!-- First validate form field values on the client side, then post form to server -->
					<form method = "post"  onsubmit = "return validate(this)" action = "../delegate/post_farm.php" enctype = "multipart/form-data">

						<!-- Farm Name field -->
						<div class = "input-spacing required">
							<label>
								Farm Name:
								<input class = "large-field" type = "text" placeholder = "Kevin's Farm" name = "farm_name" id = "farm_name" maxlength = "40" required>
							</label>
						</div>
						<div id = "farm_name_status" class  = "errorStatus"></div>

						<!-- Description field, with maximium amount of characters set to 140 -->
						<div class = "input-spacing required">
							<label>
								Description:
								<textarea placeholder = "Why would people want to visit?" name = "farm_description" id = "farm_description" maxlength = "140" required></textarea>
							</label>	
						</div>
						<div id = "farm_descr_status" class  = "errorStatus"></div>

						<button type = "button" class = "large-field" onclick = "getLocation()">Set To My Location</button>

						<!-- will contain the status regarding the geolocation services -->
						<div id = "geoResults" class = "errorStatus"></div>

						<div class = "spinner" id = "spinner"></div>
						
						<!-- Latitude field -->
						<div class = "input-spacing required">
							<label>
								Latitude:
								<input class = "large-field" type = "number" step = "any" placeholder = "Enter latitude" name = "farm_latitude" id = "farm_latitude" maxlength = "40" required>
							</label>
						</div>
						<div id = "farm_lat_status" class  = "errorStatus"></div>

						<!-- Longitude field -->
						<div class = "input-spacing required">
							<label>
								Longitude:
								<input class = "large-field" type = "number" step = "any" placeholder = "Enter longitude" name = "farm_longitude" id = "farm_longitude" maxlength = "40" required>
							</label>	
						</div>
						<div id = "farm_lon_status" class  = "errorStatus"></div>
						
						<!-- Choose image field -->
						<div class = "input-spacing">
							<label>
								Select image to upload:
								<input class = "thick-border" type = "file" name = "farm_image">
							</label>
						</div>

						<!-- Submit buttom field -->
						<div class = "input-spacing">
							<input class = "large-field" type = "submit" value = "Create">
							<div id = "formStatus" class  = "errorStatus"></div>
						</div>
					</form>
				</div>
			</article>

			<picture>
				<img class = "animal animal-right" alt = "Image of a pig" src = "/assets/img/vector-pig.png">
			</picture>

		</main>

		<!-- Including common footer element -->
		<?php include '../../php/inc/footer.inc'; ?>

		<!-- Importing external javascript here because the DOM must be loaded prior to importing -->
		<script src = "/js/global.js"></script>
		<script src = "/js/submission.js"></script>
	</body>
</html>