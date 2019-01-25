

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

		echo "Kurzfristige, starke Wetteränderung wahrscheinlich ";
    goto a;
 }

  //Schwacher Anstieg

   if ($Wetter > 0.25) {

		echo "Besserung des Wetters in Aussicht ";
    goto a;
 }

//Starker Abfall
 if ($Wetter < -1) {

	echo "Hohe Wahrscheinlichkeit eines Unwetters ";
  goto a;
}

 //Schwacher Abfall

  if ($Wetter < -0.25) {

	echo "Verschlechterung des Wetters in Aussicht ";
}else{

   echo "Das Wetter ist beständig ";
 }


 //end luftdruck Abfrage

a:







?>
</a>
</body>
</html>
