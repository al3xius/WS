<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/icon.ico">

    <title>SETTINGS - Wetterstation</title>

    <link href="css/1140.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/about.css" rel="stylesheet">
    <link href="css/settings.css" rel="stylesheet">
    <link href="css/button.css" rel="stylesheet">
    <style>
      h1, h2, h3, h4, h5, h6, p{
      font-family: "Calibri"
      }
    </style>
  </head>

  <body>

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
    ?>
    <!-- Header Menu -->
    <div class="header">
      <a id="logo">WETTERSTATION<a>

      <ul>
        <li><a href="index.php">Dashboard</a></li>
        <li><a id="current-item" href="settings.php">Settings</a></li>
        <li><a href="about.php">About</a></li>
      </ul>
    </div>

    <!-- Heading & Sub-Heading -->
    <div class="heading">
      <h1 style="font-size: 55px; font-weight: 700"> SETTINGS </h1>
      <p style="color: #2a2a2a; font-size: 20px; font-weight: 400">Einstellungen zur Verbesserung der Anzeige</p>
    </div>


    <div class="container12">
      <div class="row">
        <div class="column4">
          <h2>General Settings</h2>
          <h3>Input</h3>
          <p id="list-item">Sample Rate:
              <input type="text" name ="form" value="<?php
                        $sql = "SELECT value FROM settings where name = 'sample_rate' ";
                        $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                          // output data of each row
                          while($row = $result->fetch_assoc()) {
                              echo $row["value"];
                          }
                      } else {
                          echo "0 results";
                      }?>" size="8">s
              <button type="button" name="temp-button" onclick="
                <?php
                    $value = 5;
                    $sql = "Update settings set Value = '$value' where name = 'sample_rate' ";
                    $result = $conn->query($sql);
                ?>">Speichern</button>
          </p>
          <p id="list-item">Refresh Rate:
              <input type="text" name ="form" value="<?php
                        $sql = "SELECT value FROM settings where name = 'refresh_rate' ";
                        $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                          // output data of each row
                          while($row = $result->fetch_assoc()) {
                              echo $row["value"];
                          }
                      } else {
                          echo "0 results";
                      }?>" size="8">s
              <button type="button" name="temp-button" onclick="
                <?php
                    $value = 30;
                    $sql = "Update settings set Value = '$value' where name = 'refresh_rate' ";
                    $result = $conn->query($sql);
                ?>">Speichern</button>
          </p>
          <p id="list-item">Reset Database:
              <button type="button" name="reset-button" onclick="">Reset</button>
          </p>
        </div>

        <div class="column4">
          <h2>Information</h2>
          <h3>Raspberry</h3>
          <p id="list-item">IP-ADRESS: <span style="color: #3191E5">
          <?php
                $sql = "SELECT value FROM settings where name = 'ip_addr' ";
                $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                      echo "" . $row["value"]. "  <br>";
                  }
              } else {
                  echo "0 results";
              }?>
            </span> </p>


          <p id="list-item">SSID: <span style="color: #3191E5">
            <?php
            $sql = "SELECT value FROM settings where name = 'ssid'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "" . $row["value"]. "  <br>";
                }
            } else {
                echo "0 results";
            }
            ?>
            </span> </p>
          <h3>Arduino</h3>
          <p id="list-item">Bluetooth MAC: <span style="color: #3191E5"><?php
                $sql = "SELECT value FROM settings where name = 'bluetooth_addr' ";
                $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                      echo "" . $row["value"]. "  <br>";
                  }
              } else {
                  echo "0 results";
              }?></p></span> 
          <p id="list-item">Connected: <span style="color: #3191E5">
          <?php
                $sql = "SELECT value FROM settings where name = 'arduino_con' ";
                $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                      echo "" . $row["value"]. "  <br>";
                  }
              } else {
                  echo "0 results";
              }
              $conn->close();
              ?>
            </span> </p>
        </div>

        <div class="column4">
          <h2>Colors</h2>
        </div>
      </div>
    </div>



  </body>

<!-- Footer -->
  <footer>
    <div class="footer">
      <p>WETTERSTATION | 4BHET | Grundbirn</p>
      <p>v0.4 | 01/2018</p>
    </div>
  </footer>
</html>
