<?php

session_start();



if(isset($_SESSION['username']))
{
		$servername = "127.0.0.1";
		$username = "admin";
		$password = "admin";
		$dbname = "band";

		$conn = mysqli_connect($servername, $username, $password, $dbname);

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
			"<html>
			<head>
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
			</head>
			</html>";
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