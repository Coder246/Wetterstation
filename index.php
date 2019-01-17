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
<meta http-equiv="Refresh" content="60">
<title>Wetter</title>
<h1 id="titel">Wetter.pi</h1>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<div id="text">
  <div id="daten">
    <?php
      echo "Temperatur:    ";
      echo $T1;
      echo " C°"
    ?>
    <div id="Luftdruckanzeige"><br><?php
      echo "Luftdruck:  ";
      echo $L1;
      echo "hpa";
      echo $hpaproStunde
    ?></br></div>

  </div>
  <div id="WB">
    <?php
      if($L1>1030){
        echo "sehr sonnig   (Viel Sonne kaum bewölgt)";
      }
      if($L1<1030 && $L1>1020){
        echo "Sonne    (Sonne)";
      }
      if($L1<1020 && $L1>=1000){
        echo "Normal  (Wolken mit Sonne)";
      }
      if($L1<1000 && $L1>990){
        echo "Regen   (Bewölkt und Regen)";
      }
      if($L1<990 && $L1>970){
        echo "Stürmisch (Wolken, Regen und Sturm)";
      }
	  if($L1<970 && $L1>100){
        echo "Stürmisch    (Wolken mit Regen und heftigem Sturm, Gewitter wahrscheinlich)";
      } 
    ?>
  </div>
        <iframe id="wetter_text" name="wetter"  src="wetter.php"></iframe>
</div>
</html>
