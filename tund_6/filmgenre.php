<?php
  require("usesession.php");
  require("../../../config.php");
  require("fnc_common.php");
  require("header.php");
  $database = "if20_oliver_ant_1";
  $film = "";
  $genre = "";
  $notice = "";
  $filmtitledropdown = "";
  $genrenamedropdown = "";
  //filmi dropdown
  $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
  $stmt = $conn->prepare("SELECT movie_id, title FROM movie");
  echo $conn->error;
  $stmt->bind_result($movieidfromdb, $movietitlefromdb);
  $stmt->execute();
  while($stmt->fetch()){
	  $filmtitledropdown .= "\n \t \t" .'<option value="' .$movieidfromdb .'">' .$movietitlefromdb .'</option>';
  }
  $stmt->close();
  $conn->close();

  //žanri dropdown
  $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
  $stmt = $conn->prepare("SELECT genre_id, genre_name FROM genre");
  echo $conn->error;
  $stmt->bind_result($genreidfromdb, $genrenamefromdb);
  $stmt->execute();
  while($stmt->fetch()){
	  $genrenamedropdown .= "\n \t \t" .'<option value="' .$genreidfromdb .'">' .$genrenamefromdb .'</option>';
  }
  $stmt->close();
  $conn->close();
  
  //seostame žanri filmiga
  
  if(isset($_POST["moviegenresubmit"])){
	$filminput = $_POST["filminput"];
	$genreinput = $_POST["genreinput"];
	$moviegenreid = "";
	$notice = null;
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("INSERT INTO movie_genre (movie_id, genre_id) VALUES(?,?)");
	echo $conn->error;
	$stmt->bind_param("ii", $filminput, $genreinput);
	if($stmt->execute()){
		$notice = "Žanr on filmile edukalt lisatud!";
	} else {
		$notice = $stmt->error;
	}
	$stmt->close();
	$conn->close();
  }
  
?>
<img src="../vp_pics/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <ul>
	<li><a href="home.php"> Tagasi kodulehele </a></li> <br>
	<li><a href="?logout=1">Logi välja</a>!</li> <br>
  </ul>
  <hr>
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>Filmi žanrid<p>
  <hr>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="filminput">Film: </label>
  <select name="filminput" id="filminput">
		<option value="" selected disabled>Vali film</option><?php echo $filmtitledropdown; ?>
  </select>
  <br>
  <br>
  <label for="genreinput">Zanr: </label>
  <select name="genreinput" id="genreinput">
		<option value="" selected disabled>Vali žanr</option><?php echo $genrenamedropdown; ?>
  </select>
  <br>
  <br>
  <input type="submit" name="moviegenresubmit" value="Seosta film žanriga"><span><?php echo "&nbsp;" .$notice; ?></span>
  </form>