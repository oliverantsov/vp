<?php
  require("usesession.php");
  require("../../../config.php");
  require("fnc_film.php");
  require ("header.php");
  
  $inputerror = "";
  $filmhtml = "";
  //kas vajutati salvestusnuppu
  if(isset($_POST["filmsubmit"])){
	  if(empty($_POST["titleinput"]) or empty($_POST["genreinput"]) or empty($_POST["studioinput"]) or empty($_POST["directorinput"])){
		  $inputerror .= "Osa infot on sisestamata! ";
	  }
	  if($_POST["yearinput"] < 1895 or $_POST["yearinput"] > date("Y")){
		  $inputerror .= "Ebareaalne valmimisaasta. ";
	  }
	  if(empty($inputerror)){
		  $storeinfo = storefilminfo($_POST["titleinput"], $_POST["yearinput"], $_POST["durationinput"], $_POST["genreinput"], $_POST["studioinput"], $_POST["directorinput"]);
		  if($storeinfo == 1){
			  $filmhtml = readfilms(1);
		  } else {
			  $filmhtml = "<p>Kahjuks filmiinfo salvestamine seekord ebaõnnestus! </p>";
			}
	  }
  
  
  
   }
  //loen andmebaasist filmide info
  //$filmhtml = readfilms();
?>
  <img src="../vp_pics/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <ul>
	<li><a href="home.php"> Tagasi kodulehele </a></li> <br>
	<li><a href="?logout=1">Logi välja</a>!</li> <br>
  </ul>
  <hr>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="titleinput">Filmi pealkiri</label>
	<input type="text" name="titleinput" id="titleinput" placeholder="Filmi pealkiri">
	<br>
	<label for="yearinput">Filmi valmimisaasta</label>
	<input type="number" name="yearinput" id="yearinput" value="<?php echo date("Y"); ?>">
	<br>
	<label for="durationinput">Filmi kestus minutites</label>
	<input type="number" name="durationinput" id="durationinput" value="90">
	<br>
	<label for="genreinput">Filmi žanr</label>
	<input type="text" name="genreinput" id="genreinput" placeholder="Filmi žanr">
	<br>
	<label for="studioinput">Filmi tootja</label>
	<input type="text" name="studioinput" id="studioinput" placeholder="Filmi tootja/stuudio">
	<br>
	<label for="directorinput">Filmi lavastaja</label>
	<input type="text" name="directorinput" id="directorinput" placeholder="Filmi lavastaja">
	<br>
	<input type="submit" name="filmsubmit" value="Salvesta filmi info">
  </form>
  <p><?php echo $inputerror; ?></p>
<hr>
  <p><?php echo $filmhtml; ?></p>