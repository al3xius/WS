<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="//www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="//www.amcharts.com/lib/3/serial.js"></script>
    <script src="//www.amcharts.com/lib/3/themes/light.js"></script>
    <script src="http://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js" type="text/javascript"></script>


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

    <!-- DRAW GRAPH -->
    <script>
      var data_url = "data.php"
      //Chart
      var chart = AmCharts.makeChart( "chartdiv", {
        "type": "serial",
        "theme": "light",
        "zoomOutButton": {
          "backgroundColor": '#000000',
          "backgroundAlpha": 0.15
        },
        "dataLoader": {
        "url": "data.php",
        "format": "json"
        },
        "categoryField": "time",
        "categoryAxis": {
          "parseDates": true,
          "minPeriod": "ss",
          "dashLength": 1,
          "gridAlpha": 0.15,
          "axisColor": "#DADADA"
        },
        "graphs": [ {
          "id": "g1",
          "valueField": "value1",
          "bullet": "round",
          "bulletBorderColor": "#FFFFFF",
          "bulletBorderThickness": 2,
          "lineThickness": 2,
          "lineColor": "#b5030d",
          "negativeLineColor": "#0352b5",
          "hideBulletsCount": 50
        },
        {
          "id": "g2",
          "valueField": "value2",
          "bullet": "round",
          "bulletBorderColor": "#FFFFFF",
          "bulletBorderThickness": 2,
          "lineThickness": 2,
          "lineColor": "#00FF00",
          "negativeLineColor": "#00FF00",
          "hideBulletsCount": 50
        } ],
        "chartCursor": {
          "cursorPosition": "mouse"
        },
        "chartScrollbar": {
          "graph": "g1",
          "scrollbarHeight": 40,
          "usePeriod": "10mm",
          "color": "#FFFFFF",
          "autoGridCount": true
        },
        "valueAxes": [{
          "title": "Temperatur",
          "maximum": 100,
          "minimum": -15
        }],

        "periodSelector": {
          "position": "bottom",
          "periods": [{
            "period": "DD",
            "count": 10,
            "label": "10 days"
          }, {
            "period": "MM",
            "selected": true,
            "count": 1,
            "label": "1 month"
          }, {
            "period": "YYYY",
            "count": 1,
            "label": "1 year"
          }, {
            "period": "YTD",
            "label": "YTD"
          }, {
            "period": "MAX",
            "label": "MAX"
          }]},

        "legend": {
          "markerType": "line",
          "fontSize": 16,
          "data": [{title: "Innen", color: "#b5030d"},{title: "Außen", color: "#00FF00"}]
        }
      })

      function setDataSet(dataset_url) {
        data_url = dataset_url;
        updateData();
      }

      //clock
      function clock(){
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('curr_time').innerHTML =
        h + ":" + m + ":" + s;
        var t = setTimeout(clock, 500);
      }
      function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
      }


      //display
      function updateData() {
        var temp_in =
          <?php
            $sql = "SELECT value FROM `temp` WHERE sensor_id = 1 AND time = (SELECT MAX(time)from temp where sensor_id = 1)";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo round($row["value"], 2);
                }
            } else {
                echo 0;
            }?>;
        var temp_out =
          <?php
          $sql = "SELECT value FROM `temp` WHERE sensor_id = 2 AND time = (SELECT MAX(time)from temp where sensor_id = 2)";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                  echo round($row["value"], 2);
              }
          } else {
              echo 0;
          }?>;
        var humi_in =
          <?php
           $sql = "SELECT value FROM `humi` WHERE sensor_id = 1 AND time = (SELECT MAX(time)from humi where sensor_id = 1)";
           $result = $conn->query($sql);
           if ($result->num_rows > 0) {
               // output data of each row
               while($row = $result->fetch_assoc()) {
                   echo round($row["value"], 2);
               }
           } else {
               echo 0;
           }?>;
        var humi_out =
          <?php
           $sql = "SELECT value FROM `humi` WHERE sensor_id = 2 AND time = (SELECT MAX(time)from humi where sensor_id = 2)";
           $result = $conn->query($sql);
           if ($result->num_rows > 0) {
               // output data of each row
               while($row = $result->fetch_assoc()) {
                   echo round($row["value"], 2);
               }
           } else {
               echo 0;
           }?>;
        var pres_in =
          <?php
            $sql = "SELECT value FROM `pres` WHERE sensor_id = 1 AND time = (SELECT MAX(time)from pres where sensor_id = 1)";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo round($row["value"], 2);
                }
            } else {
                echo 0;
            }
            ?>;
        document.getElementById('temp_in').innerHTML = temp_in + "°C";
        document.getElementById('temp_out').innerHTML = temp_out + "°C";
        document.getElementById('humi_in').innerHTML = humi_in + "%";
        document.getElementById('humi_out').innerHTML = humi_out + "%";
        document.getElementById('pres_in').innerHTML = pres_in + "hPa";
        
        if (data_url == "datah.php") {
          chart.valueAxes.minimum = 0;
          chart.valueAxes.maximum = 105;
          chart.valueAxes.title = "Luftfeuchtigkeit";
        }
        else {
            chart.valueAxes.minimum = 0;
            chart.valueAxes.maximum = 105;
            chart.valueAxes.title = "Luftfeuchtigkeit";
        }
        AmCharts.loadFile(data_url, {}, function(data) {
        chart.dataProvider = AmCharts.parseJSON(data);
        chart.validateNow(true);})
        empfehlung(temp_in, humi_in, pres_in, temp_out, humi_out);
      }
      setInterval(updateData, 10000);
      
      //Lüftempfehlung
      function empfehlung(tempIn, humiIn, pres, tempOut, humiOut) {

      //Get Values
        //Temp - Humi - Pres
        var currentIndoor = [tempIn, humiIn, pres];
        var currentOutdoor = [tempOut, humiOut, pres];

        //Values of comfort
        var highestTemp = 26;
        var lowestTemp = 17;
        var minAbsHumi = 0;
        var comfortTemp = ["18", "23"];
        var comfortHumi = ["35", "55"];
        var comfortAbsHumi = ["7", "11.8"];

        var rg = 287.1;
        var rd = 461.5;
        var x = 0;
        var term = 0;
        var erg = 0;

        changeWindowState();
        closeWindow();
        //Calculate absolute Humidity
        function absHumidity() {

          //Calculate abs. Humi
          x = rg/rd;
          term = (((currentOutdoor[1]/100) * (currentOutdoor[0]/800))) / ((currentOutdoor[2]/1000) - ((currentOutdoor[1]/100) * (currentOutdoor[0]/800)));
          erg = x * term;
          var finalValue = erg*1160;
          finalValue = Math.round(finalValue * 10) / 10;

          //Print result
          //printResult("AUSSEN:  abs. Humi: " + finalValue + " | rel. Humi: " + currentOutdoor[1] + " | Temp: " + currentOutdoor[0]);

          //Return value
          return finalValue;
        }

        function lowExchangeCurve(x) {
          var curveValue;
          var xValue = x;

          var stp1 = (20-xValue)/0.178;
          var sqrValue = Math.sqrt(stp1);
          curveValue = 14.8 - sqrValue;
          return curveValue;
        }

        //Lüften oder nicht
        function changeWindowState() {

          var absHumi = absHumidity();

          //Temp. Grenzen: Oben 26 Grad; Unten 17 Grad
          if (currentOutdoor[0] >= lowestTemp && currentOutdoor[0] <= highestTemp) {
            //Abs. Humi Grenzen oben und unten
            if (absHumi >= comfortAbsHumi[0] && absHumi <= comfortAbsHumi[1]) {
              openWindow("Außenluft ist im Komfortbereich");
            }
            else if (absHumi > minAbsHumi && absHumi < comfortAbsHumi[1]) {
              openWindow("Außentemp. im Komfortbereich; Abs. Feuchtigkeit kleiner Komfort Luftfeuchtigkeit.");
            }
            else {
              closeWindow();
            }
          }
          else {
            closeWindow();
          }

          //Temp unter 17 Grad
          if (currentOutdoor[0] < lowestTemp && currentOutdoor[0] >= -10) {
            var curAbsHumi = lowExchangeCurve(currentOutdoor[0]);
            document.write(curAbsHumi);
            if (absHumi > 0 && absHumi < curAbsHumi) {
              openWindow("Abs. Luftfeuchtigkeit in Ordnung!");
            }
          }
        }


        //Print values on Test Page
        //Function: Fenster schließen
        function closeWindow() {
          document.getElementById("algo").innerHTML = "Fenster geschlossen halten!";
        }
        //Function: Fenster öffnen
        function openWindow(value) {
          document.getElementById("algo").innerHTML = "Fenster öffnen! " + value;
        }
        //Ausgeben eines Texts auf der Website
        function printValue(value) {
          document.getElementById("algo").innerHTML = value;
        }
      }
    </script>

    <link rel="icon" href="images/icon.ico">

    <title>DASHBOARD - Wetterstation</title>

    <link href="css/1140.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/graph.css" rel="stylesheet">
    <link href="css/button.css" rel="stylesheet">
    <link href="css/about.css" rel="stylesheet">
    <style>
      h1, h2, h3, h4, h5, h6, p{
        font-family: "Calibri"
      }
      #temp-button, #moist-button, #press-button{
        background-color: #2a2a2a;
        border: none;
        border-radius: 7px;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-family: "Calibri";
        font-weight: 500;
        font-size: 20px;
      }
      .footer{
        position: static;
      }
      .output{
        position: static;
      }
      .output1{
        position: static;
      }
    </style>
  </head>

  <body onload="clock(); updateData();">
    <!-- Header Menu -->
    <div class="header">
      <a id="logo">WETTERSTATION<a>

      <ul>
        <li><a id="current-item" href="index.php">Dashboard</a></li>
        <li><a href="settings.php">Settings</a></li>
        <li><a href="about.php">About</a></li>
      </ul>
    </div>
    <!-- Heading & Sub-Heading -->
    <div class="heading">
      <h1 style="font-size: 55px; font-weight: 700"> DASHBOARD</h1>
      <p style="color: #2a2a2a; font-size: 20px; font-weight: 400">Dunst, Heschl, Muhri, Schalk und Zechmeister</p>
    </div>

    <div class="container12">
      <div class="row">
        <!-- TEXT-ANZEIGE -->
        <div class="column6">
          <div class="output">
            <p id="time-text"><span id="curr_time" style="color: #3191E5">--:--</span> Uhr</p>
            <h3 style="color: #3191E5; font-size: 25px;"><u>Innen</u></h3>
            <p id="output-text">Temperatur: <span id="temp_in" style="color: #3191E5; font-weight: 700; font-size: 45px"></span></p>
            <p id="output-text">Luftfeuchtigkeit: <span id="humi_in" style="color: #3191E5; font-weight: 700; font-size: 45px"></span> </p>
            <p id="output-text">Luftdruck: <span id="pres_in" style="color: #3191E5; font-weight: 700; font-size: 45px"></span></p>

            <h3 style="color: #3191E5; font-size: 25px;"><u>Außen</u></h3>
            <p id="output-text">Temperatur: <span id="temp_out" style="color: #3191E5; font-weight: 700; font-size: 45px"></span> </p>
            <p id="output-text">Luftfeuchtigkeit: <span id="humi_out" style="color: #3191E5; font-weight: 700; font-size: 45px"></span> </p>
            <p id="output-text"><span id="algo" style="color: #3191E5; font-weight: 700; font-size: 45px"></span> </p>
          </div>
        </div>
        <!-- GRAPH -->
        <div class="column6">
          <!-- Graph -->
          <div id="chartdiv" style="width:100%; height:500px;"></div>
          <p class="selector">
            <select onchange="setDataSet(this.options[this.selectedIndex].value);">
            <option value="data.php">Temperatur</option>
            <option value="datah.php">Luftfeuchtigkeit</option>
          </select>
          </p>
          <div class="buttons">
            <!--
            <button type="button" id="temp-button" onclick="selectDataset(0);">Temp</button>
            <button type="button" id="moist-button" onclick="selectDataset(2)">Feuchtigk.</button>
            <button type="button" id="press-button" onclick="selectDataset(1)">Druck</button>
            -->
          </div>
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
    <?php
    $conn->close();
    ?>
  </footer>
</html>
