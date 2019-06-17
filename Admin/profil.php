<?php
	session_start();																							/* Session starten / übernehmen */
	include ('datenbank.php');																					/* Datenbankverbindung hinzufügen */

?>



<!DOCTYPE html>
<html>
	<head>
		<title>UserProfil</title>
		<!--<meta http-equiv="refresh" content="10">-->
		
    	
		<link rel="stylesheet" type="text/css" href="profil.css">													<!-- home.css ist für das Styling der Seite zuständig -->
	</head>
	<body>
		
		<div id="main">																							<!-- Bereich für das eigene Profil -->
			<h1><?php echo $_POST['profil']; ?></h1>
			<form name = "update" action="pwReset.php" method="post" enctype="multipart/form-data">
			<div id = "hauptinfo">																				<!-- Bereich für die Profildaten die als Minimum gesetzt sein müssen -->
				<?php
					$person = $_POST['profil'];
					$sql = "SELECT Nickname, Email, Passwort, Geschlecht FROM User WHERE Nickname = '$person'";						
					$data = $conn->query($sql);
					$haupt = $data->fetch_assoc();
					if ($data->num_rows > 0)
					{
						echo "<table>";																			/* Tabelle mit den aktuellen Werten, die vorhanden sein müssen */
							echo "<tr>";
								echo "<th>Nickname </th>";
								echo "<th>" .$haupt['Nickname']. "</th>";
							echo "</tr>";
							
							echo "<tr>";
								echo "<th>Email </th>";
								echo "<th>" .$haupt['Email']."</th>";
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
						echo " <img src='$datei' alt='Avatar' class='avatar'> <br>";
					}else{																						/* Wenn NEIN, dann Default-Bild nutzen */
						if ($haupt['Geschlecht'] == "m")														/* Geschlechtsabhängiges Default-Profilbild */
						{
							echo " <img src='Avatar/avatarMD.png' alt='Avatar' class='avatar'> <br>";
						}else
						{
							echo " <img src='Avatar/avatarWD.png' alt='Avatar' class='avatar'> <br>";
						}
					}
					
				?>
				
			</div>
			
			
			<div id = "zusatzinfo">																				<!-- Bereich für die optinalen Profildaten -->
				<?php 
					$person = $_POST['profil'];
					$sql = "SELECT Vorname, Nachname, Strasse, Hausnummer, Plz, Wohnort, Handynummer, Public FROM User WHERE Nickname = '$person'";						
					$data = $conn->query($sql);
					$zusatz = $data->fetch_assoc();
					if ($data->num_rows > 0)
					{
						echo "<table>";																			/* Tabelle mit den Daten, die optional sind */
							echo "<tr>";
								echo "<th>Vorname </th>";
								echo "<th>".$zusatz['Vorname']."</th>";
							echo "</tr>";
							
							echo "<tr>";
								echo "<th>Nachname </th>";
								echo "<th>" .$zusatz['Nachname']." </th>";
							echo "</tr>";

							echo "<tr>";
								echo "<th>Straße </th>";
								echo "<th> " .$zusatz['Strasse']." </th>";
							echo "</tr>";

							echo "<tr>";
								echo "<th>Hausnummer </th>";
								echo "<th>" .$zusatz['Hausnummer']." </th>";
							echo "</tr>";

							echo "<tr>";
								echo "<th>PLZ </th>";
								echo "<th> " .$zusatz['Plz']."</th>";
							echo "</tr>";

							echo "<tr>";
								echo "<th>Ort </th>";
								echo "<th>" .$zusatz['Wohnort']." </th>";
							echo "</tr>";

							echo "<tr>";
								echo "<th>Handynummer </th>";
								echo "<th> ".$zusatz['Handynummer']." </th>";
							echo "</tr>";
							echo "<tr>";
								echo "<th>Öffentlich </th>";
								if ($zusatz['Public'] == 0)															/* Auswahl ob anderen Nutzern die optionalen Daten angezeigt werden sollen */
								{																					/* Vorher wird geprüft ob schonmal eine Wahl getroffen wurde, entsprechend 																							wird die Checkbox angezeigt */
									echo "<th> NEIN </th>";
								}else
								{
									echo "<th> JA </th>";
								}
							echo "</tr>";
						echo "</table>";		
					}	
				
					echo "</div>";
					echo "<input type='hidden' name='profil' value='$person'>";
				?>
			<input type = "submit" value = "Passwort zurücksetzen" name="submit"><br> 					<!-- Button um die Änderungen durchzuführen -->
			</form>
		</div>
		<div id="steuerung">																	<!-- Bereich für die möglichen Chatpartner -->
				<button onclick="window.close();" >Zurück</button>
				<br>
				<form method="post" action="löschen.php">											<!-- Einladen eines Chatpartners mittels Button ermöglichen -->
					<input type="hidden" name="kill" value="<?php $person ?>">
					<input type="submit" value="Profil löschen">									<!-- Einladebutton, der auf das Skript einladen.php weiterleitet -->
				</form>	
		</div>

		
		<?php
			$conn->close();																		/* Datenbankverbindung schließen */
		?>
		
	</body>
</html>