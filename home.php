<?php
  $username = "Oliver Antsov";
  $fulltimenow = date("d.m.Y H:i:s");
  $hournow = date("H");
  $partofday = "lihtsalt aeg";
  if ($hournow >=23 and $hournow < 7);{
	$partofday = "uneaeg";
  }
  if ($hournow >=11 and $hournow < 12);{
	$partofday = "lõunasöögiaeg";
  }
  if ($hournow >= 8 and $hournow < 17);{
	$partofday = "akadeemilise aktiivsuse aeg";  
  }
  if ($hournow >=17 and $hournow < 18);{
	$partofday = "õhtusöögiaeg";
  }
  if ($hournow >17 and $hournow < 23);{
	$partofday = "vabaaeg";
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
  if ($semestercurrent < 0);{
	  $semestercurrent = "Antud semester pole veel alanud!";
	}
  $semesterremaining = $semestercurrent->diff($semesterduration);
  if ($today > $semesterend);{
	  $semesterremaining = "Antud semester on juba lõppenud!";
	}
	
##if ($semestercurrent > $semesterduration);{
##	  $semesterremaining = "Antud semester on juba lõppenud!";
##	}
## teine lahendus KUI esimene ei tööta (pole kindel) 
## if($fromsemesterstartdays < 0) (semester pole peale hakanud) 
## leiame erinevuse tänasega (semesterduration jne)
  
  

?>
<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <title><?php echo $username; ?> veebiprogrammeerimine</title>

</head>
<body>
  <h1><?php echo $username; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursuse raames <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  <h1>Minust</h1>
  <p>Olen 20-aastane noormees Raplamaalt ning õpin Tallinna Ülikoolis informaatika erialal.</p>
  <p>Lehe avamise hetkel oli: <?php echo $fulltimenow; ?>.</p>
  <p><?php echo "Parajasti on " .$partofday ."."; ?></p>  
  <p><?php echo "Praeguse semestri kestvus algusest: " .$semestercurrent; ?></p>
  <p><?php echo "Praeguse semestri lõpuni on jäänud: " .$semesterreminder; ?></p> 
  
  
</body>
</html>