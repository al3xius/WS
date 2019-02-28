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

$sql = "SELECT id, sensor_id, value FROM temp";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. "  Sensor_ID: " . $row["sensor_id"].  "  Value:" . $row["value"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
