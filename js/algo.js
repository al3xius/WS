//Get Values
//Temp - Humi - Pres
var currentIndoor = ["22", "45", "985"]
var currentOutdoor = ["0", "35", "986"]

//Values of comfort
var highestTemp = 26
var lowestTemp = 17
var minAbsHumi = 0
var comfortTemp = ["18", "23"]
var comfortHumi = ["35", "55"]
var comfortAbsHumi = ["7", "11.8"]

var rg = 287.1;
var rd = 461.5;
var x = 0;
var term = 0;
var erg = 0;

changeWindowState();

//Calculate absolute Humidity
function absHumidity() {

  //Calculate abs. Humi
  x = rg/rd;
  term = (((currentOutdoor[1]/100) * (currentOutdoor[0]/800))) / ((currentOutdoor[2]/1000) - ((currentOutdoor[1]/100) * (currentOutdoor[0]/800)));
  erg = x * term;
  var finalValue = erg*1160;
  finalValue = Math.round(finalValue * 10) / 10;

  //Print result
  printResult("AUSSEN:  abs. Humi: " + finalValue + " | rel. Humi: " + currentOutdoor[1] + " | Temp: " + currentOutdoor[0]);

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
    //document.write(curAbsHumi);
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
//Ergebnis auf Website ausgeben
function printResult(value) {
  document.getElementById("values").innerHTML = value;
}
