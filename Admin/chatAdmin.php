<!-- Dieses Skript stellt den Chat des Admins dar -->

<?php
	session_start();												/* Session einbinden */
	include 'datenbank.php';										/* Datenbank einbinden */
?>

<!DOCTYPE html>														<!-- Beginn der HTML Seite -->
<html>
	<head>
		<title>AdminChat</title>									<!-- Titel festlegen -->
		<script src="http://code.jquery.com/jquery-latest.js"> 		/* JQuery einbinden, da für Auto-Refresh benötigt wird */
		</script>
		<script type="text/javascript">								/* Bereich für Javascript Funktionen */
			
			window.onload = startInterval;							/* Wenn Fenster geladen wurde, starte Funktion startInterval */
			
			function startInterval()								/* Funktion um Intervall für den Auto-Refresh des Verlaufs festzulegen */
			{
				setInterval("startTime();", 1000);					/* Sekündlich den Funktion startTime aufrufen */
				scroll();											/* Bei Seitenaufruf direkt nach unten Scrollen, falls möglich */				
			}
			function startTime()									/* Funktion die den eigentlich Auto-Refresh des Chatverlaufs ermöglicht */
			{
			 $('#output').load("chatAdminVerlauf.php"); 			/* JQuery-Funktion um im Bereich output chatAdminVerlauf.php immer neu zu laden */
				scroll();											/* Bei jedem Aufruf nach unten Scrollen */
			}
			
			function scroll()										/* Funktion die das automatische Scrollen an das Chat-Ende ermöglicht */
			{
				var objDiv = document.getElementById("output");		/* ID von output-Bereich in Variable legen */
     			objDiv.scrollTop = objDiv.scrollHeight;				/* Den Bereich in der Variablen immer an das Ende scrollen */
			}
		</script>
		
		<link rel="stylesheet" type="text/css" href="chatAdmin.css"><!-- chatAdmin.css einbinden, die die Style-Parameter festlegt -->
	</head>

	<body>
		<div id="main">
			<h1>Chat</h1>											<!-- Überschrift -->
			<div id="output">
				<?php
					include('chatAdminVerlauf.php');				/* Chatverlauf wird ständig aktualisiert durch ein Auto-Refresh von chatAdminVerlauf.php */
				?>
			</div>
			<form method="post" action="sendAdmin.php">				<!-- Daten werden an sendAdmin.php weitergeleitet -->
			<textarea name="nachricht" placeholder="Tippen um Nachricht zu senden..." class="form-control"></textarea><br> 	<!-- Nachrichtenbereich -->
			<input style="font-size: 20px;" type="submit" value="Abschicken" onsubmit="return room()">						<!-- Button zum senden der Nachricht -->
			</form>
			<br>
				
		</div>
		<div id = "chatpartner">															<!-- Bereich für die beteiligten Personen -->
			<div id="host">																	<!-- Bereich für das Profil des Chatpartners -->
				<?php 
					$partner = "SELECT * FROM Rooms";										/* SQL-Abfrage für die Daten des Chatraums*/
					foreach ($conn->query($partner) as $zeile)								/* Alle Daten durchsuchen */
					{
							$host = $zeile['Host'];											/* Den Host finden */
					}
					
					echo "<h1>HOST</h1>";													/* Bereich für die Daten des Hosts */
			
					$sql="SELECT * FROM User WHERE Nickname = '$host'";						/* SQL-Abfrage für die Daten des Hosts */
					$result = $conn->query($sql);											/* Befehl ausführen */
					if ($result->num_rows > 0){												/* Testen ob Daten vorhanden */
						while($row = $result->fetch_assoc()){								/* Alle Daten durchlaufen */
							$datei = "../Avatar/".$host.".png";								/* Variable für das User-Bild */
					
							if (file_exists($datei))										/* Test ob User Bild hochgeladen hat */
							{
								echo " <img src='$datei' alt='Avatar' class='avatar'> <br>";
							}else{															/* Wenn NEIN, dann Default-Bild nutzen */
								if ($row['Geschlecht'] == "m")								/* Geschlechtsabhängiges Default-Profilbild */
								{
									echo " <img src='../Avatar/avatarMD.png' alt='Avatar' class='avatar'> <br>";
								}else
								{
									echo " <img src='../Avatar/avatarWD.png' alt='Avatar' class='avatar'> <br>";
								}
							}
							
							echo "<br>";
							
							echo "".$row['Vorname']."<br>";									/* Persönliche Daten werden dem Admin gezeigt, auch wenn diese */
							echo "".$row['Nachname']."<br>";								/* nicht als öffentlich markiert wurden */
							echo "".$row['Email']."<br>";
							echo "".$row['Strasse']. " " .$row['Hausnummer']."<br>";
							echo "".$row['Plz']. " " .$row['Wohnort']. "<br>";
							
						}
					}
					?>
			</div>
			<br>
			<div id="guests">																<!-- Gleicher Bereich für den Guest, wie für den Host -->
				<?php 
					$partner = "SELECT * FROM Rooms";
					foreach ($conn->query($partner) as $zeile)
					{
							$guest = $zeile['Guest'];
					}
										
					echo "<h1>GUEST</h1>";

					$sql="SELECT * FROM User WHERE Nickname = '$guest'";
					$result = $conn->query($sql);
					if ($result->num_rows > 0){
						while($row = $result->fetch_assoc()){
							$datei = "../Avatar/".$guest.".png";										
					
							if (file_exists($datei))																
							{
								echo " <img src='$datei' alt='Avatar' class='avatar'> <br>";
							}else{																					
								if ($row['Geschlecht'] == "m")														
								{
									echo " <img src='../Avatar/avatarMD.png' alt='Avatar' class='avatar'> <br>";
								}else
								{
									echo " <img src='../Avatar/avatarWD.png' alt='Avatar' class='avatar'> <br>";
								}
							}
							
							echo "<br>";
							
							echo "".$row['Vorname']."<br>";
							echo "".$row['Nachname']."<br>";
							echo "".$row['Email']."<br>";
							echo "".$row['Strasse']. " " .$row['Hausnummer']."<br>";
							echo "".$row['Plz']. " " .$row['Wohnort']. "<br>";
							
						}
					}
				?>
			</div>
		</div>	
		<div id="steuerung">																	<!-- Bereich für zusätzliche Steuereinheiten -->
			<form action = "persHome.php">														
				<input type="submit" value="Zurück" >											<!-- Button für das Verlassen des Chats -->
			</form>
		</div>
		
		<?php 
			$conn->close(); 																		/* Datenbankverbindung schließen */
		?>																
	</body>
</html>
