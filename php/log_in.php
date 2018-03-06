<?php include 'database.php'; ?>

<?php

$email = $_POST['sign-in-email'];
$password = $_POST['sign-in-password'];

echo $email;
echo $password;

$query = "SELECT * FROM Users WHERE email = '" . $email . "' AND password = '" . $password . "'";

echo $query;
  
$result = mysqli_query($mysqli, $query);

$row = mysqli_fetch_array($result);

echo $row;


?>