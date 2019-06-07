<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body  id=index>
<center>  <a href="index.html" style="color:rgb(101, 101, 101);">&#8627; Zurück </a></center>
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


if($L1>1030){
  echo '<img src="sonne.png" alt="Beispiel" width="600" height="400" id="wetterimg2">';
  echo "Die Sonne scheint stark, Sonnencreme ist zu empfehlen!";
}
if($L1<1030 && $L1>1020){
  echo '<img src="normal.png" alt="Beispiel" width="600" height="400" id="wetterimg2">';
  echo "Sonne mit wenigen Wolken";
}
if($L1<1020 && $L1>=1000){
  echo '<img src="wolken.png" alt="Beispiel" width="600" height="400" id="wetterimg2">';
  echo "Bewölkt, vereinzelt mit Sonne";
}
if($L1<1000 && $L1>990){
  echo '<img src="regen.png" alt="Beispiel" width="600" height="400" id="wetterimg2">';
 echo "Bewölkt eventuell auch ";
 if($T1>0){
   echo "Regen und Wind";

 }else {
   echo "Schnee und Wind";
 }
}
if($L1<990){
  echo '<img src="sturmisch.png" alt="Beispiel" width="600" height="400" id="wetterimg2">';
  echo "Sehr stürmisch eventuell auch ";
  if($T1>0){
    echo "starker Regen";

  }else {
    echo "starker Schneefall";
  }
}

?>


</body>

  <img src="https://www.niederschlagsradar.de/image.ashx" alt="Wetterkarte" style="clip:rect(auto auto 493px auto); position:absolute;">
</body>
</html>
