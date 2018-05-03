<html>
<head>
	<title>Benvenuto su DprBand!</title>
</head>
<body>
	<?php
		session_start();
		if(!isset($_SESSION["username"])){
			echo "	<form name=login action=login.php method=post>
					<input name=username type=text placeholder=username required>
					<input name=password type=password placeholder=password required>
					<input name=btnLogin type=submit>
				</form>";
		}
		else{
			echo "<script type=\"text/javascript\">window.location.href=\"dashboard.php\";</script>";
		}
	?>
</body>
</html>