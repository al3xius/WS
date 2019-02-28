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
  $queryt1 = "
    SELECT time,value as value1
    FROM temp
    where sensor_id = 1
    ORDER BY time ASC";
  $resultt1 = $conn->query( $queryt1 );
  $queryt2 = "
    SELECT time,value as value2
    FROM temp
    where sensor_id = 2
    ORDER BY time ASC";
  $resultt2 = $conn->query( $queryt2 );

  // Fetch pres
  $queryp1 = "
    SELECT time,value as pres_in
    FROM pres
    where sensor_id = 1
    ORDER BY time ASC";
  $resultp1 = $conn->query( $queryp1 );
  $queryp2 = "
    SELECT time,value as pres_out
    FROM pres
    where sensor_id = 2
    ORDER BY time ASC";
  $resultp2 = $conn->query( $queryp2 );

  // Fetch humi
  $queryh1 = "
    SELECT time,value as humi_in
    FROM humi
    where sensor_id = 1
    ORDER BY time ASC";
  $resulth1 = $conn->query( $queryh1 );
  $queryh2 = "
    SELECT time,value as humi_out
    FROM humi
    where sensor_id = 2
    ORDER BY time ASC";
  $resulth2 = $conn->query( $queryh2 );

  // All good?
  //temp
  if ( !$resultt1 ) {
    // Nope
    $message  = 'Invalid query: ' . $conn->error . "n";
    $message .= 'Whole query: ' . $queryt1;
    die( $message );
  }
  if ( !$resultt2 ) {
    // Nope
    $message  = 'Invalid query: ' . $conn->error . "n";
    $message .= 'Whole query: ' . $queryt2;
    die( $message );
  }
  //pres
  if ( !$resultp1 ) {
    // Nope
    $message  = 'Invalid query: ' . $conn->error . "n";
    $message .= 'Whole query: ' . $queryp1;
    die( $message );
  }
  if ( !$resultp2 ) {
    // Nope
    $message  = 'Invalid query: ' . $conn->error . "n";
    $message .= 'Whole query: ' . $queryp2;
    die( $message );
  }
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

  // temp
  $datat = array();
  $datat1 = array();
  $datat2 = array();
  while ( $row = $resultt1->fetch_assoc() ) {
    $datat1[] = $row;
  }
  while ( $row = $resultt2->fetch_assoc() ) {
    $datat2[] = $row;
  }

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

  $datat = array_merge($datat1, $datat2);
  echo /*"[" ,*/json_encode($datat)/*, ","*/;
/*
  // pres
  $datap = array();
  $datap1 = array();
  $datap2 = array();
  while ( $row = $resultp1->fetch_assoc() ) {
    $datap1[] = $row;
  }
  while ( $row = $resultp2->fetch_assoc() ) {
    $datap2[] = $row;
  }
  $datap = array_merge($datap1, $datap2);
  echo json_encode($datap), "," ;

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
  echo json_encode( $datah ) , "]";
*/
  $conn->close();
?>
