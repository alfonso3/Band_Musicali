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

		$sql = "SELECT * FROM rlocale";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			$arrayIDLocale[] = ""; //id
			$arrayTipoLocale[] = ""; //tipo
			$arrayIndirizzoLocale[] = ""; //indirizzo
			$arrayNomeLocale[] = ""; //nome
			$arrayRegioneLocale[] = ""; //regione
			$arrayCittàLocale[] = ""; //città
			$arrayIDSecondario[] = ""; //id secondario direttore artistico
			$indiceLocale=0;
		    while($row = mysqli_fetch_assoc($result) ) {
		      $arrayIDLocale[$indiceLocale] = $row["ID"];
			  $arrayTipoLocale[$indiceLocale] = $row["Tipo"];
			  $arrayIndirizzoLocale[$indiceLocale] = $row["Indirizzo"];
			  $arrayNomeLocale[$indiceLocale] = $row["Nome"];
			  $arrayRegioneLocale[$indiceLocale] = $row["Regione"];
			  $arrayCittàLocale[$indiceLocale] = $row["Citta"];
			  $arrayIDSecondario[$indiceLocale] = $row["ID_DirettoreArtistico"];
			  $indiceLocale++;
			}
		} 


		$sql2 = "SELECT * FROM rdirettoreartistico";
		$result2 = mysqli_query($conn, $sql2);

		if (mysqli_num_rows($result2) > 0) {
			$arrayIDDir[] = "";
			$arrayNomeDir[] = "";
			$arrayCognomeDir[] = ""; 
			$arrayEmailNomeDir[] = "";
			$arrayTelefonoNomeDir[] = "";
			$indiceDir=0;
		    while($row = mysqli_fetch_assoc($result2) ) {
		      $arrayIDDir[$indiceDir] = $row["ID"];
			  $arrayNomeDir[$indiceDir] = $row["Nome"];
			  $arrayCognomeDir[$indiceDir] = $row["Cognome"]; 
			  $arrayEmailDir[$indiceDir] = $row["Email"];
			  $arrayTelefonoDir[$indiceDir] = $row["Telefono"];
			  $indiceDir++;
			}
		} 

	  	$sql3 = "SELECT DISTINCT Regione FROM rlocale";
		$result3 = mysqli_query($conn, $sql3);

		if (mysqli_num_rows($result3) > 0) {
			$arrayRegioni[] = "";
			$indiceReg=0;
		    while($row = mysqli_fetch_assoc($result3) ) {
		      $arrayRegioni[$indiceReg] = $row["Regione"];
			  $indiceReg++;
			}
		}

	if(isset($_SESSION["username"])){

	  if(!isset($_POST["btnInviaRegione"])){

		for($i=0;$i<mysqli_num_rows($result);$i++){
				for($k=0;$k<mysqli_num_rows($result2);$k++){
					if($arrayIDSecondario[$i]===$arrayIDDir[$k])
					{
						echo "<form name=dettagli method=post action=rubrica.php>
							<details>
							<summary>". $arrayNomeLocale[$i] . ", " . $arrayCittàLocale[$i]  . "</summary>
							<div>Indirizzo:&ensp;$arrayIndirizzoLocale[$i]</div>
							<div>Regione:&ensp;$arrayRegioneLocale[$i]</div>
							<div>Tipo:&ensp;$arrayTipoLocale[$i]</div>
							<details>
								<summary>". $arrayNomeDir[$k] . ", " . $arrayCognomeDir[$k]  . "</summary>
								<div>Email:&ensp;$arrayEmailDir[$k]</div>
								<div>Tel:&ensp;$arrayTelefonoDir[$k]</div>
							</details>
						</details><br>";	
					}
				}	
			}



			echo "<select name=regione>
					<option value=tutti>Tutti</option>";

					for($i=0;$i<count($arrayRegioni);$i++)
					{
						echo "<option value=$arrayRegioni[$i]>$arrayRegioni[$i]</option>";
					}
					echo "</select>	
					<input type=submit name=btnInviaRegione>
					</form>";		
	  }
	  else
	  {
	  	if($_POST["regione"]==='tutti'){
		for($i=0;$i<mysqli_num_rows($result);$i++){
				for($k=0;$k<mysqli_num_rows($result2);$k++){
					if($arrayIDSecondario[$i]===$arrayIDDir[$k])
					{
						echo "<form name=dettagli method=post action=rubrica.php>
							<details>
							<summary>". $arrayNomeLocale[$i] . ", " . $arrayCittàLocale[$i]  . "</summary>
							<div>Indirizzo:&ensp;$arrayIndirizzoLocale[$i]</div>
							<div>Regione:&ensp;$arrayRegioneLocale[$i]</div>
							<div>Tipo:&ensp;$arrayTipoLocale[$i]</div>
							<details>
								<summary>". $arrayNomeDir[$k] . ", " . $arrayCognomeDir[$k]  . "</summary>
								<div>Email:&ensp;$arrayEmailDir[$k]</div>
								<div>Tel:&ensp;$arrayTelefonoDir[$k]</div>
							</details>
						</details><br>";	
					}
				}	
			}



			echo "<select name=regione>
					<option value=tutti>Tutti</option>";

					for($i=0;$i<count($arrayRegioni);$i++)
					{
						echo "<option value=$arrayRegioni[$i]>$arrayRegioni[$i]</option>";
					}
					echo "</select>	
					<input type=submit name=btnInviaRegione>
					</form>";		
	  	}
	  	else{
		  	$regione = $_POST["regione"];
		  	echo $regione ;

			$sql = "SELECT * FROM rlocale WHERE Regione = '$regione'";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
				$arrayIDLocale[] = ""; //id
				$arrayTipoLocale[] = ""; //tipo
				$arrayIndirizzoLocale[] = ""; //indirizzo
				$arrayNomeLocale[] = ""; //nome
				$arrayRegioneLocale[] = ""; //regione
				$arrayCittàLocale[] = ""; //città
				$arrayIDSecondario[] = ""; //id secondario direttore artistico
				$indiceLocale=0;
			    while($row = mysqli_fetch_assoc($result) ) {
			      $arrayIDLocale[$indiceLocale] = $row["ID"];
				  $arrayTipoLocale[$indiceLocale] = $row["Tipo"];
				  $arrayIndirizzoLocale[$indiceLocale] = $row["Indirizzo"];
				  $arrayNomeLocale[$indiceLocale] = $row["Nome"];
				  $arrayRegioneLocale[$indiceLocale] = $row["Regione"];
				  $arrayCittàLocale[$indiceLocale] = $row["Citta"];
				  $arrayIDSecondario[$indiceLocale] = $row["ID_DirettoreArtistico"];
				  $indiceLocale++;
				}
			}
			 
			for($i=0;$i<mysqli_num_rows($result);$i++){
					for($k=0;$k<mysqli_num_rows($result2);$k++){
						if($arrayIDSecondario[$i]===$arrayIDDir[$k])
						{
							echo "<form name=dettagli method=post action=rubrica.php>
								<details>
								<summary>". $arrayNomeLocale[$i] . ", " . $arrayCittàLocale[$i]  . "</summary>
								<div>Indirizzo:&ensp;$arrayIndirizzoLocale[$i]</div>
								<div>Regione:&ensp;$arrayRegioneLocale[$i]</div>
								<div>Tipo:&ensp;$arrayTipoLocale[$i]</div>
								<details>
									<summary>". $arrayNomeDir[$k] . ", " . $arrayCognomeDir[$k]  . "</summary>
									<div>Email:&ensp;$arrayEmailDir[$k]</div>
									<div>Tel:&ensp;$arrayTelefonoDir[$k]</div>
								</details>
							</details><br>";	
						}
					}	
				}		 

				echo "<select name=regione>
				<option value=$regione>$regione</option>";

				for($i=0;$i<count($arrayRegioni);$i++)
				{
					if($regione === $arrayRegioni[$i]){
						
					}
					else{
						echo "<option value=$arrayRegioni[$i]>$arrayRegioni[$i]</option>";	
					}
				}
				echo "<option value=tutti>Tutti</option>
				</select>	
				<input type=submit name=btnInviaRegione>
				</form>";	
	  	}
	  }	
			
   }
    else{
		echo "<script type=\"text/javascript\">window.location.href=\"dashboard.php\";</script>";
	}

  ?>

</body>
</html>