<html>
  <head>
      <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <h1 id="maintext">Gestern</h1>

<a>
<?php

$pdo = new PDO('mysql:host=localhost;dbname=haus', 'phpmyadmin', 'Raspiserve');
//Wert vor 1h
$sql = "SELECT * FROM temperatur_tb WHERE ID=(SELECT Max(ID) FROM temperatur_tb)-144;";
foreach ($pdo->query($sql) as $row) {
   //echo $row['id']." Temperatur:".$row['wert']." Luftdruck:".$row['luftdruck']." Luftfeuchtigkeit:".$row['luftfeuchtigkeit']."<br />";
   $L1 = $row['luftdruck'];
   $F1 = $row['luftfeuchtigkeit'];
   $T1 = $row['wert'];
}
//Neuster wert
$sql = "SELECT * FROM temperatur_tb WHERE ID=(SELECT Max(ID) FROM temperatur_tb)-69;";
foreach ($pdo->query($sql) as $row) {
  // echo $row['id']." Temperatur:".$row['wert']." Luftdruck:".$row['luftdruck']." Luftfeuchtigkeit:".$row['luftfeuchtigkeit']."<br />";
   $L2 = $row['luftdruck'];
   $F2 = $row['luftfeuchtigkeit'];
   $T2 = $row['wert'];
}

$sql = "SELECT * FROM temperatur_tb WHERE ID=(SELECT Max(ID) FROM temperatur_tb)-48;";
foreach ($pdo->query($sql) as $row) {
  // echo $row['id']." Temperatur:".$row['wert']." Luftdruck:".$row['luftdruck']." Luftfeuchtigkeit:".$row['luftfeuchtigkeit']."<br />";
   $L3 = $row['luftdruck'];
   $F3 = $row['luftfeuchtigkeit'];
   $T3 = $row['wert'];
}
$DR=($L1+$L2+$L3)/3;
$DT=($T1+$T2+$T3)/3;



//Wetter




//Starker Anstieg
if($DR>1030){
  echo '<img src="sonne.png" alt="Beispiel" width="400" height="200" id="wetterimg">';
  echo "Gestern war es sehr sonnig mit wenigen Wolken, ";

}
if($DR<1030 && $DR>1020){
  echo '<img src="normal.png" alt="Beispiel" width="400" height="200" id="wetterimg">';
  echo "Gestern war es ziemlich sonnig mit ein paar Wolken, ";

}
if($DR<1020 && $DR>=1000){
  echo '<img src="wolken.png" alt="Beispiel" width="400" height="200" id="wetterimg">';
  echo "Gestern war es ziemlich bewölkt mit vereinzelten Sonnenlöchern, ";
}
if($DR<1000 && $DR>990){
  echo '<img src="regen.png" alt="Beispiel" width="400" height="200" id="wetterimg">';
  echo "Gestern war es Bewölkt mit leichtem ";
  if($T2>0){
    echo "Regen, ";

  }else {
    echo "Schneefall, ";
  }
 }

if($DR<990 && $DR>970){
  echo '<img src="sturmisch.png" alt="Beispiel" width="400" height="200" id="wetterimg">';
  echo "Gestern war es  ";
  if($T2>0){
    echo "regnerisch und stürmisch, ";

  }else {
    echo "schneeig und stürmisch, ";
  }
 }

//Temperatur

echo "bei einer Durchschnittstemperatur von ";
echo round($DT);
echo " C°";
?>

</a>

</html>
