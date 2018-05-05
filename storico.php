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
		echo $_SESSION["ordine"];
					if(!isset($_SESSION['ordine']))
						{
							//recupera dati eventi passati
							$sql1 = "SELECT rlocale.Nome, rlocale.Citta, rconcerto.Data, rconcerto.Ora, rconcerto.CompensoPattuito, rconcerto.CompensoEffettivo FROM rconcerto INNER JOIN rlocale ON rconcerto.ID_Locale = rlocale.ID WHERE rconcerto.CompensoEffettivo!='NULL'";

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


							for($i=0;$i<$nEventi;$i++)
							{
								echo"<details>
										<summary>".$cittaLocale[$i]." ".$dataConcerto[$i]."</summary>
										<div>Ora di inizio: ".$oraConcerto[$i]."</div>
										<div>Locale: ".$nomeLocale[$i]."</div>
										<div>Compenso pattuito: ".$compensoPattuitoConcerto[$i]."</div>
										<div>Compenso effettivo ricevuto: ".$compensoEffettivoConcerto[$i]."</div>
									</details>";
							}



							echo"Ordina per guadagno: ";
							echo"<select name=\"ordinamento\" id=\"ordinamento\" onChange=\"ordinamentoEventi()\">
									  <option value=\"\"></option>
							 		  <option value=\"crescente\">Crescente</option>
									  <option value=\"decrescente\">Decrescente</option>
								</select>";
			    		}
			    		else
			    		{
			    			if($_SESSION["ordine"] == "crescente")
			    			{
			    					//echo"crescenteeee";

			    					//malfunzionamento
			    			}

			    			if($_SESSION["ordine"] == "decrescente")
			    			{
			    					//echo"decrescenteeeee";
			    			}	
			    		}
		    
	}
}
else
{
	header("location: index.php");
}

	echo"<script>

		function ordinamentoEventi()
		{
			var scelta=document.getElementById(\"ordinamento\").value;

			if(scelta == \"crescente\")
			{
				"; $_SESSION["ordine"] = 'crescente';
					//scelta viene valorizzato correttamente ed entra nell'if
				echo"
				window.location.href = 'storico.php';
				

			}
			
			if(scelta == \"decrescente\")
			{
				"; $_SESSION["ordine"] = 'decrescente';
					//scelta viene valorizzato correttamente ed entra nell'if
				echo"
				window.location.href = 'storico.php';
				
			}
			
		}

		</script>";




?>