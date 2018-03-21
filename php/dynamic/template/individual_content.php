<!-- 
 - File: individual_content.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Contains the page template for an individual farm.  Will populate dynamically based on passed-in farm ID
 -->

<!-- Including common head elements -->
<?php include '../../inc/head.inc' ?>

		<!-- Page description -->
		<meta name = "description" content = "Farm page with reviews"/>

		<!-- Importing external stylesheet -->
		<link href = "/stylesheets/global.css" type = "text/css" rel = "stylesheet"/>
		<link href = "/stylesheets/specificObject.css" type = "text/css" rel = "stylesheet"/>

		<!-- Embedded map -->
		<link rel = "stylesheet" href = "https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity = "sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin = ""/>
		<script src = "https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity = "sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin = ""></script>
	
<!-- Including common navbar elements -->
<?php $active = 'nope'; include '../../inc/navbar.inc.php'; ?>	

				<!-- Text containing farm info -->
				<div class = "specific-padding">

					<!-- Specific Object's name, via server -->
					<h3><?php echo $result[0]['farmName'];?></h3>

					<picture>

						<!-- Image of farm, image path served via server -->
						<!-- TODO: get image from s3 -->
						<?php 
							echo '<img class = "user-farm-image" alt = "User-uploaded image of farm" src = "../../'. $result[0]['imagePath'] . '"/>';
						?>
					</picture>

					<!-- Specific Object's description, via server -->
					<p><?php echo $result[0]['description']; ?></p>

					<!-- Specific Object's latitude and longitude, via server -->
					<div>
						<?php 
							echo $result[0]['latitude'] . ', ' . $result[0]['longitude']; 
						?> 
					</div>
					<br>
					<div><?php 

							# if average rating of farm is 0, that means no one has reviewed it yet
							if ($average_rating['averageRating'] == 0) {
								echo 'Not yet reviewed';
							} else {

								# otherwise, display average rating in stars
								echo $average_rating['averageRating'] . ' stars';
							}
						?>
					</div>
					<br>
					<br>
				</div>
			</article>	

			<!-- <div> that our map will be loaded into -->
			<div id="objectMap"></div>
		
			<article>

				<h3 class = "specific-padding">
					Reviews
				</h3>
				
				<!-- Table containing returned reviews and data about these reviews -->
				<div class = "specific-padding">
					<table class = "table">
						<tr>
							<th>Review</th>
							<th>Date</th>
							<th>Rating</th>
							<th>Reviewer</th>
						</tr>
						<?php 

							# first confirm that the farm has indeed not been reviewed yet
							if ($average_rating['averageRating'] != 0) {

								# if so, populate table per review
								foreach ($result as $review) {

									# open new row and fill with review content, date, rating, and reviewer
									echo '<tr><td>' . $review['content'] . '</td>';
									echo '<td>' . $review['dateWritten'] . '</td>';
									echo '<td>' . $review['rating'] . ' stars</td>';
									echo '<td>' . $review['userName'] . '</td></tr>';
								}
							} 

							# at the bottom of the table, provide user with the option to write a review
							echo '<tr><td><a href = \'../../dynamic/delegate/review_page.php?farm=' . $review['farmID'] . '\'>Review</a></td></tr>';
						?>
					</table>	
				</div>
			</article>
		</main>

		<!-- Including common footer element -->
		<?php include '../../inc/footer.inc' ?>
	
		<!-- Importing external javascript here because the DOM must be loaded prior to importing -->
		<script src = "/js/map.js"></script>
		<script>
				// calling the createMap method in map.js, giving it the farms it needs to populate the objectMap div
				createMap(<?php echo $json_farm_info ?>, 'objectMap');
		</script>
	</body>
</html>