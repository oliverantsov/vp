<?php
  require("../../../config.php");
  require ("fnc_common.php");
  require ("fnc_user.php");
  $monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
  $firstname = "";
  $lastname = "";
  $gender = "";
  $birthday = null;
  $birthmonth = null;
  $birthyear = null;
  $birthdate = null;
  $email = "";
  $notice = "";
  
  $firstnameerror = "";
  $lastnameerror = "";
  $gendererror = "";
  $birthdayerror = null;
  $birthmontherror = null;
  $birthyearerror = null;
  $birthdateerror = null;
  $emailerror = "";
  $passworderror = "";
  $passwordsecondaryerror = "";

    if(isset($_POST["accountsubmit"])){
		
		
	  if (empty($_POST["passwordinput"])){
		$passworderror = "Palun sisesta salasõna!";
	  } else {
		  if(strlen($_POST["passwordinput"]) < 8){
			  $passworderror = "Liiga lühike salasõna (sisestasite ainult " .strlen($_POST["passwordinput"]) ." märki).";
		  }
	  }
	  if(empty($_POST["firstnameinput"])){
		  $firstnameerror .= " Eesnimi on sisestamata! ";
	  } else {
		$firstname = test_input($_POST["firstnameinput"]);
	  }
	  if(empty($_POST["lastnameinput"])){
		  $lastnameerror .= " Perekonnanimi on sisestamata! ";
	  } else {
		$lastname = test_input($_POST["lastnameinput"]);
	  }
	  if(empty($_POST["genderinput"])){
		  $gendererror .= " Sugu on sisestamata! ";
	  } else {
		$gender = intval($_POST["genderinput"]);
	  }
	  
	  if(isset($_POST["birthdayinput"])){
		  $birthday = intval($_POST["birthdayinput"]);
	  } else {
		  $birtherror = "Palun vali sünnikuupäev!";
	  }
	  if(isset($_POST["birthmonthinput"])){
		  $birthmonth = intval($_POST["birthmonthinput"]);
	  } else {
		  $birthmontherror = "Palun vali sünnikuu!";
	  }
	  if(isset($_POST["birthyearinput"])){
		  $birthyear = intval($_POST["birthyearinput"]);
	  } else {
		  $birthyearerror = "Palun vali sünniaasta!";
	  }
	  
	  if(empty($birthdayerror) and empty($birthmontherror) and empty($birthyearerror)){
		if(checkdate($birthmonth, $birthday, $birthyear)){
			$tempdate = new DateTime($birthyear ."-" .$birthmonth ."-" .$birthday);
			$birthdate = $tempdate->format("Y-m-d");
		} else {
			$birthdayerror = "Valitud kuupäev on ebareaalne!";
		}
	  
	  }
	  
	  if(empty($_POST["emailinput"])){
		  $emailerror .= " Email on sisestamata! ";
	  } else {
		$email = test_input($_POST["emailinput"]);
	  }
	  if(($_POST["passwordinput"]) != ($_POST["passwordsecondaryinput"])) {
		$passwordsecondaryerror = " Paroolid ei klapi!";
	  }
	  
   }

	  if(empty($firstnameerror) and empty($lastnameerror) and empty($gendererror) and empty($birthdayerror) and empty($birthmontherror) and empty($birthyearerror) and empty($birthdateerror) and empty($emailerror) and empty($passworderror) and empty($passwordsecondaryerror)){
		  //$notice = "Kõik korras!";
		  $result = signup($firstname, $lastname, $email, $gender, $birthdate, $_POST["passwordinput"]);
		  if($result == "ok"){
			  $notice = "Kasutaja on edukalt loodud!";
			  $firstname = "";
			  $lastname = "";
			  $gender = "";
			  $email = "";
		  } 
	  }
	  
  $username = "Oliver Antsov";
  require ("header.php");
