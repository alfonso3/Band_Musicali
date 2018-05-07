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
			echo"
			<form method =\"POST\" action=\"insDirettore.php\">
			<input type=\"text\" name=\"nome\" placeholder=\"nome\" required>
			<input type=\"text\" name=\"cognome\" placeholder=\"cognome\" required>
			<input type=\"text\" name=\"email\" placeholder=\"email\" required>
			<input type=\"text\" name=\"telefono\" placeholder=\"telefono\" required>
			<input type =\"submit\" name=\"button\">
			</form>";

		}
		else
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


		    echo"
			<form method =\"POST\" action=\"insDirettore.php\">
			<input type=\"text\" name=\"nome\" placeholder=\"nome\" required>
			<input type=\"text\" name=\"cognome\" placeholder=\"cognome\" required>
			<input type=\"text\" name=\"email\" placeholder=\"email\" required>
			<input type=\"text\" name=\"telefono\" placeholder=\"telefono\" required>
			<input type =\"submit\" name=\"button\">
			</form>";
		}
	}
}
else
{
	header("location: index.php");
}
?>