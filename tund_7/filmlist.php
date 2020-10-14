<?php
   require ("header.php");
   require("../../../config.php");
   require("fnc_film.php");
   require("session_start.php");
   
   //loen lehele kõik olemasolevad mõtted
   $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
   $stmt = $conn->prepare("SELECT * FROM film");
   //$stmt = $conn->prepare("SELECT peakiri, aasta, kestus, zanr, tootja, lavastaja FROM film");
   
   echo $conn->error;
   //seome tulemuse muutujaga
   $stmt->bind_result($titlefromdb, $yearfromdb, $durationfromdb, $genrefromdb, $studiofromdb, $directorfromdb);
   $stmt->execute(); //kasu kaivitamine
   $filmhtml = "\t <ol> \n "; //
   while($stmt->fetch()){
	   $filmhtml .= "\t \t <li>" .$titlefromdb ." \n";
	   $filmhtml .= "\t \t \t <ul> \n";
	   $filmhtml .= "\t \t \t \t <li>Valmimisaasta: " .$yearfromdb ."</li> \n";
	   $filmhtml .= "\t \t \t \t <li>Kestus minutites: " .$durationfromdb ." minutit</li> \n";
	   $filmhtml .= "\t \t \t \t <li>Zanr : " .$genrefromdb ."</li> \n";
	   $filmhtml .= "\t \t \t \t <li>Tootja: " .$studiofromdb ."</li> \n";
	   $filmhtml .= "\t \t \t \t <li>Lavastaja: " .$directorfromdb ."</li> \n";
	   $filmhtml .= "\t \t \t </ul> \n";
	   $filmhtml .= "\t \t </li> \n";
   }
   $filmhtml .= "\t </ol> \n";
   
   $stmt->close();
   $conn->close();

?>
<!DOCTYPE html>
<html>
  <img src="../vp_pics/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <ul>
	<li><a href="home.php"> Tagasi kodulehele </a></li> <br>
	<li><a href="?logout=1">Logi välja</a>!</li> <br>
  </ul>
<hr>
  <h1>Filmi list:</h1>
  <hr>
  <?php echo $filmhtml; ?>
  <hr>

  