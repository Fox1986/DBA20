<!-- Diese Seite stellt das Chatfenster dar -->

<?php
	
	session_start();														/* Session starten */
	
	include ('classChat.php');												/* Klasse classChat einbinden */

	$chat = new Chat();														/* Neues Objekt der Klasse Chat erstellen */												
?>	

<!DOCTYPE html>																<!-- Beginn der HTML Seite -->
<html>
	<head>
		<title>ChatRoom</title>												<!-- Titel festlegen -->
		<link rel="stylesheet" type="text/css" href="chat.css">				<!-- Chat.css einbinden, die die Style-Parameter festlegt -->
		<script src="http://code.jquery.com/jquery-latest.js"> </script>	<!-- JQuery einbinden, da für Auto-Refresh benötigt wird -->
		<script type="text/javascript">										/* Bereich für Javascript Funktionen */								
			window.onload = startInterval;									/* Wenn Fenster geladen wurde, starte Funktion startInterval */
			
			function startInterval()										/* Funktion um Intervall für den Auto-Refresh des Verlaufs festzulegen */
			{
				setInterval("startTime();", 1000);							/* Sekündlich den Funktion startTime aufrufen */
				scroll();													/* Bei Seitenaufruf direkt nach unten Scrollen, falls möglich */
			}
			function startTime()											/* Funktion die den eigentlich Auto-Refresh des Chatverlaufs ermöglicht */
			{
			 $('#output').load("verlauf.php"); 								/* JQuery-Funktion um im Bereich output verlauf.php immer neu zu laden */
				scroll();													/* Bei jedem Aufruf nach unten Scrollen */
			}
			
			function scroll()												/* Funktion die das automatische Scrollen an das Chat-Ende ermöglicht */
			{
				var objDiv = document.getElementById("output");				/* ID von output-Bereich in Variable legen */
     			objDiv.scrollTop = objDiv.scrollHeight;						/* Den Bereich in der Variablen immer an das Ende scrollen */
			}
		
		</script>
		
	</head>
	
	<body>
	<?php
		$chat -> ausgabeVerlauf();											/* Funktion von classChat.php, die den Hauptbereich mit Nachrichteneingabe erstellt */

		echo '<div id = "chatpartner">';									/* Bereich für die Personen-Informationen und Steuerelemente*/
			$chat -> ausgabeDu();											/* Funktion von classChat.php um Bereich des Chatpartners zu erstellen */

			$chat -> ausgabeIch();											/* Funktion von classChat.php um den Bereich für die eigenen Informationen zu erstellen */
		
			$chat -> ausgabeSteuerung();									/* Funktion von classChat.php um zusätzliche Steuerelemente zu erstellen */

		echo "</div>";
		
	?>
	</body>
</html>

