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

<head >

<title>Wetter</title>
<h1 id="titel">Wetter.pi</h1>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body id="index">
    <iframe id="gestern" class="framewetter" src="gestern.php"></iframe>
    <iframe id="heute" class="framewetter" src="heute.php"></iframe>
    <iframe id="instunde" class="framewetter" src="wetter.php"></iframe>

</body>

</html>
