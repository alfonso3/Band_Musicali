<html>
<head>
	<title>Benvenuto su DprBand!</title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
	<br>
		<center>
		<img src="Images/Logo.png">
	</center>
	<table align="center">
		<tr>
			<td>
	<?php
		session_start();
		if(!isset($_SESSION["username"])){
			echo "	<form name=login action=login.php method=post  >
					<p align=\"center\">
					<br>
					<br>
					<input name=username class=\"w3-input\" width=20% type=text placeholder=username required>
					<br>
					<br>
					<input name=password class=\"w3-input\" width=20% type=password placeholder=password required>
					<br>
					<br>
					<input name=btnLogin class=\"w3-btn w3-white w3-border w3-border-red w3-round-large\" type=submit>
					</p>
				</form>";
		}
		else{
			echo "<script type=\"text/javascript\">window.location.href=\"dashboard.php\";</script>";
		}
	?>
			</td>
		</tr>
	</table>



</body>
</html>