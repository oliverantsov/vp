<?php
  require ("header.php");
  require("../../../config.php");
  require("fnc_film.php");
  
  //loen andmebaasist filmide info
  //$filmhtml = readfilms();
?>
  <img src="../vp_pics/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <ul>
	<li><a href="home.php"> Tagasi kodulehele </a></li>  
  </ul>
<hr>
  <?php //echo $filmhtml;
  echo readfilms(0) ?>