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

				echo"
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
		<link rel=\"stylesheet\" href=\"https://www.w3schools.com/w3css/4/w3.css\">

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
						Dashboard
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

		</table>
		<form method=post action=#>
				<br><br><br>
				<table align=\"center\" width=\"20%\" class=\"tabella\">
				<tr>
				<td colspan=\"4\" style=\" background-color: #ff5656; border: solid 1px black;\">
				<h2 align=\"center\" style=\"color: white\">Locandine<br></h2>
				</td>
				</tr>
				<tr>
				<td align=center>	<form method=post action=#>
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
			    </details></td></tr></table></form>";
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