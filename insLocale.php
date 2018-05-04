<html>
<head>
	<title>Benvenuto su DprBand!</title>
</head>
<body>
	<?php
		session_start();
		$dbHost = "127.0.0.1";
	  	$dbUsername = "admin";
	  	$dbPassword = "admin";
	  	$dbName = "band";

	  	$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
	  	if (!$conn) {
	    	die("Connection failed: " . mysqli_connect_error());
		}
		if(isset($_SESSION["username"])){
			if(!isset($_POST["btnInsLocale"]))
			{
					$sql = "SELECT Nome, Cognome, ID FROM rdirettoreartistico";
					$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) > 0) {
						$arrayDirettoreArtisticoN[] = ""; //nomi
						$arrayDirettoreArtisticoC[] = ""; //cognomi
						$arrayID_DirettoreArtistico[] = ""; //id
					    while($row = mysqli_fetch_assoc($result) ) {
					    	$arrayDirettoreArtisticoN[] = $row["Nome"];
					    	$arrayDirettoreArtisticoC[] = $row["Cognome"];
					    	$arrayID_DirettoreArtistico[] = $row["ID"];
	   					}
					} 
					else {
	    				echo "0 risultati";
					}

					echo "<form name=insLocale action=insLocale.php method=post>
						<input name=nome type=text placeholder=Nome locale required>
						<input name=regione type=text placeholder=Regione required>
						<input name=citta type=text placeholder=Citt&agrave required>" . "<br>" .
						"<input name=indirizzo type=text placeholder=Indirizzo required>
						<input name=tipoLocale type=text placeholder=Tipo locale required>
						<select name=direttoreArtistico>
						<option value=\'\'>Direttore artistico</option>
						";

					for($i=1;$i<count($arrayDirettoreArtisticoN);$i++)
					{
						echo "<option value=\"".$arrayID_DirettoreArtistico[$i]." required\">".$arrayDirettoreArtisticoC[$i]."</option>";
					}
					echo "</select>	
						 <input name=btnInsLocale type=submit>
						 </form>";

			}
			else{
				 $Tipo = $_POST["tipoLocale"];
				 $Indirizzo = $_POST["indirizzo"];
				 $Nome = $_POST["nome"];
				 $Regione = $_POST["regione"];
				 $Citta = $_POST["citta"];
				 $ID_DirettoreArtistico = $_POST["direttoreArtistico"];

				 $sql = "INSERT INTO rlocale(Tipo, Indirizzo, Nome, Regione, Citta, ID_DirettoreArtistico) VALUES ('$Tipo', '$Indirizzo', '$Nome', '$Regione', '$Citta', '$ID_DirettoreArtistico')";

				 if (mysqli_query($conn, $sql)) {
				      echo "<script>alert(\"Locale  Aggiunto\");</script>";
				 } 
				 else {
				  	  $error="Error: " . $sql . "<br>" . mysqli_error($conn);
				      echo "<script>alert(\"".$error."\");</script>";
				  }
			}
		}
		else{
			echo "<script type=\"text/javascript\">window.location.href=\"dashboard.php\";</script>";
		}
	?>
</body>
</html>