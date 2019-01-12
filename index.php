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
    <br><?php
      echo "Luftdruck:  ";
      echo $L1;
      echo "hpa";
    ?></br>

  </div>
        <iframe id="wetter_text" name="wetter"  src="wetter.php"></iframe>
</div>
</html>
