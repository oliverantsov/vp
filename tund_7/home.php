<?php
  require("usesession.php");
  require("header.php");
  //var_dump($_POST);
  //$username = "Oliver Antsov";
  $datenow = date("d.");
  $yearnow = date("Y");
  $clocknow = date("H:i:s");
  $hournow = date("H");
  $partofday = "lihtsalt aeg";
  
  $weekdaynameset = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
  $monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
  ##echo $weekdaynameset[1];
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
  //echon välja
  
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
  ##$i = $i + 1;
  ##$i ++;
  //$i += 3
  ##for($i = 0;$i < $randpic; $i ++){
	  ##<img src="../img/pildifail" alt="tekst">
	  ##$imghtml .= '<img src="../img/' .$picfiles[$i] .'" alt="Tallinna Ülikool">';
	##}
  $imghtml .= '<img src="../img/' .$picfiles[$randpic] .'" alt="Tallinna Ülikool">';

?>
<body>
  <img src="../vp_pics/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <ul>
	<li><a href="ideapage.php"> Mõtete sisestamise leht </a></li> <br>
	<li><a href="ideaanswers.php"> Mõtete vastuste leht </a></li> <br>
	<li><a href="listfilms.php"> Filmide nimekirja leht </a></li> <br>
	<li><a href="addfilms.php"> Filmiinfo lisamise leht </a></li> <br>
	<li><a href="listfilmpersons.php"> Filmitegelaste loend </a></li> <br>
	<li><a href="addfilmrelations.php">Filmiinfo määramine erinevate parameetrite alusel</a></li> <br>
	<li><a href="userprofile.php"> Minu kasutajaprofiil </a></li> <br>
	<p><a href="?logout=1">Logi välja!</a></p>
  </ul>
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







