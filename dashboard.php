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
		//query per saldo totale

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
	    echo "0 results";
		}

		//query per eventi in programma

		$arrayNomeEventi[]="";
		$arrayCittaEventi[]="";
		$arrayDataEventi[]="";
		$sql2 = "SELECT rlocale.Nome, rlocale.Citta, rconcerto.Data FROM rconcerto INNER JOIN rlocale ON rconcerto.ID_Locale = rlocale.ID WHERE rconcerto.CompensoEffettivo!='NULL'";
		$result = mysqli_query($conn, $sql2);
		if (mysqli_num_rows($result) > 0) 
		{
		    while($row = mysqli_fetch_assoc($result))
		    {
		    	$arrayNomeEventi[]=$row["Nome"];
				$arrayCittaEventi[]=$row["Citta"];
				$arrayDataEventi[]=$row["Data"];
			} 
		}
		else
	    {
	    echo "0 results";
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
	
	<body>

	<center><h4>".date("d/m/y")."</h4></center>

		<table width=\"100%\">
			<tr>
				<td width=\"30%\">
					<a href=\"dashboard.php\"><img src=\"Images/Logo.png\"></a>
				</td>
				
				<td width=\"50%\">
				
				</td>

				<td width=\"20%\">
					<div class=\"homeBar\"><a href=\"#\" data-placement=\"bottom\" data-toggle=\"popover\" title=\"Popover Header\" data-content=\"Some content inside the popover\">".$_username."<img src=\"Images/Img_utente.png\" class=\"img\" ></a></div>
				</td>
			</tr>
		</table>

		<br>

		<table width=\"100%\">

			<tr>
				<td colspan=\"3\">
					<div class=\"dashboardFont\">
						Dashboard
						<br>
						<br>
					</div>
				</td>
			</tr> 

			<tr>
				<td  class=\"dashboard\">
					<input type=\"button\" style=\"background-color: #ff5656; color: white; font-weight: bold;\" class=\"btn btn-default btn-lg btn-block\" name=\"\" value=\"Nuovo\">
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

		<table width=\"100%\">

			<tr>
				<td>
					<table align=\"center\" width=\"70%\" >

						<tr>
							<td colspan=\"3\" style=\"color: white; background-color: #ff5656;\">
								<h2 align=\"center\" >Concerti<br><hr width=\"100%\"></h2>
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
						</tr>



						";
						for($i=0;$i<count($arrayNomeEventi);$i++)
						{
							echo"<tr><td align=\"center\" width=\"33%\"><h4>";
							echo $arrayNomeEventi[$i]." ";
							echo"</h4></td><td align=\"center\" width=\"33%\"><h4>";
							echo $arrayCittaEventi[$i]." ";
							echo"</h4></td><td align=\"center\" width=\"33%\"><h4>";
							echo $arrayDataEventi[$i]." ";
							echo "</h4></td></tr>";
						}

						echo"
					</table>
				</td>

				<td>
					<table width=\"60%\" align=\"center\" border=\"1px\">

						<tr>
							<td style=\"background-color: #ff5656;\">
								<h3 align=\"center\" style=\"color: white;\">Guadagno totale</h3>
							</td>
						</tr>

							<td align=\"center\"><h1>
								".$quotaTotale."&euro;</h1>
							</td>
						</tr>

					</table>
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