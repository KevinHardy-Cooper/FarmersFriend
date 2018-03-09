<?php include 'database.php'; ?>

<?php
	$farm = $_GET['farm'];

	$stmt = $pdo -> prepare("SELECT farmID, name FROM Farms WHERE farmID = :farm");

	$stmt -> bindValue(':farm', $farm);
	$stmt -> execute();

	$result = $stmt -> fetchAll();
?>
<?php include 'review_content.php'; ?>