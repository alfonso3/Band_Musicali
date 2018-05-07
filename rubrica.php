
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
		$_username = $_SESSION["username"];
		echo "
<!DOCTYPE html>
<html>
	
	<head>
		<title>DPR Band</title>
		<link href=\"CSS/style.css\" rel=\"stylesheet\" type=\"text/css\">
		<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">

		<!-- jQuery library -->
		<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>
		
		<!-- Latest compiled JavaScript -->
		<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>

		<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById(\"myDropdown\").classList.toggle(\"show\");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName(\"dropdown-content\");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>


    <script>
		$(document).ready(function()
		{
   			$('[data-toggle=\"popover\"]').popover();
		});
	</script>
	<script>
	function storico() {
		window.location.href = 'storico.php';
	}

	function rubrica() {
		window.location.href = 'rubrica.php';
	}
	</script>
	</head>
	
	<body >




	<center><h4>".date("d/m/y")."</h4></center>

		<table width=\"100%\" >
			<tr>
				<td width=\"33%\">
					<a href=\"dashboard.php\"><img src=\"Images/Logo.png\"></a>
				</td>
				
				<td width=\"33%\">
				<div class=\"dashboardFont\">
						Rubrica
					</div>
				
				</td>

				<td width=\"33%\">  

				<div class=\"navbar-collapse collapse\" style=\"padding-left: 30%;\">
  					<ul class=\"nav navbar-nav\">
    					<li class=\"dropdown\">
     						 <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" ><div class=\"homeBar\">".$_username."<img src=\"Images/Img_utente.png\" class=\"img\" ></div></a>
      					<ul class=\"dropdown-menu\">
          					<!-- this dropdown menu item looks right -->
        					

        					<!-- this dropdown menu item (a logout form) does not -->
        					<li><form action=\"logout.php\" method=\"post\"><button type=\"submit\" class=\"btn btn-link navbar-btn navbar-link\">Logout</button></form></li>
        				</ul>
    				</li>
  </ul>
</div>

					
				</td>
			</tr>
		</table>


		<table width=\"100%\">

			<tr>
				<td colspan=\"3\">
					<br>
				</td>
			</tr> 

			<tr>
				<td  class=\"dashboard\">

<div class=\"dropdown\">
<button onclick=\"myFunction()\" class=\"dropbtn btn btn-default btn-lg btn-block\" style=\"background-color: #ff5656; color: white; font-weight: bold;\" >Nuovo</button>
  <div id=\"myDropdown\" class=\"dropdown-content\">
    <a style=\"color: #ff5656;\" href=\"insLocale.php\">Locale</a>
    <a style=\"color: #ff5656;\" href=\"insConcerto.php\">Concerto</a>
    <a style=\"color: #ff5656;\" href=\"insDirettore.php\">Direttore artistico</a>
  </div>
</div>

				</td>
				
				<td class=\"dashboard\">
					<input type=\"button\" style=\"background-color: #ff5656; color: white; font-weight: bold;\" class=\"btn btn-default btn-lg btn-block\" name=\"\" value=\"Storico\" onclick=\"storico()\">
				</td>

				<td class=\"dashboard\">
					<input type=\"button\" style=\"background-color: #ff5656; color: white; font-weight: bold;\" class=\"btn btn-default btn-lg btn-block\" name=\"\" value=\"Rubrica\" onclick=\"rubrica()\">
				</td>
			</tr>

		</table>";

	  if(!isset($_POST["btnInviaRegione"])){

	  	echo "<br><br><br><table width=100% >
	  	<tr>
	  	<td width=70%>

	  	<table width=50%  class=\"tabella\" align=center >
	  	<tr><td style=\"background-color: #ff5656; color: white; background-color: #ff5656; border: solid 1px black;\" width=70%><h3 align=\"center\" >Contati</h3></td></tr>
	  	<tr>
	  	<td width=70% align=center><br>
	  	<form name=dettagli method=post action=rubrica.php>	
	  	";

		for($i=0;$i<mysqli_num_rows($result);$i++){
				for($k=0;$k<mysqli_num_rows($result2);$k++){
					if($arrayIDSecondario[$i]===$arrayIDDir[$k])
					{
						echo "
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
						</details><br><br>";	
					}
				}	
			}



			echo "</td></tr></table></td><td  width=30%><table width=20%  align=center style=\"vertical-align: text-top;\" class=\"tabella\"> 

	  	<tr>
	  	<td style=\"background-color: #ff5656; color: white; background-color: #ff5656; border: solid 1px black;\" width=30%><h3 align=\"center\" >Filtra</h3></td>
	  	</tr><td width=30% align=center>
	  	<select name=regione>
					<option value=tutti>Tutti</option>";

					for($i=0;$i<count($arrayRegioni);$i++)
					{
						echo "<option value=$arrayRegioni[$i]>$arrayRegioni[$i]</option>";
					}
					echo "</select>	
					<input type=submit name=btnInviaRegione>
					</form></td>	</tr></table></td></tr></table>";		
	  }












	  else
	  {

	  	

	  	if($_POST["regione"]==='tutti'){

	  		echo "<br><br><br><table width=100% >
	  	<tr>
	  	<td width=70%>

	  	<table width=50%  class=\"tabella\" align=center>
	  	<tr><td style=\"background-color: #ff5656; color: white; background-color: #ff5656; border: solid 1px black;\" width=70%><h3 align=\"center\" >Contati</h3></td></tr>
	  	<tr>
	  	<td width=70% align=center><br>
<form name=dettagli method=post action=rubrica.php>
	  	";
		for($i=0;$i<mysqli_num_rows($result);$i++){
				for($k=0;$k<mysqli_num_rows($result2);$k++){
					if($arrayIDSecondario[$i]===$arrayIDDir[$k])
					{
						echo "
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
						</details><br><br>";	
					}
				}	
			}



			echo "</td></tr></table> </td><td  width=30%><table width=20%  align=center style=\"vertical-align: text-top;\" class=\"tabella\"> 

	  	<tr>
	  	<td style=\"background-color: #ff5656; color: white; background-color: #ff5656; border: solid 1px black;\" width=30%><h3 align=\"center\" >Filtra</h3></td>
	  	</tr><td width=30% align=center>
	  	<select name=regione>
					<option value=tutti>Tutti</option>";

					for($i=0;$i<count($arrayRegioni);$i++)
					{
						echo "<option value=$arrayRegioni[$i]>$arrayRegioni[$i]</option>";
					}
					echo "</select>	
					<input type=submit name=btnInviaRegione>
					</form> </td>	</tr></table></td></tr></table";		
	  	}
	  	else{






	  	echo "<br><br><br><table width=100% >
	  	<tr>
	  	<td width=70%>

	  	<table width=50%  class=\"tabella\" align=center>
	  	<tr><td style=\"background-color: #ff5656; color: white; background-color: #ff5656; border: solid 1px black;\" width=70%><h3 align=\"center\" >Contati</h3></td></tr>
	  	<tr>
	  	<td width=70% align=center><br><form name=dettagli method=post action=rubrica.php>
	  	";







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
							echo "
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
							</details><br><br>";	
						}
					}	
				}		 

				echo "</td></tr></table> </td><td  width=30%><table width=20%  align=center style=\"vertical-align: text-top;\" class=\"tabella\"> 

	  	<tr>
	  	<td style=\"background-color: #ff5656; color: white; background-color: #ff5656; border: solid 1px black;\" width=30%><h3 align=\"center\" >Filtra</h3></td>
	  	</tr><td width=30% align=center><select name=regione>
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
				</form> </td>	</tr></table></td></tr></table";	
	  	}
	  }	
			
   }
    else{
		echo "<script type=\"text/javascript\">window.location.href=\"dashboard.php\";</script>";
	}

  ?>

</body>
</html>	