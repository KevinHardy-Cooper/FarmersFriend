<?php include 'database.php'; ?>
<?php 
	$content = $_POST['review_content'];
	$rating = $_POST['rating'];
	$farm = $_POST['farm'];
	$reviewer = 1; # this needs to change once we have valid user sessions

	$date = getdate();
	$dateWritten = $date['year'] . "-" . $date['mon'] . "-" . $date['mday'];

	$stmt = $pdo -> prepare("INSERT INTO Farms VALUES (null, :content, :dateWritten, :rating, :reviewer, :farm)");

	$stmt -> bindValue(':farm', $farm);
	$stmt -> bindValue(':content', $content);
	$stmt -> bindValue(':rating', $rating);
	$stmt -> bindValue(':reviewer', $reviewer);
	$stmt -> bindValue(':dateWritten', $dateWritten);
	$stmt -> execute();
	print_r($stmt);
?>
<?php include 'submitted_review.php';?>

