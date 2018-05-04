<?php
	session_start();
	if(!isset($_SESSION['username']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];

	$dbHost = "127.0.0.1";
  	$dbUsername = "admin";
  	$dbPassword = "admin";
  	$dbName = "band";

  	$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
  	if (!$conn) {
    	die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "SELECT Username, Password FROM rcomponente";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result) ) {
	            if($username == $row["Username"] && $password == $row["Password"]){
	            	$_SESSION['username'] = $username;	
	            	$_SESSION['password'] = $password;
	            	$_username = $_SESSION['username'];
	            	$_password = $_SESSION['password'];
	            	echo "<script type=\"text/javascript\">window.location.href=\"dashboard.php\";</script>";
	            }
	    }
	} else {
	    echo "Utente inesistente";
	}
}
else
{
	echo "<script type=\"text/javascript\">window.location.href=\"dashboard.php\";</script>";
}

?>