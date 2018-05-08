<?php
session_start();


if(isset($_SESSION['username']))
{
$_username = $_SESSION['username'];
$dbHost = "127.0.0.1";
$dbUsername = "admin";
$dbPassword = "admin";
$dbName = "band";

$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
if (!$conn) 
{
    die("Connection failed: " . mysqli_connect_error());
}
else
{
		

		$quotaTotale=0;
		$sql1 = "SELECT CompensoEffettivo FROM rconcerto";
		$result = mysqli_query($conn, $sql1);
		if (mysqli_num_rows($result) > 0) 
		{
		    while($row = mysqli_fetch_assoc($result))
		    {
		    	$quotaTotale=$quotaTotale+$row["CompensoEffettivo"];
			} 
		}
		else
	    {
	    
		}

		

		if(isset($_POST['paga']))
		{

			$dimensione=3;



			for($i=1;$i<$dimensione+2;$i++)
			{
				if($_POST["inputEffettivo$i"]=="")
				{
					
				}
				else
				{
					$inputEffettivo = $_POST["inputEffettivo$i"];
					break;
				}
			}
			


			$id = $_POST['paga'];
		   	$sqlEffettivo = "UPDATE rconcerto SET CompensoEffettivo = '$inputEffettivo' WHERE ID = '$id'";
			 mysqli_query($conn, $sqlEffettivo);
			
			 
			echo "<script>window.location.href = 'dashboard.php'</script>";
		}


		//query per eventi in programma

		$arrayNomeEventi[]="";
		$arrayCittaEventi[]="";
		$arrayDataEventi[]="";

		$sql2 = "SELECT rconcerto.ID, rlocale.Nome, rlocale.Citta, rconcerto.Data FROM rconcerto INNER JOIN rlocale ON rconcerto.ID_Locale = rlocale.ID WHERE rconcerto.CompensoEffettivo='0'";

		$result = mysqli_query($conn, $sql2);
		if (mysqli_num_rows($result) > 0) 
		{
		    while($row = mysqli_fetch_assoc($result))
		    {
		    	$arrayIdEventi[]=$row["ID"];
		    	$arrayNomeEventi[]=$row["Nome"];
				$arrayCittaEventi[]=$row["Citta"];
				$arrayDataEventi[]=$row["Data"];
			} 
		}
}


//METTI QUA IL TUO HTML -------------------------->

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
	function Locandine() {
		window.location.href = 'locandina.php';
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

		<br>
		<br>
		<br>

		<table width=\"100%\">

			<tr>
				<td>
					<form action=\"dashboard.php\" method=\"post\">
					<table align=\"center\" width=\"70%\" class=\"tabella\" >

						<tr>
							<td colspan=\"4\" style=\" background-color: #ff5656; border: solid 1px black;\" >
								<h2 align=\"center\" style=\"color: white\">Concerti<br></h2>
							</td>
						</tr>

						<tr>
							<td style=\"background-color: #ff5656; color: white;\">
								<h3 align=\"center\" >Locale</h3>
							</td>
							<td style=\"background-color: #ff5656; color: white;\">
								<h3 align=\"center\">Citta</h3>
							</td>
							<td style=\"background-color: #ff5656; color: white;\">
								<h3 align=\"center\">Data</h3>
							</td>
							<td style=\"background-color: #ff5656; color: white;\">
								<h3 align=\"center\">Compenso</h3>
							</td>
						</tr>



						";
						for($i=1;$i<count($arrayNomeEventi);$i++)
						{
							echo"<tr><td align=\"center\" width=\"30%\"><h4>";
							echo $arrayNomeEventi[$i]." ";
							echo"</h4></td><td align=\"center\" width=\"30%\"><h4>";
							echo $arrayCittaEventi[$i]." ";
							echo"</h4></td><td align=\"center\" width=\"30%\"><h4>";
							echo $arrayDataEventi[$i]." ";
							echo "</h4></td>
							<td align=\"center\" width=\"10%\">
							   <details>
							   	<summary><h4><u>Ins. effettivo</u></h4></summary>
							   	<div><input type=text class=\"w3-input w3-animate-input\" placeholder=\"Importo\" name=inputEffettivo$i value=\"\"></div>
							   	<div><button  type=\"submit\" style=\"width: 100%;\" name=\"paga\" value=\"".$arrayIdEventi[$i-1]."\">Invia</button></div>
							   </details>
								
							</td>
							</tr>";
						}

						echo"
					</table>
					</form>
				</td>
							
				<td>
					<table width=\"60%\" align=\"center\" border=\"1px\">

						<tr>
							<td style=\"background-color: #ff5656;\">
								<h3 align=\"center\" style=\"color: white;\">Guadagno totale</h3>
							</td>
						</tr>

						<tr>
							<td align=\"center\"><h1>
								".$quotaTotale."&euro;</h1>
							</td>
						</tr>

					</table>
				</td>
			</tr>

		</table><br><br><br><br><br>

<table align=center>
<tr>
<td>
<div style=\"width:100%;\">
<input  type=\"button\" style=\"background-color: #ff5656; color: white; font-weight: bold;\" class=\"btn btn-default btn-lg btn-block\" name=\"\" value=\"Locandine\" onclick=\"Locandine()\">
	</div>	
</td>
</tr>
</table>
	</body>
	
	</html>
";

}
else
{
	header("location: index.php");
}
?>