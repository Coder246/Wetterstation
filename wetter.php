

<?php
$pdo = new PDO('mysql:host=localhost;dbname=haus', 'phpmyadmin', 'Raspiserve');
//Wert vor 1h
$sql = "SELECT * FROM temperatur_tb WHERE ID=(SELECT Max(ID) FROM temperatur_tb);";
foreach ($pdo->query($sql) as $row) {
   //echo $row['id']." Temperatur:".$row['wert']." Luftdruck:".$row['luftdruck']." Luftfeuchtigkeit:".$row['luftfeuchtigkeit']."<br />";
   $L1 = $row['luftdruck'];
   $F1 = $row['luftfeuchtigkeit'];
   $T1 = $row['wert'];
}
//Neuster wert
$sql = "SELECT * FROM temperatur_tb WHERE ID=(SELECT Max(ID) FROM temperatur_tb)-6;";
foreach ($pdo->query($sql) as $row) {
  // echo $row['id']." Temperatur:".$row['wert']." Luftdruck:".$row['luftdruck']." Luftfeuchtigkeit:".$row['luftfeuchtigkeit']."<br />";
   $L2 = $row['luftdruck'];
   $F2 = $row['luftfeuchtigkeit'];
   $T2 = $row['wert'];
}

?>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

  <h1 id="maintext">In ein paar Stunden</h1>
<a>
<?php
//Wetter
$Wetter = $L1 - $L2;



//Starker Anstieg
 if ($Wetter > 1) {
   echo '<img src="sonne.png" alt="Beispiel" width="400" height="200" id="wetterimg">';
		echo "Kurzfristige, starke Wetterbesserung wahrscheinlich";
    goto a;
 }

  //Schwacher Anstieg

   if ($Wetter > 0.25) {
     echo '<img src="normal.png" alt="Beispiel" width="400" height="200" id="wetterimg">';
		echo "Besserung des Wetters in Aussicht";
    goto a;
 }

//Starker Abfall
 if ($Wetter < -1) {
   echo '<img src="sturmisch.png" alt="Beispiel" width="400" height="200" id="wetterimg">';
	echo "Hohe Wahrscheinlichkeit eines Unwetters";
  goto a;
}

 //Schwacher Abfall

  if ($Wetter < -0.25) {
    echo '<img src="regen.png" alt="Beispiel" width="400" height="200" id="wetterimg">';
	echo "Verschlechterung des Wetters in Aussicht";
}else{

  //Bild abfrage



     if($L1>1030){
       echo '<img src="sonne.png" alt="Beispiel" width="400" height="200" id="wetterimg">';

     }
     if($L1<1030 && $L1>1020){
       echo '<img src="normal.png" alt="Beispiel" width="400" height="200" id="wetterimg">';

     }
     if($L1<1020 && $L1>=1000){
       echo '<img src="wolken.png" alt="Beispiel" width="400" height="200" id="wetterimg">';

     }
     if($L1<1000 && $L1>990){
       echo '<img src="regen.png" alt="Beispiel" width="400" height="200" id="wetterimg">';

     }
     if($L1<990 && $L1>970){
       echo '<img src="sturmisch.png" alt="Beispiel" width="400" height="200" id="wetterimg">';

     }




     //Text ausgabe

   echo "Das Wetter ist beständig";


 }


a:

//Temperatur tendenz


$Temperaturverlauf = $T1 - $T2;

if ($Temperaturverlauf > 1){
  echo ", gleichzeitig ist die Temperatur am steigen.";
  goto b;
}



//Temperatur sinkt

if ($Temperaturverlauf < -1){
  echo ", dabei fällt die Temperatur.";

}else{

echo ", bei gleichbleibender Temperatur.";
}

b:





?>
</a>
</body>
</html>
