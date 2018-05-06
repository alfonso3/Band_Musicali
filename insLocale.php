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

function myFunction() {
    document.getElementById(\"myDropdown\").classList.toggle(\"show\");
}

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
						Locale
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

		</table>
<br><br><br>
		<form name=insLocale action=insLocale.php method=post>

		<table align=\"center\" width=\"60%\" style=\"font-weight: bold;\" class=\"tabella\">
			<tr>
				<td style=\"text-align: center; background-color:#ff5656; border: solid 1px black;\" colspan=\"5\" ><h2 style=\"color: white; \">Aggiungi</h2></td>
			</tr>
			<tr>
			<td><br><br></td>
			</tr>
			<tr>
			<td width=\"10%\" style=\"text-align: center;\"><input name=nome type=text placeholder=Nome locale required></td>
			<td></td>
			<td width=\"10%\" style=\"text-align: center;\"><input name=regione type=text placeholder=Regione required></td>
			<td></td>
			<td width=\"10%\" style=\"text-align: center;\"><input name=citta type=text placeholder=Citt&agrave required></td>
			</tr>
			<tr>
			<td><br><br><br></td>
			</tr>
			<tr>
			<td width=\"10%\" style=\"text-align: center;\"><input name=indirizzo type=text placeholder=Indirizzo required></td>
			<td></td>
			<td width=\"10%\" style=\"text-align: center;\"><input name=tipoLocale type=text placeholder=Tipo locale required></td>
			<td></td>
			<td width=\"10%\" style=\"text-align: center;\"><select name=direttoreArtistico>
						<option value=\'\'>Direttore artistico</option>
						";

					for($i=1;$i<count($arrayDirettoreArtisticoN);$i++)
					{
						echo "<option value=\"".$arrayID_DirettoreArtistico[$i]."\" required>".$arrayDirettoreArtisticoC[$i]."</option>";
					}
					echo "</select>	</td>
			</tr>

			<tr>
			<td><br><br><br></td>
			</tr>

			<tr>
				<td style=\"text-align: center;\" colspan=\"5\"><input name=btnInsLocale type=submit></td>
			</tr>

			<tr>
			<td><br></td>
			</tr>

		</table>

						 
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
				      //echo "<script>alert(\"Locale  Aggiunto\");</script>";
				 } 
				 else {
				  	  $error="Error: " . $sql . "<br>" . mysqli_error($conn);
				      //echo "<script>alert(\"".$error."\");</script>";
				  }
				 header("location: insLocale.php");
			}
		}
		else{
			echo "<script type=\"text/javascript\">window.location.href=\"dashboard.php\";</script>";
		}
	?>
</body>
</html>