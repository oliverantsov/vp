<?php
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
  
  $username = "Oliver Antsov";
  $datenow = date("d.");
  $yearnow = date("Y");
  $clocknow = date("H:i:s");
  $hournow = date("H");
  $partofday = "lihtsalt aeg";
  
  $weekdaynameset = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
  $monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
  ##echo $weekdaynameset[1];
  $weekdaynow = date("N");
  $monthnow = date("N");
  
  if ($hournow > 23 and $hournow <= 7);{
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
  if ($semestercurrentdays < 0);{
	  $semestercurrent = "Antud semester pole veel alanud!";
	}
  if ($semestercurrentdays > $semesterend);{
	  $semesterremaining = "Antud semester on juba lõppenud!";
	}
	
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
  for($i = 0;$i < $randpic; $i ++){
	  ##<img src="../img/pildifail" alt="tekst">
	  $imghtml .= '<img src="../img/' .$picfiles[$i] .'" alt="Tallinna Ülikool">';
	}
  require("header.php");
?>
<body>
  <img src="../vp_pics/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <h1><?php echo $username; ?></h1>
  <a href="ideapage.php"> Mõtete sisestamise leht </a> <br>
  <a href="ideaanswers.php"> Mõtete vastuste leht </a>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursuse raames <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  <h1>Minust</h1>
  <p>Olen 20-aastane noormees Raplamaalt ning õpin Tallinna Ülikoolis informaatika erialal.</p>
  <p>Lehe avamise hetkel oli: <?php echo $weekdaynameset[$weekdaynow - 1] .", " .$datenow ." " .$monthnameset[$monthnow +1] ." " .$yearnow .", kell " .$clocknow; ?>.</p>
  <p><?php echo "Parajasti on " .$partofday ."."; ?></p> 
  <p><?php echo "Praeguse semestri kestvus algusest: " .$semestercurrentdays ." päeva"; ?></p>
  <hr>
  <?php echo $imghtml; ?>
  
</body>
</html>







