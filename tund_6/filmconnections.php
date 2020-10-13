<?php

	session_start();
	require("../../../config.php");
	require("fnc_filmrelations.php");
  
	$notice = "";
	$selectedfilm = "";
	$selectedgenre = "";
	if(isset($_POST["filmrelationsubmit"])){
		//$selectedfilm = $_POST["filminput"];
		if(!empty($_POST["filminput"])){
			$selectedfilm = intval($_POST["filminput"]);
		} else {
			$notice = " Vali film!";
		}
		if(!empty($_POST["filmgenreinput"])){
			$selectedgenre = intval($_POST["filmgenreinput"]);
		} else {
			$notice .= " Vali žanr!";
		}
		if(!empty($selectedfilm) and !empty($selectedgenre)){
			$notice = storenewrelation($selectedfilm, $selectedgenre);
		}
	  }
  
	$filmselecthtml = readmovietoselect($selectedfilm);
	$filmgenreselecthtml = readgenretoselect($selectedgenre);
  
	require ("header.php");
?>
<!DOCTYPE html>
<html>
 <body>
	<img src="../vp_pics/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
	<ul>
	<li><a href="home.php"> Tagasi kodulehele </a></li> <br>
	<li><a href="?logout=1">Logi välja</a>!</li> <br>
	</ul>
  <hr>
	  <h1>Filmile žanri määramine:</h1>
	  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<?php
			echo $filmselecthtml;
			echo $filmgenreselecthtml;
		?>
		
		<input type="submit" name="filmrelationsubmit" value="Salvesta filmiinfo"><span><?php echo $notice; ?></span>
	  </form>
	<hr>
 </body>
</html>