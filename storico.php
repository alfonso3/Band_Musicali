<?php
session_start();

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

							echo"Eventi in ordine casuale";

							for($i=0;$i<$nEventi;$i++)
							{
								
								echo"	<form action=\"storico.php\" method=\"POST\">
										<details>
										<summary>".$cittaLocale[$i]." ".$dataConcerto[$i]."</summary>
										<div>Ora di inizio: ".$oraConcerto[$i]."</div>
										<div>Locale: ".$nomeLocale[$i]."</div>
										<div>Compenso pattuito: ".$compensoPattuitoConcerto[$i]."</div>
										<div>Compenso effettivo ricevuto: ".$compensoEffettivoConcerto[$i]."</div>
										</details>
										";
							}



							echo"Ordina per guadagno: ";
							echo"<select name=\"ordinamento\">
									  <option value=\"casuale\">-casuale-</option>
							 		  <option value=\"crescente\">Crescente</option>
									  <option value=\"decrescente\">Decrescente</option>
								</select>
									  <input type=\"submit\" name=\"button\" value=\"ricerca\"></form>";
					
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
			    			
							echo"Eventi in ordine di guadagno crescente";

			    			for($i=0;$i<$nEventi;$i++)
							{

								echo"	<form action=\"storico.php\" method=\"POST\">
										<details>
										<summary>".$cittaLocale[$i]." ".$dataConcerto[$i]."</summary>
										<div>Ora di inizio: ".$oraConcerto[$i]."</div>
										<div>Locale: ".$nomeLocale[$i]."</div>
										<div>Compenso pattuito: ".$compensoPattuitoConcerto[$i]."</div>
										<div>Compenso effettivo ricevuto: ".$compensoEffettivoConcerto[$i]."</div>
										</details>
										";
							}



							echo"Ordina per guadagno: ";
							echo"<select name=\"ordinamento\">
									  <option value=\"casuale\">-casuale-</option>
							 		  <option value=\"crescente\">Crescente</option>
									  <option value=\"decrescente\">Decrescente</option>
								</select>
									  <input type=\"submit\" name=\"button\" value=\"ricerca\"></form>";
					
			    			
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

							echo"Eventi in ordine di guadagno decrescente";
			    			
			    			for($i=0;$i<$nEventi;$i++)
							{
								echo"	<form action=\"storico.php\" method=\"POST\">
										<details>
										<summary>".$cittaLocale[$i]." ".$dataConcerto[$i]."</summary>
										<div>Ora di inizio: ".$oraConcerto[$i]."</div>
										<div>Locale: ".$nomeLocale[$i]."</div>
										<div>Compenso pattuito: ".$compensoPattuitoConcerto[$i]."</div>
										<div>Compenso effettivo ricevuto: ".$compensoEffettivoConcerto[$i]."</div>
										</details>
										";
							}



							echo"Ordina per guadagno: ";
							echo"<select name=\"ordinamento\">
									  <option value=\"casuale\">-casuale-</option>
							 		  <option value=\"crescente\">Crescente</option>
									  <option value=\"decrescente\">Decrescente</option>
								</select>
									  <input type=\"submit\" name=\"button\" value=\"ricerca\"></form>";
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

