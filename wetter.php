
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

//Wetter
$Wetter = $L1 - $L2;



//Starker Anstieg
 if ($Wetter > 1) {

		echo "Kurzfristige, starke Wetteränderung wahrscheinlich und ";
    goto a;
 }

  //Schwacher Anstieg

   if ($Wetter > 0.25) {

		echo "Besserung des Wetters in Aussicht und ";
    goto a;
 }

//Starker Abfall
 if ($Wetter < -1) {

	echo "Hohe Wahrscheinlichkeit eines Unwetters und ";
  goto a;
}

 //Schwacher Abfall

  if ($Wetter < -0.25) {

	echo "Verschlechterung des Wetters in Aussicht und ";
}else{

   echo "Das Wetter ist beständig und ";
 }


 //end luftdruck Abfrage

a:
//

//Temperatur steigt

 $Temperaturverlauf = $T1 - $T2;

 if ($Temperaturverlauf > 1){
   echo "es wird wärmer, es sind aktuell ";
   echo $T1;
   echo " °C!";
   goto b;
 }



//Temperatur sinkt

 if ($Temperaturverlauf < -1){
   echo "es wird kälter, es sind aktuell ";
   echo $T1;
   echo " °C!";
 }else{

echo "bei einer konstaten Temperatur von ";
   echo $T1;
   echo " °C!";
 }

b:

echo " ------------------------";
 echo $Temperaturverlauf;
 echo " ------------------------ ";
 echo $Wetter


?>

<html>

</html>
