<!-- 
 - File: insert_review.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Executes a query on the database that inserts a new review
 -->
<?php 
	
	# first, we need to ge the userID of the signed in user
	require('select_user_based_on_session.php');

	# receiving values from submitted form data
	$content = $_POST['review_content'];
	$rating = $_POST['rating'];
	$farm = $_POST['farm'];

	# this result array is from the select_user_based_on_session query
	$reviewer = $result[0]['userID'];

	# get the current date
	$date = getdate();

	# create a string that will be used to display the date
	$dateWritten = $date['year'] . "-" . $date['mon'] . "-" . $date['mday'];

	# create a prepared statement that will be used to insert a new review
	$stmt = $pdo -> prepare("INSERT INTO Reviews VALUES (0, :content, :dateWritten, :rating, :reviewer, :farm)");

	# binding values for the farm to prevent SQL injection
	$stmt -> bindValue(':farm', $farm);
	$stmt -> bindValue(':content', $content);
	$stmt -> bindValue(':rating', $rating);
	$stmt -> bindValue(':reviewer', $reviewer);
	$stmt -> bindValue(':dateWritten', $dateWritten);

	# execute query on database
	$stmt -> execute();
?>