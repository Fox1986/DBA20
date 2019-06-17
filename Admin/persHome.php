<?php
	session_start();																							/* Session starten / übernehmen */
	include ('datenbank.php');																					/* Datenbankverbindung hinzufügen */
?>



<!DOCTYPE html>
<html>
	<head>
		<title>Home</title>
		<script src="http://code.jquery.com/jquery-latest.js"> </script>
		<script type="text/javascript">
			window.onload = startInterval;
			function startInterval()
			{
				setInterval("startTime();", 10000);
			}
			function startTime()
			{
				$('#hauptinfo').load("userStatus.php");
				$('#zusatzinfo').load("openchats.php");
			}
		</script>
    	
		<link rel="stylesheet" type="text/css" href="persHome.css">										<!-- home.css ist für das Styling der Seite zuständig -->
	</head>
	<body>
		
		<div id="main">																							<!-- Bereich für das eigene Profil -->
			<h1><?php echo strtoupper($_SESSION['login_user']) ?></h1>
			
			<div id = "hauptinfo">														<!-- Bereich für die Profildaten die als Minimum gesetzt sein müssen -->
				<?php
					include('userStatus.php');
				?>
			</div>
			
			
			<div id = "zusatzinfo">	
				<?php
					include('openchats.php');
				?>
			</div>

			<div id="steuerung">																	<!-- Bereich für die möglichen Chatpartner -->
				<form action="persLogout.php">												<!-- Logout-Button erstellen. Dafür wird das Skript logout.php genutzt -->
					<input type="submit" value="Logout">
				</form>
				<br>
				
			</div>
			
			
		</div>
		<?php
			$conn->close();																		/* Datenbankverbindung schließen */
		?>
		
	</body>
</html>