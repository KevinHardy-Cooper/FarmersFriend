
<?php 
function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( '" . $output . "' );</script>";
}


  include 'database.php';

  $result = mysqli_query($mysqli, "SELECT * FROM Farms");
  $row = mysqli_fetch_array($result);
  if (!$row) {
  	echo 'error';

  } else {
  	echo $row;
  	echo $row['farmID'];
  }
  $mysqli->close();
?>
