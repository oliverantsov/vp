<?php
  require("usesession.php");
  require ("header.php");
  require("../../../config.php");
  require("fnc_film.php");
  
  //loen andmebaasist filmide info
  //$filmhtml = readfilms();
?>
  <img src="../vp_pics/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <ul>
	<li><a href="home.php"> Tagasi kodulehele </a></li> <br>
	<li><a href="?logout=1">Logi välja</a>!</li> <br>
  </ul>
<hr>
  <?php //echo $filmhtml;
  echo readfilms(0) ?>