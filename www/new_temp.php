<?php
  $servername = "localhost";
  $username = "root";
  $password = "raspberry";
  $dbname = "weather_station";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Fetch temp
  $query_temp_inside = "SELECT value FROM `temp` WHERE sensor_id = 1 AND time = (SELECT MAX(time)from temp where sensor_id = 1)";
  $result_temp_inside = $conn->query($query_temp_inside);

  // All good?
  //temp
  if ( !$result_temp_inside ) {
    // Nope
    $message  = 'Invalid query: ' . $conn->error . "n";
    $message .= 'Whole query: ' . $query_temp_inside;
    die( $message );
  }

  header( 'Content-Type: application/json' );

  // temp
  $data_temp_value = array();
  while ( $row = mysqli_fetch_array($result_temp_inside) ) {
    $data_temp_value[] = $row["value"];
  }

  echo json_encode($data_temp_value);


  $conn->close();
?>
