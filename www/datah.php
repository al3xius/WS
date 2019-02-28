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

  // Fetch humi
  $queryh1 = "
    SELECT time,value as value1
    FROM humi
    where sensor_id = 1
    ORDER BY time ASC";
  $resulth1 = $conn->query( $queryh1 );
  $queryh2 = "
    SELECT time,value as value2
    FROM humi
    where sensor_id = 2
    ORDER BY time ASC";
  $resulth2 = $conn->query( $queryh2 );

  // All good?
  //humi
  if ( !$resulth1 ) {
    // Nope
    $message  = 'Invalid query: ' . $conn->error . "n";
    $message .= 'Whole query: ' . $queryh1;
    die( $message );
  }
  if ( !$resulth2 ) {
    // Nope
    $message  = 'Invalid query: ' . $conn->error . "n";
    $message .= 'Whole query: ' . $queryh2;
    die( $message );
  }
  header( 'Content-Type: application/json' );

  // humi
  $datah = array();
  $datah1 = array();
  $datah2 = array();
  while ( $row = $resulth1->fetch_assoc() ) {
    $datah1[] = $row;
  }
  while ( $row = $resulth2->fetch_assoc() ) {
    $datah2[] = $row;
  }
  $datah = array_merge($datah1, $datah2);

  echo json_encode($datah);

  $conn->close();
?>
