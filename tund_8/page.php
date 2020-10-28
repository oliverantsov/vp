<?php
  session_start();
  require("../../../config.php");
  require ("fnc_user.php");
  require ("fnc_common.php");
  //var_dump($_POST);
  $result = "";
  $username = "";
  $email = "";
  $notice = "";
  $password = "";
  $emailerror = "";
  $passworderror = "";
  $datenow = date("d.");
  $yearnow = date("Y");
  $clocknow = date("H:i:s");
  $hournow = date("H");
  $partofday = "lihtsalt aeg";
  
  $weekdaynameset = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
  $monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
  $weekdaynow = date("N");
  $monthnow = date("n");
  
  if ($hournow > 23 or $hournow <= 7);{
	$partofday = "uneaeg";
  }
  if ($hournow >= 7 and $hournow <= 8);{
	$partofday = "hommikusöögiaeg";
  }
  if ($hournow > 8 and $hournow < 17);{
	$partofday = "akadeemilise aktiivsuse aeg";  
  }
  if ($hournow >= 17 and $hournow < 18);{
	$partofday = "õhtusöögiaeg";
  }
  if ($hournow >= 18 and $hournow < 23);{
	$partofday = "vaba aeg";
  }	
  
  //vaatame semestri kulgemist
  $semesterstart = new DateTime("2020-8-31");
  $semesterend = new DateTime("2020-12-13");
  //selgitame välja nende vahe ehk erinevuse
  $semesterduration = $semesterstart->diff($semesterend);
  //leiame selle päevade arvuna
  $semesterdurationdays = $semesterduration->format("%r%a");
  
  //tänane päev
  $today = new DateTime("now");
  $semestercurrent = $semesterstart->diff($today);
  $semestercurrentdays = $semestercurrent->format("%r%a");
  ##if ($semestercurrentdays < 0);{
	  ##$semestercurrentdays = "Antud semester pole veel alanud!";
	##}
  ##if ($semestercurrentdays > $semesterdurationdays);{
	  ##$semestercurrentdays = "Antud semester on juba lõppenud!";
	##}

## if($fromsemesterstartdays < 0) (semester pole peale hakanud) 
## leiame erinevuse tänasega (semesterduration jne)
  
  
##loeme kataloogist piltide nimekirja
  $allfiles = scandir("../img/");
  //var_dump($allfiles);
  $picfiles = array_slice($allfiles, 2);
  //var_dump($picfiles);
  $imghtml = "";
  $piccount = count($picfiles);
  $randpic = mt_rand(0, ($piccount - 1));
  $imghtml .= '<img src="../img/' .$picfiles[$randpic] .'" alt="Tallinna Ülikool">';
  
  require("header.php");
  
  
  if(isset($_POST["accountlogin"])){
    if(empty($_POST["emailinput"])){
        $emailerror = "Palun sisestage oma email!";
    } else {
        $email = test_input($_POST["emailinput"]);
    }
    if(empty($_POST["passwordinput"])){
        $passworderror = "Palun sisestage oma salasõna!";
    } else {
        $password = ($_POST["passwordinput"]);
    }
	if(strlen($_POST["passwordinput"]) < 8){
		$passworderror = "Liiga lühike salasõna (sisestasite ainult " .strlen($_POST["passwordinput"]) ." märki).";
	  }
    if(empty ($emailerror) and empty ($passworderror)){
        $result = signin($email, $password);
    }
}
?>
<body>
  <img src="../vp_pics/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <ul>
	<li><a href="createaccount.php"> Uue kasutaja loomise leht </a></li> <br>
  </ul>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<label for="emailinput">E-posti aadress (kasutajatunnus):</label>
	<input type="email" name="emailinput" id="emailinput" placeholder="E-posti aadress" value="<?php echo $email; ?>"> <?php echo "<span style='color:red;'> $emailerror </span>"; ?>
	<br>
	<br>
	<label for="passwordinput">Salasõna:</label>
	<input type="password" name="passwordinput" id="passwordinput" placeholder="Salasõna"> <span><?php echo "<span style='color:red;'> $passworderror </span>"; ?>
	<br>
	<br>
	<input type="submit" name="accountlogin" value="Logi sisse"><span><?php echo "&nbsp; &nbsp; &nbsp;" .$notice; ?></span>
	<br>
	<?php echo "<span style='color:red;'> $result </span>"; ?>
  </form>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursuse raames <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  <h1>Minust</h1>
  <p>Olen 20-aastane noormees Raplamaalt ning õpin Tallinna Ülikoolis informaatika erialal.</p>
  <p>Lehe avamise hetkel oli: <?php echo $weekdaynameset[$weekdaynow - 1] .", " .$datenow ." " .$monthnameset[$monthnow -1] ." " .$yearnow .", kell " .$clocknow; ?>.</p>
  <p><?php echo "Parajasti on " .$partofday ."."; ?></p> 
  <p><?php echo "Semestri kestvus päevades: " .$semestercurrentdays; ?></p>
  <hr>
  <?php echo $imghtml; ?>
</body>
</html>







