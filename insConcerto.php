<?php

session_start();

$_username = $_SESSION['username'];

if(isset($_SESSION['username']))
{
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
			$sql1 = "SELECT rlocale.Nome,rlocale.ID FROM rlocale";
			$result = mysqli_query($conn, $sql1);
			if(mysqli_num_rows($result) > 0 )
			{
				$nLocali = mysqli_num_rows($result);
				$locali[] = '';
				for($i = 0;$row = mysqli_fetch_assoc($result); $i++)
				{
					$locali[$i] = $row["Nome"];
					$idLocale[$i] = $row["ID"];
				}
			}
			else
			{
				echo "0 results";
			}

			$sql2 = "SELECT rband.Nome,rband.ID FROM rband";
			$result = mysqli_query($conn, $sql2);
			if(mysqli_num_rows($result) > 0 )
			{
				$nBand = mysqli_num_rows($result);
				$band[] = '';
				for($i = 0;$row = mysqli_fetch_assoc($result); $i++)
				{
					$band[$i] = $row["Nome"];
					$idBand[$i] = $row["ID"];
				}
			}
			else
			{
				echo "0 results";
			}










			if(!isset($_POST['button']))
			{
			   //il bottone non è stato cliccato
			echo
			"<!DOCTYPE html>
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
						Concerto
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
			<form method =\"POST\" action=\"insConcerto.php\">
			Data(aaaa-mm-gg)<input type=\"text\" name=\"data\">
			Ora(hh:mm:ss)<input type=\"text\" name=\"ora\">
			Compenso pattuito<input type=\"text\" name=\"compensoPattuito\">
			Compenso effettivo<input type=\"text\" name=\"compensoEffettivo\">";

						echo"Locale";
						echo"<td align=\"center\"><select name=\"locale\">";
						for($i=0;$i<$nLocali; $i++)
						{
							echo "<option value=\"".$idLocale[$i]."\">".$locali[$i]."</option>";
						}
						echo"</select>";
						echo"Band";
						echo"<td align=\"center\"><select name=\"band\">";
						for($i=0;$i<$nBand; $i++)
						{
							echo "<option value=\"".$idBand[$i]."\">".$band[$i]."</option>";
						}
						echo"</select>";

			echo"<input type =\"submit\" value=\"invia\" name=\"button\"><br>
			</form>
			";
			}
			else
			{
				$data=$_POST['data'];
				$ora=$_POST['ora'];
				$compensoPattuito=$_POST['compensoPattuito'];
				$compensoEffettivo=$_POST['compensoEffettivo'];
				$IDlocale=$_POST['locale'];
				$IDband=$_POST['band'];


				echo "$IDlocale";



					$sql = "INSERT INTO rconcerto(Data, Ora, compensoPattuito, compensoEffettivo, ID_Band, ID_Locale) VALUES ('$data', '$ora', '$compensoPattuito', '$compensoEffettivo', '$IDband','$IDlocale')";

						if (mysqli_query($conn, $sql)) {
					      echo "<script>alert(\"Riga aggiunta\");</script>";
					  } else {
					  	$error="Error: " . $sql . "<br>" . mysqli_error($conn);
					      echo "<script>alert(\"".$error."\");</script>";
					  }

			}
		}
}
else
{
	header("location: index.php");
}

?>