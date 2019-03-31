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

$sql = "SELECT * FROM temperatur_tb WHERE ID=(SELECT Max(ID)-6 FROM temperatur_tb);";
foreach ($pdo->query($sql) as $row) {
   //echo $row['id']." Temperatur:".$row['wert']." Luftdruck:".$row['luftdruck']." Luftfeuchtigkeit:".$row['luftfeuchtigkeit']."<br />";
   $Lvs = $row['luftdruck']; #Lvs = Luftdruck vor Stunde
   $F1 = $row['luftfeuchtigkeit'];
   $T2 = $row['wert'];
}

$hpaproStunde=$L1-$Lvs;

?>

<html>
<head>

<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<h1 id="maintext">Aktuell</h1>
  <div id="WB">
    <a>
    <?php
      if($L1>1030){
        echo '<img src="sonne.png" alt="Beispiel" width="400" height="200" id="wetterimg">';
        echo "Sehr viel Sonne fast unbewölkter Himmel";
      }
      if($L1<1030 && $L1>1020){
        echo '<img src="normal.png" alt="Beispiel" width="400" height="200" id="wetterimg">';
        echo "Sonne mit wenigen Wolken";
      }
      if($L1<1020 && $L1>=1000){
        echo '<img src="wolken.png" alt="Beispiel" width="400" height="200" id="wetterimg">';
        echo "Bewölkt, vereinzelt mit Sonne";
      }
      if($L1<1000 && $L1>990){
        echo '<img src="regen.png" alt="Beispiel" width="400" height="200" id="wetterimg">';
       echo "Bewölkt eventuell auch ";
       if($T1>0){
         echo "Regen und Wind";

       }else {
         echo "Schnee und Wind";
       }
      }
      if($L1<990){
        echo '<img src="sturmisch.png" alt="Beispiel" width="400" height="200" id="wetterimg">';
        echo "Sehr stürmisch eventuell auch ";
        if($T1>0){
          echo "starker Regen";

        }else {
          echo "starker Schneefall";
        }
      }



//Temperatur



        echo ", es sind aktuell ";
        echo $T1;
        echo " °C!";


    ?>


</a>
  </div>
  <a href="uebersicht.php" target="_parent" id="linkinheute">-Übersicht-</a>
</body >

</html>
