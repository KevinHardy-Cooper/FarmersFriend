<!-- Including common head elements -->
<?php include '../inc/head.inc' ?>

		<!-- Page description -->
		<meta name = "description" content = "Results of search for farms">

		<!-- Importing external stylesheet -->
		<link href="/stylesheets/global.css" type="text/css" rel="stylesheet"/>
		<link href="/stylesheets/results.css" type="text/css" rel="stylesheet"/>

		<!-- Embedded map -->
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin=""/>
		<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
	
<!-- Including common navbar elements -->
<?php $active = 'nope'; include '../inc/navbar.inc.php'; ?>

			<!-- Text providing feedback to the user about what page they are on and the state -->
			<div class = "specific-padding">
				<h3><?php 

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

			<!-- took this out because even when the content could fit in the width it still had a weird invisible scroll bar area -->
			<!-- <div class = "specific-padding scrollable-div"> -->
				<div class = "specific-padding">
				<!-- took this out because we can't send php variables to js to populate table -->
				<!-- <table class = "table" id = "resultsTable"> -->
					<table class = "table">
					<tr>
						<th>Farm Image</th>
						<th>Farm</th>
						<th>Date Joined</th>
						<th>Average Rating</th>
						<th>Write Review</th>
					</tr>
					<?php 
						foreach ($result as $row) {
							echo '<tr>';
							echo '<td><img class = \'results-image\' alt = \'User-uploaded image of their farm\' src=\'../' . $row['imagePath'] . '\'></td>';
							echo '<td><a href = ' . '../dynamic/individual_page.php?farm=' . $row['farmID'] . '>' . $row['name'] . '</a></td>';
							echo '<td>' . $row['dateJoined'] . '</td>';
							// this needs to be changed by making a better sql query
							if ($row['averageRating'] == null) {
								echo '<td>Not yet reviewed</td>';
							} else {
								echo '<td>' . $row['averageRating'] . ' stars</td>';
							}

							echo '<td><a href = \'review_page.php?farm=' . $row['farmID'] . '\'>Review</a></td>';
							echo '</tr>';
						}
					?>
				</table>	
			</div>	
			</article>	
		</main>					

		<!-- Including common footer element -->
		<?php include '../inc/footer.inc' ?>
		
		<!-- Importing external javascript here because the DOM must be loaded prior to importing -->
		<script src = "/js/results_sample.js"></script>
		<script>
			createMap(<?php echo $json_rows ?>);
		</script>
	</body>
</html>
 
