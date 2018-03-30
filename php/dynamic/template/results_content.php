<!-- 
 - File: results_content.php 
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Contains the page template for a search of farms.  Will populate dynamically based on what the user searchs for
 -->

<!-- Including common head elements -->
<?php include '../../inc/head.inc' ?>

		<!-- Page description -->
		<meta name = "description" content = "Results of search for farms">

		<!-- Importing external stylesheet -->
		<link href="/stylesheets/global.css" type="text/css" rel="stylesheet"/>
		<link href="/stylesheets/results.css" type="text/css" rel="stylesheet"/>

		<!-- Embedded map -->
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin=""/>
		<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
	
<!-- Including common navbar elements -->
<?php $active = 'nope'; include '../../inc/navbar.inc.php'; ?>

			<!-- Text providing feedback to the user about what page they are on and the state of their search-->
				<div class = "specific-padding">
					<h3>
						<?php 

							# we can determine what the user searched and what they didn't search based on the default values of $name and $rating
							if ($name == "" && $rating == 0) {
								echo count($result) . ' result(s)';
							} else if ($name != "" && $rating == 0) {
								echo count($result) . ' result(s) for \'' . $name . '\'';
							} else if ($name == "" && $rating != 0) {
								echo count($result) . ' result(s) for ' . $rating . ' star(s)';
							} else {
								echo count($result) . ' result(s) for \'' . $name . '\', '  . $rating . ' star(s)';
							}
						?>		
					</h3>
				</div>

				<!-- <div> that our map will be loaded into -->
				<div id = "resultMap"></div>
				
				<!-- Table containing returned results and data about these results -->
				<div class = "specific-padding">
					<table class = "table">
						<tr>
							<th>Farm Image</th>
							<th>Farm</th>
							<th>Date Joined</th>
							<th>Average Rating</th>
							<th>Write Review</th>
						</tr>
						<?php

							# populate table per returned farm
							foreach ($result as $row) {

								# open new row and fill with farm image, name, date, average rating
								echo '<tr><td><img class = \'results-image\' alt = \'User-uploaded image of their farm\' src=\'' . $row['imagePath'] . '\'></td>';
								echo '<td><a href = ../../dynamic/delegate/individual_page.php?farm=' . $row['farmID'] . '>' . $row['name'] . '</a></td>';
								echo '<td>' . $row['dateJoined'] . '</td>';
								
								# if the farm has not been reviewed, then it's average rating will be null.  display appropriate message for this case or otherwise
								if ($row['averageRating'] == null) {
									echo '<td>Not yet reviewed</td>';
								} else {
									echo '<td>' . $row['averageRating'] . ' stars</td>';
								}

								# provide user with the option to write a review
								echo '<td><a href = \'../delegate/review_page.php?farm=' . $row['farmID'] . '\'>Review</a></td></tr>';
							}
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
			// calling the createMap method in map.js, giving it the farms it needs to populate the resultMap div
			createMap(<?php echo $json_rows ?>, 'resultMap', 2);
		</script>
	</body>
</html>
 
