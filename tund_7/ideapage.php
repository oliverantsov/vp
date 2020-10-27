<?php
  require("usesession.php");
  require ("header.php");
//var_dump($_POST);
  require("../../../config.php");
  $database = "if20_oliver_ant_1";
  if(isset($_POST["ideasubmit"]) and !empty($_POST["ideainput"])){
	  ##loome andmebaasiga ühenduse	
	  $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
	  ##valmistan ette SQL käsu andmete kirjutamiseks
	  $stmt = $conn->prepare("INSERT INTO myideas (idea) VALUES(?)");
	  echo $conn->error;
	  //i - integer, d - decimal, s - string
	  $stmt->bind_param("s", $_POST["ideainput"]);
	  $stmt->execute();
	  $stmt->close();
	  $conn->close();
  }
  
  //loen andmebaasist senised mõtted
  $ideahtml = "";
  $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
  $stmt = $conn->prepare("SELECT idea FROM myideas");
  //seon tulemuse muutujaga
  $stmt->bind_result($ideafromdb);
  $stmt->execute();
  while ($stmt->fetch()){
	  $ideahtml .= "<p>" .$ideafromdb ."</p>";
  }
  $stmt->close();
  $conn->close();
?>

<img src="../vp_pics/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
<h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <ul>
	<li><a href="home.php"> Tagasi kodulehele </a></li> <br>
	<li><a href="?logout=1">Logi välja</a>!</li> <br>
  </ul>
<hr>
  <form method="POST"> 
	<label>Kirjutage oma esimene pähe tulev mõte!</label>
	<input type="text" name="ideainput" placeholder="mõttekoht">
	<input type="submit" name="ideasubmit" value="Saada mõte teele!">
  </form>
<hr>
  