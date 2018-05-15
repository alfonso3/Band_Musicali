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
		

		if(!isset($_POST['button']))
		{
							$sql1 = "SELECT rlocale.Nome, rlocale.Citta, rconcerto.Data, rconcerto.Ora, rconcerto.CompensoPattuito, rconcerto.CompensoEffettivo FROM rconcerto INNER JOIN rlocale ON rconcerto.ID_Locale = rlocale.ID WHERE rconcerto.CompensoEffettivo!='0'";

							$result = mysqli_query($conn, $sql1);

							if(mysqli_num_rows($result) > 0 )
							{
								$nEventi = mysqli_num_rows($result);
								$nomeLocale[] = '';
								$cittaLocale[] = '';
								$dataConcerto[] = '';
								$oraConcerto[] = '';
								$compensoPattuitoConcerto[] = '';
								$compensoEffettivoConcerto[] = '';
								for($i = 0;$row = mysqli_fetch_assoc($result); $i++)
								{
									$nomeLocale[$i] = $row["Nome"];
									$cittaLocale[$i] = $row["Citta"];
									$dataConcerto[$i] = $row["Data"];
									$oraConcerto[$i] = $row["Ora"];
									$compensoPattuitoConcerto[$i] = $row["CompensoPattuito"];
									$compensoEffettivoConcerto[$i] = $row["CompensoEffettivo"];
								}
							}
							else
							{
							echo "0 results";
							}

							echo"<!DOCTYPE html>
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
						Storico
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















<br><br><br>



<form action=\"storico.php\" method=\"POST\">
<table width=100% align=center>
	<tr>
		<td>
			<table align=\"center\" width=\"70%\" class=\"tabella\" >
				<tr>
					<td style=\" background-color: #ff5656; border: solid 1px black;\">
						<h2 align=\"center\" style=\"color: white\">Concerti</h2>
					</td>
				</tr>

				<tr>
				<td align=\"center\">	
";


							for($i=0;$i<$nEventi;$i++)
							{
								
								echo"	
										<details>
										<summary>".$cittaLocale[$i]." ".$dataConcerto[$i]."</summary>
										<div>Ora di inizio: ".$oraConcerto[$i]."</div>
										<div>Locale: ".$nomeLocale[$i]."</div>
										<div>Compenso pattuito: ".$compensoPattuitoConcerto[$i]."</div>
										<div>Compenso effettivo ricevuto: ".$compensoEffettivoConcerto[$i]."</div>
										</details><br>
										";
							}



							echo" </td></tr></table></td><td>
							<table align=\"center\" width=\"30%\" class=\"tabella\" >
								<tr>
									<td style=\" background-color: #ff5656; border: solid 1px black;\">
										<h2 align=\"center\" style=\"color: white\">Filtra</h2>
									</td>
								</tr>
								<tr>
									<td align=center>

							Ordina per guadagno:<br> ";
							echo"<select name=\"ordinamento\">
									  <option value=\"casuale\">-casuale-</option>
							 		  <option value=\"crescente\">Crescente</option>
									  <option value=\"decrescente\">Decrescente</option>
								</select>
									  <br><input type=\"submit\" name=\"button\" value=\"Ricerca\"></form></td></tr></table>";
		





























		}
		else
		{	
	
			$ordinamento = $_POST["ordinamento"];

							if($ordinamento == "crescente")
			    			{

			    				$sql2 = "SELECT rlocale.Nome, rlocale.Citta, rconcerto.Data, rconcerto.Ora, rconcerto.CompensoPattuito, rconcerto.CompensoEffettivo FROM rconcerto INNER JOIN rlocale ON rconcerto.ID_Locale = rlocale.ID WHERE rconcerto.CompensoEffettivo!='0' ORDER BY CompensoEffettivo ASC";

							$result = mysqli_query($conn, $sql2);

							if(mysqli_num_rows($result) > 0 )
							{
								$nEventi = mysqli_num_rows($result);
								$nomeLocale[] = '';
								$cittaLocale[] = '';
								$dataConcerto[] = '';
								$oraConcerto[] = '';
								$compensoPattuitoConcerto[] = '';
								$compensoEffettivoConcerto[] = '';
								for($i = 0;$row = mysqli_fetch_assoc($result); $i++)
								{
									$nomeLocale[$i] = $row["Nome"];
									$cittaLocale[$i] = $row["Citta"];
									$dataConcerto[$i] = $row["Data"];
									$oraConcerto[$i] = $row["Ora"];
									$compensoPattuitoConcerto[$i] = $row["CompensoPattuito"];
									$compensoEffettivoConcerto[$i] = $row["CompensoEffettivo"];
								}
							}
							else
							{
							echo "0 results";
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
		<link rel=\"stylesheet\" href=\"https://www.w3schools.com/w3css/4/w3.css\">

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
	
	<body>
	<center><h4>".date("d/m/y")."</h4></center>

		<table width=\"100%\" >
			<tr>
				<td width=\"33%\">
					<a href=\"dashboard.php\"><img src=\"Images/Logo.png\"></a>
				</td>
				
				<td width=\"33%\">
				<div class=\"dashboardFont\">
						Storico
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






















<br><br><br>



<form action=\"storico.php\" method=\"POST\">
<table width=100% align=center>
	<tr>
		<td>
			<table align=\"center\" width=\"70%\" class=\"tabella\" >
				<tr>
					<td style=\" background-color: #ff5656; border: solid 1px black;\">
						<h2 align=\"center\" style=\"color: white\">Concertti</h2>
					</td>
				</tr>

				<tr>
				<td align=\"center\">	
";

			    			for($i=0;$i<$nEventi;$i++)
							{

								echo"	
										<details>
										<summary>".$cittaLocale[$i]." ".$dataConcerto[$i]."</summary>
										<div>Ora di inizio: ".$oraConcerto[$i]."</div>
										<div>Locale: ".$nomeLocale[$i]."</div>
										<div>Compenso pattuito: ".$compensoPattuitoConcerto[$i]."</div>
										<div>Compenso effettivo ricevuto: ".$compensoEffettivoConcerto[$i]."</div>
										</details><br>
										";
							}



							echo" </td></tr></table></td><td>
							<table align=\"center\" width=\"30%\" class=\"tabella\" >
								<tr>
									<td style=\" background-color: #ff5656; border: solid 1px black;\">
										<h2 align=\"center\" style=\"color: white\">Filtra</h2>
									</td>
								</tr>
								<tr>
									<td align=center>

							Ordina per guadagno:<br> ";
							echo"<select name=\"ordinamento\">
									  <option value=\"casuale\">-casuale-</option>
							 		  <option value=\"crescente\">Crescente</option>
									  <option value=\"decrescente\">Decrescente</option>
								</select>
									 <br><input type=\"submit\" name=\"button\" value=\"ricerca\"></form></td></tr></table>";
					
			    			






























			    			}

			    			if($ordinamento == "decrescente")
			    			{
			    				$sql3 = "SELECT rlocale.Nome, rlocale.Citta, rconcerto.Data, rconcerto.Ora, rconcerto.CompensoPattuito, rconcerto.CompensoEffettivo FROM rconcerto INNER JOIN rlocale ON rconcerto.ID_Locale = rlocale.ID WHERE rconcerto.CompensoEffettivo!='0' ORDER BY CompensoEffettivo DESC";

							$result = mysqli_query($conn, $sql3);

							if(mysqli_num_rows($result) > 0 )
							{
								$nEventi = mysqli_num_rows($result);
								$nomeLocale[] = '';
								$cittaLocale[] = '';
								$dataConcerto[] = '';
								$oraConcerto[] = '';
								$compensoPattuitoConcerto[] = '';
								$compensoEffettivoConcerto[] = '';
								for($i = 0;$row = mysqli_fetch_assoc($result); $i++)
								{
									$nomeLocale[$i] = $row["Nome"];
									$cittaLocale[$i] = $row["Citta"];
									$dataConcerto[$i] = $row["Data"];
									$oraConcerto[$i] = $row["Ora"];
									$compensoPattuitoConcerto[$i] = $row["CompensoPattuito"];
									$compensoEffettivoConcerto[$i] = $row["CompensoEffettivo"];
								}
							}
							else
							{
							echo "0 results";
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
		<link rel=\"stylesheet\" href=\"https://www.w3schools.com/w3css/4/w3.css\">

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
						Storico
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











<br><br><br>



<form action=\"storico.php\" method=\"POST\">
<table width=100% align=center>
	<tr>
		<td>
			<table align=\"center\" width=\"70%\" class=\"tabella\" >
				<tr>
					<td style=\" background-color: #ff5656; border: solid 1px black;\">
						<h2 align=\"center\" style=\"color: white\">Concertti</h2>
					</td>
				</tr>

				<tr>
				<td align=\"center\">	
";










			    	
			    			for($i=0;$i<$nEventi;$i++)
							{
								echo"	
										<details>
										<summary>".$cittaLocale[$i]." ".$dataConcerto[$i]."</summary>
										<div>Ora di inizio: ".$oraConcerto[$i]."</div>
										<div>Locale: ".$nomeLocale[$i]."</div>
										<div>Compenso pattuito: ".$compensoPattuitoConcerto[$i]."</div>
										<div>Compenso effettivo ricevuto: ".$compensoEffettivoConcerto[$i]."</div>
										</details><br>
										";
							}



							echo" </td></tr></table></td><td>
							<table align=\"center\" width=\"30%\" class=\"tabella\" >
								<tr>
									<td style=\" background-color: #ff5656; border: solid 1px black;\">
										<h2 align=\"center\" style=\"color: white\">Filtra</h2>
									</td>
								</tr>
								<tr>
									<td align=center>

							Ordina per guadagno:<br> ";
							echo"<select name=\"ordinamento\">
									  <option value=\"casuale\">-casuale-</option>
							 		  <option value=\"crescente\">Crescente</option>
									  <option value=\"decrescente\">Decrescente</option>
								</select>
									  <br><input type=\"submit\" name=\"button\" value=\"ricerca\"></form></td></tr></table>";
			    			}

			    			if($ordinamento=="casuale")
			    			{
			    				header("location: storico.php");
			    			}
			


























	
		}
	}
	
}
else
{
	header("location: index.php");
}

?>

