<?php
  require("usesession.php");
  require("header.php");
  //var_dump($_POST);
  require("../../../config.php");
  require("fnc_common.php");
  require("fnc_user.php");
  $database = "if20_oliver_ant_1";
  $notice = "";
  $userdescription = ""; //edaspidi püüate andmebaasist lugeda, kui on, kasutate seda väärtust
  
  if(isset($_POST["profilesubmit"])){
	$description = test_input($_POST["descriptioninput"]);
	$result = storeuserprofile($description, $_POST["bgcolorinput"], $_POST["txtcolorinput"]);
	//sealt peaks tulema kas "ok" või mingi error!
	if($result == "ok"){
		$notice = "Kasutajaprofiil on salvestatud!";
		$_SESSION["userbgcolor"] = $_POST["bgcolorinput"];
		$_SESSION["usertxtcolor"] = $_POST["txtcolorinput"];
	} else {
		$notice = "Profiili salvestamine ebaõnnestus!";
	}
	
  }
  

?>

<img src="../vp_pics/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <ul>
	<li><a href="home.php"> Tagasi kodulehele </a></li> <br>
	<li><a href="?logout=1">Logi välja</a>!</li> <br>
  </ul>
<hr>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
	<label for="descriptioninput">Minu lühitutvustus</label>
	<br>
	<textarea name="descriptioninput" id="descriptioninput" rows="10" cols="80" placeholder="Minu tutvustus ..."><?php echo $userdescription; ?></textarea>
	<br>
	<label for="bgcolorinput">Minu valitud taustavärv:</label>
	<input type="color" name="bgcolorinput" id="bgcolorinput" value="<?php echo $_SESSION["userbgcolor"]; ?>">
	<br>
	<label for="txtcolorinput">Minu valitud tekstivärv:</label>
	<input type="color" name="txtcolorinput" id="txtcolorinput" value="<?php echo $_SESSION["usertxtcolor"]; ?>">
	<br>
	<input type="submit" name="profilesubmit" value="Salvesta profiil!">
	<span> <?php echo $notice; ?></span>
  </form>
<hr>
  