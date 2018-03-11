<!-- Including common head elements -->
<?php include '../inc/head.inc' ?>

		<!-- Page description -->
		<meta name = "description" content = "Farm page with reviews"/>

		<!-- Importing external stylesheet -->
		<link href = "/stylesheets/global.css" type = "text/css" rel = "stylesheet"/>
		<link href = "/stylesheets/specificObject.css" type = "text/css" rel = "stylesheet"/>

		<!-- Embedded map -->
		<link rel = "stylesheet" href = "https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity = "sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin = ""/>
		<script src = "https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity = "sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin = ""></script>
	
<!-- Including common navbar elements -->
<?php $active = 'nope'; include '../inc/navbar.inc.php'; ?>	

				<div class = "specific-padding">

					<!-- Specific Object's name -->
					<h3><?php echo $result[0]['farmName'];?></h3>

					<picture>

						<!-- Image of farm -->
						<?php 
							echo '<img class = "user-farm-image" alt = "User-uploaded image of farm" src = "../'. $result[0]['imagePath'] . '"/>';
						?>
					</picture>

					<!-- Specific Object's description -->
					<p><?php echo $result[0]['description']; ?></p>
					<div><?php echo $result[0]['latitude'] . ', ' . $result[0]['longitude']; ?> </div>
					<br>
					<div><?php 
							if ($average_rating['averageRating'] == 0) {
								echo 'Not yet reviewed';
							} else {
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
				<div class = "specific-padding scrollable-div">
						<table class = "table" id = "reviewTable">
							<tr>
								<th>Review</th>
								<th>Date</th>
								<th>Rating</th>
								<th>Reviewer</th>
							</tr>
							<?php 
								if ($average_rating['averageRating'] != 0) {
									foreach ($result as $row) {
										echo '<tr>';
										echo '<td>' . $row['content'] . '</td>';
										echo '<td>' . $row['dateWritten'] . '</td>';
										echo '<td>' . $row['rating'] . ' stars</td>';
										// this needs to be changed by making a better sql query
										echo '<td>' . $row['userName'] . '</td>';
										echo '</tr>';
									}
									echo '<tr><td><a href = \'../dynamic/review_page.php?farm=' . $row['farmID'] . '\'>Review</a></td></tr>';
								} else {
									echo '<tr><td><a href = \'../dynamic/review_page.php?farm=' . $result[0]['farmID'] . '\'>Review</a></td></tr>';	
								}
							?>
						</table>	
					</div>
			</article>
		</main>

		<!-- Including common footer element -->
		<?php include '../inc/footer.inc' ?>
	
	<!-- Importing external javascript here because the DOM must be loaded prior to importing -->
	<script src = "/js/individual_sample.js"></script>
	<script>
			createMap(<?php echo $json_farm_info ?>);
	</script>
	</body>
</html>