<?php
session_start();
if(isset($_SESSION['username']))
{
	$_username= $_SESSION['username'];
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
		if(isset($_POST['button']))
		{
			$nome=$_POST['nome'];
			$cognome=$_POST['cognome'];
			$email=$_POST['email'];
			$telefono=$_POST['telefono'];

			$sql = "INSERT INTO rdirettoreartistico(Nome, Cognome, Email, Telefono) VALUES ('$nome', '$cognome', '$email', '$telefono')";

			if (mysqli_query($conn, $sql)) 
			{
				echo "<script>alert(\"Direttore artistico aggiunto\");</script>";
				header("location: insDirettore.php");
			} 
			else 
			{
				$error="Error: " . $sql . "<br>" . mysqli_error($conn);
			    echo "<script>alert(\"".$error."\");</script>";
			    header("location: insDirettore.php");
		    }


		}

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
						Direttore artistico
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
		    echo"<br><br><br>
			<form method =\"POST\" action=\"insDirettore.php\">

			<table align=\"center\" width=\"60%\" style=\"font-weight: bold;\" class=\"tabella\">
			<tr>
							<td colspan=\"2\" style=\" background-color: #ff5656; border: solid 1px black;\" >
								<h2 align=\"center\" style=\"color: white\">Aggiungi<br></h2>
							</td>
			</tr>
			
			<tr>
				<td colspan=\"2\"><br><br><br></td>
			</tr>

			<tr>
						<td width=\"10%\" style=\"text-align: center;\"><input type=\"text\" name=\"nome\" placeholder=\"nome\" required></td>
						<td width=\"10%\" style=\"text-align: center;\"><input type=\"text\" name=\"cognome\" placeholder=\"cognome\" required></td>
			</tr>
			<tr>
				<td colspan=\"2\"><br><br><br></td>
			</tr>
			<tr>
						<td width=\"10%\" style=\"text-align: center;\"><input type=\"text\" name=\"email\" placeholder=\"email\" required></td>
						<td width=\"10%\" style=\"text-align: center;\"><input type=\"text\" name=\"telefono\" placeholder=\"telefono\" required></td>
			</tr>
			<tr>
				<td><br><br><br></td>
			</tr>
			<tr>
				<td style=\"text-align: center;\" colspan=\"2\"><input type =\"submit\" name=\"button\"></td>
			</tr>
			</table>
			
			
			
			
			
			</form>";
	}
}
else
{
	header("location: index.php");
}
?>