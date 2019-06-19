<!-- Diese Seite dient der Bearbeitung der eigenen Profildaten, sowie dem Einladen und Beitreten in Chats -->

<?php
	session_start();																				/* Session starten / übernehmen */
	include ('datenbank.php');																		/* Datenbankverbindung hinzufügen */
	$person = $_SESSION['login_user'];																/* Eigenen Nichname in Variable speichern */
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Home</title>																			<!-- Titel festlegen -->
		
		<script src="http://code.jquery.com/jquery-latest.js"> </script>							<!-- JQuery einbinden für weitere Funktionen -->
		<script type="text/javascript">
			window.onload = startInterval;															/* Funktionsaufruf, wenn Seite geladen wurde */
			function startInterval()																/* Intervallzeit aufbauen */
			{
				setInterval("startTime();", 7000);													/* Funktionsaufruf und 7 Sekunden als Intervall festlegen */
			}
			function startTime()																	/* Funktion die im Intervall aufgerufen wird */
			{
				$('#einladen').load("status.php");													/* Nutzerstatus aktualisieren */
				$('#beitreten').load("openchats.php");												/* Chateinladungen aktualisieren */
			}
		</script>
    	
		<link rel="stylesheet" type="text/css" href="home.css">										<!-- home.css ist für das Styling der Seite zuständig -->
	</head>
	<body>
		
		<div id="main">																				<!-- Bereich für das eigene Profil -->
			<h1><?php echo strtoupper($_SESSION['login_user']) ?></h1>								<!-- Nickname als Überschrift in Großbuchstaben -->
			<form name = "update" action="update.php" method="post" enctype="multipart/form-data">	<!-- Geänderte Daten an update.php weiterleiten -->
																									<!-- Enctype ist wichtig für das Profilbild -->
			<div id = "hauptinfo">																	<!-- Bereich für die wichtigen Profildaten -->
				<?php
					$sql = "SELECT Nickname, Email, Passwort, Geschlecht FROM User WHERE Nickname = '$person'";	/* SQL-Befehl um Daten zu lesen */						
					$data = $db->query($sql);																	/* Befehl ausführen*/
					$haupt = $data->fetch(PDO::FETCH_ASSOC);													/* Daten in Array laden. Index sind Datenbankspalten */
					if ($data->rowCount() > 0)																	/* Prfüfen ob Daten vorhanden*/
					{
						echo "<table>";																			/* Tabelle erstellen */
							echo "<tr>";
								echo "<th>Nickname </th>";
								echo "<th>" .$haupt['Nickname']. "</th>";
							echo "</tr>";
							
							echo "<tr>";
								echo "<th>Email </th>";
								echo "<th> <input type = 'text' name = 'email' class = 'box' value =" .$haupt['Email']."><br> </th>";
							echo "</tr>";

							echo "<tr>";
								echo "<th>Passwort </th>";
								echo "<th> <input type = 'password' name = 'pass1' class = 'box' value =" .$haupt['Passwort']."><br> </th>";
							echo "</tr>";

							echo "<tr>";
								echo "<th>Passwort wiederholen </th>";
								echo "<th> <input type = 'password' name = 'pass2' class = 'box' value =" .$haupt['Passwort']."><br> </th>";
							echo "</tr>";

						echo "</table>";
					}
					$datei = "Avatar/".$_SESSION['login_user'].".png";											/* Variable für das User-Bild */
					
					if (file_exists($datei))																	/* Test ob User Bild hochgeladen hat */
					{
						echo " <img src='$datei' alt='Avatar' class='avatar'> <br>";							/* Bild darstellen */
					}else{																						/* Wenn NEIN, dann Default-Bild nutzen */
						if ($haupt['Geschlecht'] == "m")														/* Geschlechtsabhängiges Default-Profilbild */
						{
							echo " <img src='Avatar/avatarMD.png' alt='Avatar' class='avatar'> <br>";			/* Bild darstellen */
						}else
						{
							echo " <img src='Avatar/avatarWD.png' alt='Avatar' class='avatar'> <br>";			/* Bild darstellen */
						}
					}
					
				?>
				<input type='file' name='Bild'>																	<!-- Auswahl eines Profilbildes -->
			</div>
			
			<div id = "zusatzinfo">																				<!-- Bereich für die optinalen Profildaten -->
				<?php 
					$sql = "SELECT Vorname, Nachname, Strasse, Hausnummer, Plz, Wohnort, Handynummer, 
					Public FROM User WHERE Nickname = '$person'";												/* SQL-Befehl um Daten zu lesen */					
					$data = $db->query($sql);																	/* Befehl ausführen*/
					$zusatz = $data->fetch(PDO::FETCH_ASSOC);													/* Daten in Array laden. Index sind Datenbankspalten */
					if ($data->rowCount() > 0)																	/* Prfüfen ob Daten vorhanden*/
					{
						echo "<table>";																			/* Tabelle mit den Daten, die optional sind */
							echo "<tr>";
								echo "<th>Vorname </th>";
								echo "<th><input type = 'text' name = 'vname' class = 'box' value =" .$zusatz['Vorname']."><br></th>";
							echo "</tr>";
							
							echo "<tr>";
								echo "<th>Nachname </th>";
								echo "<th> <input type = 'text' name = 'name' class = 'box' value =" .$zusatz['Nachname']."><br> </th>";
							echo "</tr>";

							echo "<tr>";
								echo "<th>Straße </th>";
								echo "<th> <input type = 'text' name = 'str' class = 'box' value =" .$zusatz['Strasse']."><br> </th>";
							echo "</tr>";

							echo "<tr>";
								echo "<th>Hausnummer </th>";
								echo "<th> <input type = 'text' name = 'hausn' class = 'box' value =" .$zusatz['Hausnummer']."><br> </th>";
							echo "</tr>";

							echo "<tr>";
								echo "<th>PLZ </th>";
								echo "<th> <input type = 'text' name = 'plz' class = 'box' value =" .$zusatz['Plz']."><br> </th>";
							echo "</tr>";

							echo "<tr>";
								echo "<th>Ort </th>";
								echo "<th> <input type = 'text' name = 'ort' class = 'box' value =" .$zusatz['Wohnort']."><br> </th>";
							echo "</tr>";

							echo "<tr>";
								echo "<th>Handynummer </th>";
								echo "<th> <input type = 'text' name = 'handy' class = 'box' value =" .$zusatz['Handynummer']."><br> </th>";
							echo "</tr>";

						echo "</table>";
						if ($zusatz['Public'] == 0)													/* Auswahl ob Daten für andere Nutzern sichtbar sein sollen */
						{																			/* Vorher prüfen ob schonmal eine Wahl getroffen wurde*/
																									/* entsprechend wird die Checkbox angezeigt */
							echo "<label>Daten für andere Sichtbar machen?</label><input type='checkbox' name='public' value=1 >";
						}else
						{
							echo "<label>Daten für andere Sichtbar machen?</label><input type='checkbox' name='public' value=1 checked>";
						}
					}	
				?>
			</div>
			<input type = "submit" value = "Änderung speichern" name="submit"><br> 					<!-- Button um die Änderungen durchzuführen -->
			</form>
		</div>
		
		<div id="interaktion" >																		<!-- Bereich für Chataufrufe -->
			<div id="einladen" >																	<!-- Bereich für die möglichen Chatpartner -->
					<?php
						include('status.php')														/* Dieses Skript wird durch Javascript ständig neu geladen */
					?>	
			</div>

			<div id="beitreten">																	<!-- Bereich für Chats in die man eingeladen wird -->						<?php 
						include('openchats.php') 													/* Dieses Skript wird durch Javascript ständig neu geladen */
					?>	
			</div>	
		</div>
		<div id="steuerung">																		<!-- Bereich für allgemeine Buttons -->
				<form action="logout.php">															<!-- Logout-Button. Dafür wird das Skript logout.php genutzt -->
					<input type="submit" value="Logout">
				</form>
				<br>
				<form method="post" action="löschen.php">											<!-- Löschen-Button. Dafür wird das Skript löschen.php genutzt -->
					<input type="submit" value="Profil löschen">									
				</form>	
		</div>
		<?php
			$db=null;																				/* Datenbankverbindung schließen */
		?>
	</body>
</html>