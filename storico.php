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
		
					if(!isset($_SESSION['ordine']))
						{
							//recupera dati eventi passati
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
			    			if($_SESSION['ordine'] == "crescente")
			    			{
			    					

			    					
			    			}

			    			if($_SESSION['ordine'] == "decrescente")
			    			{
			    				
			    			}	
			    		}
		    
	}
}
else
{
	header("location: index.php");
}

	


?>

<script>

		function ordinamentoEventi()
		{
			var scelta=document.getElementById('ordinamento').value;

			if(scelta == 'crescente')
			{
				alert("sono nell'if");
				alert(scelta);
				<?php $_SESSION['ordine'] = 'crescente';?>
				window.location.href = 'storico.php';

			}		
			else
			{
				alert("sono nell'else");
				alert(scelta);
				<?php 
				if(!isset($_SESSION['ordine']))
				{
					$_SESSION['ordine'] = 'decrescente'; 
				}				
				?>
				window.location.href = 'storico.php';
			}


		}

</script>