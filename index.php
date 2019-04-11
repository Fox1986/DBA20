<!DOCTYPE html>
<html>
<head>
	<title>Webchat</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="main">
		<div id="info">
			<h2>Anmelden:</h2>

			<form action="login.php" method="post">
			<label><b>Nutzername:</b></label>
			<input type="text" name="nutzerkennung" placeholder="User name"><br><br>
			<label><b>Passwort:</b></label>
			<input type="text" name="kennwort" placeholder="Password"><br><br>
			<button style="background-color: #6495ed; color: white" type="submit">
				<b>Abschicken</b>
			</button>
			</form>

			
			<form action="registrieren.php", method="post">
			<h2>Wenn Sie keinen Account haben, Registrieren sich sie bitte hier:</h2>
			<label>Nutzername:</label>
			<input type="text" name="uname", placeholder="Username"><br>
			<br>
			<label>E-Mail:</label>
			<input type="text" name="email", placeholder="Email"><br>
			<br>
			<label>Passwort:</label>
			<input type="text" name="password", placeholder="Password"><br>
			<br>
			<button style="background-color: #6495ed; color: white" type="submit">
			<b>Registrieren</b>
			</button>
			</form>

		</div>

	</div>

</body>
</html>