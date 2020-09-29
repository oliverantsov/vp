<?php
  require ("header.php");
  $firstname = "";
  $lastname = "";
  $gender = "";
  $email = "";
  
  $firstnameerror = "";
  $lastnameerror = "";
  $gendererror = "";
  $emailerror = "";
  $passworderror = "";
  $passwordsecondaryerror = "";

    if(isset($_POST["accountsubmit"])){
	  if(strlen($_POST["passwordinput"]) < 8){
		  $passworderror .= " Salasõna ei tohi olla väiksem kui 8 tähte! ";
	  }  
	  if(empty($_POST["firstnameinput"])){
		  $firstnameerror .= " Eesnimi on sisestamata! ";
	  } else {
		$firstname = ($_POST["firstnameinput"]);
	  }
	  if(empty($_POST["lastnameinput"])){
		  $lastnameerror .= " Perekonnanimi on sisestamata! ";
	  } else {
		$lastname = ($_POST["lastnameinput"]);
	  }
	  if(empty($_POST["genderinput"])){
		  $gendererror .= " Sugu on sisestamata! ";
	  } else {
		$gender = ($_POST["genderinput"]);
	  }
	  if(empty($_POST["emailinput"])){
		  $emailerror .= " Email on sisestamata! ";
	  } else {
		$email = ($_POST["emailinput"]);
	  }
	  if(($_POST["passwordinput"]) != ($_POST["passwordsecondaryinput"])) {
		$passwordsecondaryerror = " Paroolid ei klapi!";
	  }
	  
   }

?>
<img src="../vp_pics/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <ul>
	<li><a href="home.php"> Tagasi kodulehele </a></li>  
  </ul>
  <hr>
  <form method="POST">
    <label for="firstnameinput">Eesnimi:</label>
	<input type="text" name="firstnameinput" id="firstnameinput" placeholder="Eesnimi" value="<?php echo $firstname; ?>"> <?php echo "<span style='color:red;'> $firstnameerror </span>"; ?>
	<br>
	<label for="lastnameinput">Perekonnanimi:</label>
	<input type="text" name="lastnameinput" id="lastnameinput" placeholder="Perekonnanimi" value="<?php echo $lastname; ?>"> <?php echo "<span style='color:red;'> $lastnameerror </span>"; ?>
	<br>
	<label for="genderinput">Sugu:</label>
	<input type="radio" name="genderinput" id="gendermale" value="1"<label for="gendermale">Mees</label> <?php if($gender == "1"){echo " checked";}?> <?php echo "<span style='color:red;'> $gendererror </span>"; ?>
	<input type="radio" name="genderinput" id="genderfemale" value="2"<label for="genderfemale">Naine</label> <?php if($gender == "2"){echo " checked";}?> <?php echo "<span style='color:red;'> $gendererror </span>"; ?>
	<br>
	<label for="emailinput">E-posti aadress (kasutajatunnuseks):</label>
	<input type="email" name="emailinput" id="emailinput" placeholder="E-posti aadress" value="<?php echo $email; ?>"> <?php echo "<span style='color:red;'> $emailerror </span>"; ?>
	<br>
	<label for="passwordinput">Salasõna:</label>
	<input type="password" name="passwordinput" id="passwordinput" placeholder="Salasõna"> <span><?php echo "<span style='color:red;'> $passworderror </span>"; ?>
	<br>
	<label for="passwordsecondaryinput">Salasõna teist korda:</label>
	<input type="password" name="passwordsecondaryinput" id="passwordsecondaryinput" placeholder="Salasõna teist korda"> <?php echo "<span style='color:red;'> $passwordsecondaryerror </span>"; ?>
	<br>
	<input type="submit" name="accountsubmit" value="Salvesta kasutaja info">
  </form>
  <hr>