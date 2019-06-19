<!-- Diese Seite dient dem Admin als Übersicht über alle User und offenen Chats -->
<?php
	session_start();														/* Session starten / übernehmen */
?>

<!DOCTYPE html>																<!-- Beginn der HTML Seite -->
<html>
	<head>
		<title>Home</title>													<!-- Titel festlegen -->
		<script src="http://code.jquery.com/jquery-latest.js"> </script>	<!-- JQuery einbinden, da für Auto-Refresh benötigt wird -->
		<script type="text/javascript">										/* Bereich für Javascript Funktionen */
			window.onload = startInterval;									/* Wenn Fenster geladen wurde, starte Funktion startInterval */
			function startInterval()										/* Funktion um Intervall für den Auto-Refresh des Verlaufs festzulegen */
			{
				setInterval("startTime();", 10000);							/* Alle 10 Sekungen die Funktion startTime aufrufen */
			}
			function startTime()											/* Funktion die den eigentlich Auto-Refresh der Bereiche vornimmt */
			{
				$('#Nutzer').load("userStatus.php");						/* JQuery-Funktion um im Bereich hauptinfo userStatus.php immer neu zu laden */
				$('#Chats').load("openchats.php");							/* JQuery-Funktion um im Bereich zusatzinfo openchats.php immer neu zu laden */
			}
		</script>
    	
		<link rel="stylesheet" type="text/css" href="persHome.css">			<!-- home.css ist für das Styling der Seite zuständig -->
	</head>
	<body>
		
		<div id="main">																							
			<h1><?php echo strtoupper($_SESSION['login_user']) ?></h1>		<!-- Rolle des Mitarbeiters als Überschrift im Fenster -->
			
			<div id = "Nutzer">												<!-- Dieser Bereich zeigt alle User und deren Status -->
				<?php
					include('userStatus.php');								/* Skript das die Registrierten Nutzer auflistet und deren aktuellen Status */
				?>															<!-- wird ständig neu geladen und so aktualisiert -->
			</div>
						
			<div id = "Chats">												<!-- Dieser Bereich zeigt alle offenen Chats und deren Status -->
				<?php
					include('openchats.php');								/* Skript das alle derzeit geführten Chats zeigt  */
				?>															<!-- wird ständig neu geladen und so aktualisiert -->
			</div>

			<div id="steuerung">											<!-- Bereich für zusätzliche Steuerungsoptionen -->
				<form action="persLogout.php">								<!-- Logout-Button erstellen. Dafür wird das Skript logout.php genutzt -->
					<input type="submit" value="Logout">
				</form>
				<br>
			</div>
		</div>
	</body>
</html>