<?php
session_start();
  //logime välja
  if(isset($_GET["logout"])){
	  session_destroy();
	  header("Location: page.php");
	  exit();
  }
  
  //kas on sisse loginud, kui pole, siis saadame sisselogimise lehele.
  if(!isset($_SESSION["userid"])){
	  header("Location: page.php");
	  exit();
  }
?>