?>
<img src="../vp_pics/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <ul>
	<li><a href="page.php"> Tagasi kodulehele </a></li>  
  </ul>
  <hr>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="firstnameinput">Eesnimi:</label>
	<input type="text" name="firstnameinput" id="firstnameinput" placeholder="Eesnimi" value="<?php echo $firstname; ?>"> <?php echo "<span style='color:red;'> $firstnameerror </span>"; ?>
	<br>
	<br>
	<label for="lastnameinput">Perekonnanimi:</label>
	<input type="text" name="lastnameinput" id="lastnameinput" placeholder="Perekonnanimi" value="<?php echo $lastname; ?>"> <?php echo "<span style='color:red;'> $lastnameerror </span>"; ?>
	<br>
	<br>
	<label for="genderinput">Sugu:</label>
	<input type="radio" name="genderinput" id="gendermale" value="1"<label for="gendermale">Mees</label> <?php if($gender == "1"){echo " checked";}?> <?php echo "<span style='color:red;'> $gendererror </span>"; ?>
	<input type="radio" name="genderinput" id="genderfemale" value="2"<label for="genderfemale">Naine</label> <?php if($gender == "2"){echo " checked";}?> <?php echo "<span style='color:red;'> $gendererror </span>"; ?>
	<br>
	<br>
	
	<label for="birthdayinput">Sünnipäev: </label>
		  <?php
			echo '<select name="birthdayinput" id="birthdayinput">' ."\n";
			echo '<option value="" selected disabled>päev</option>' ."\n";
			for ($i = 1; $i < 32; $i ++){
				echo '<option value="' .$i .'"';
				if ($i == $birthday){
					echo " selected ";
				}
				echo ">" .$i ."</option> \n";
			}
			echo "</select> \n";
		  ?>
	  <label for="birthmonthinput">Sünnikuu: </label>
	  <?php
	    echo '<select name="birthmonthinput" id="birthmonthinput">' ."\n";
		echo '<option value="" selected disabled>kuu</option>' ."\n";
		for ($i = 1; $i < 13; $i ++){
			echo '<option value="' .$i .'"';
			if ($i == $birthmonth){
				echo " selected ";
			}
			echo ">" .$monthnameset[$i - 1] ."</option> \n";
		}
		echo "</select> \n";
	  ?>
	  <label for="birthyearinput">Sünniaasta: </label>
	  <?php
	    echo '<select name="birthyearinput" id="birthyearinput">' ."\n";
		echo '<option value="" selected disabled>aasta</option>' ."\n";
		for ($i = date("Y") - 15; $i >= date("Y") - 110; $i --){
			echo '<option value="' .$i .'"';
			if ($i == $birthyear){
				echo " selected ";
			}
			echo ">" .$i ."</option> \n";
		}
		echo "</select> \n";
	  ?>
	  <br>
	  <span><?php echo $birthdateerror ." " .$birthdayerror ." " .$birthmontherror ." " .$birthyearerror; ?></span>
	  <br>
	  <br>
	  
	<label for="emailinput">E-posti aadress (kasutajatunnuseks):</label>
	<input type="email" name="emailinput" id="emailinput" placeholder="E-posti aadress" value="<?php echo $email; ?>"> <?php echo "<span style='color:red;'> $emailerror </span>"; ?>
	<br>
	<br>
	<label for="passwordinput">Salasõna:</label>
	<input type="password" name="passwordinput" id="passwordinput" placeholder="Salasõna"> <span><?php echo "<span style='color:red;'> $passworderror </span>"; ?>
	<br>
	<br>
	<label for="passwordsecondaryinput">Salasõna teist korda:</label>
	<input type="password" name="passwordsecondaryinput" id="passwordsecondaryinput" placeholder="Salasõna teist korda"> <?php echo "<span style='color:red;'> $passwordsecondaryerror </span>"; ?>
	<br>
	<br>
	<input type="submit" name="accountsubmit" value="Salvesta kasutaja info"><span><?php echo "&nbsp; &nbsp; &nbsp;" .$notice; ?></span>
  </form>
  <hr>