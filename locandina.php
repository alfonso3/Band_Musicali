<html>
<head>
	<title>Benvenuto su DprBand!</title>
</head>
<body>
	<?php
		session_start();
		$_username = $_SESSION['username'];
		$dbHost = "127.0.0.1";
	  	$dbUsername = "admin";
	  	$dbPassword = "admin";
	  	$dbName = "band";

	  	$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
	  	if (!$conn) {
	    	die("Connection failed: " . mysqli_connect_error());
		}
		if(isset($_SESSION["username"])){
			if(!isset($_POST["btnLocandina"])){

				echo "<form method=post action=#>
				<details>
					  <summary>Visualizza locandina</summary>
					  <div>
					  	<select name=\"locandinaConcerto\">";
						  $sqlLoc = "SELECT rconcerto.ID, rlocale.Nome, rlocale.Citta, rconcerto.Data, rconcerto.Locandina FROM rconcerto INNER JOIN rlocale ON rconcerto.ID_Locale = rlocale.ID WHERE rconcerto.Locandina!=''";

							$resultLoc = mysqli_query($conn, $sqlLoc);
							if (mysqli_num_rows($resultLoc) > 0) 
							{
							    while($row = mysqli_fetch_assoc($resultLoc))
							    {
							    	$arrayIdEventiLoc[]=$row["ID"];
							    	$arrayNomeLocaleLoc[]=$row["Nome"];
									$arrayCittaLocaleLoc[]=$row["Citta"];
									$arrayDataConcertoLoc[]=$row["Data"];
								} 
							}
							echo "

							<option value=\'\'>Locandina</option>";
								for($w=0;$w<count($arrayIdEventiLoc); $w++)
								{
									echo "<option value=\"".$arrayIdEventiLoc[$w]."\">".$arrayNomeLocaleLoc[$w] . ", " . $arrayDataConcertoLoc[$w] ."</option>";
								}
								echo"</select>
								<button type=submit value=\"\" name=btnLocandina>Invia</button>
			    </details></form>";
			}
			else{

				$idLocandina = $_POST["locandinaConcerto"];
				$sql = "SELECT Locandina, ID FROM rconcerto WHERE ID='$idLocandina'";

				$result = mysqli_query($conn, $sql	);
				$row = mysqli_fetch_assoc($result);
				if (mysqli_num_rows($result) > 0) 
				{
				    		$url=$row["Locandina"];
				    		header("location: Images/$url");
				    
				}
			}
		}
	else{
			echo "<script type=\"text/javascript\">window.location.href=\"dashboard.php\";</script>";
		}
	?>
</body>
</html>