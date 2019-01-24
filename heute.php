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
   $T1 = $row['wert'];
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
        echo "Sehr viel Sonne fast unbewölkter Himmel";
      }
      if($L1<1030 && $L1>1020){

        echo "Sonne mit wenigen Wolken";
      }
      if($L1<1020 && $L1>=1000){

        echo "Bewölkt, vereinzelt mit Sonne";
      }
      if($L1<1000 && $L1>990){
   echo "<html><body>Mein Text ist hier zu finden<br><a href=\"http://www.example.org\">der Link</a></body></html>;
        echo "Bewölkt eventuell auch Regen und Wind ";
      }
      if($L1<990 && $L1>970){

        echo "Sehr Stürmisch eventuell auch starker Regen";
      }
    ?>


</a>
  </div>
</body >

</html>
