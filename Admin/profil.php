<!-- Diese Seite dient dem Admin als Übersicht über das Profil einzelner User -->

<?php
	session_start();																		/* Session starten / übernehmen */
	include ('datenbank.php');																/* Datenbankverbindung hinzufügen */
?>

<!DOCTYPE html>																				<!-- Beginn der HTML Seite -->
<html>
	<head>
		<title>UserProfil</title>															<!-- Titel festlegen -->
		<link rel="stylesheet" type="text/css" href="profil.css">							<!-- profil.css ist für das Styling der Seite zuständig -->
	</head>
	<body>
		
		<div id="main">																		<!-- Bereich für das eigene Profil -->
			<h1><?php echo $_POST['profil']; ?></h1>
			<form name = "update" action="pwReset.php" method="post" enctype="multipart/form-data">		<!-- Passwortreset an pwReset.php weiterleiten -->
																										<!-- Enctype ist wichtig für das Profilbild -->
			<div id = "hauptinfo">																		<!-- Bereich für die wichtigen Profildaten -->
				<?php
					$person = $_POST['profil'];											/* Nickname in Variable speichern */
					$sql = "SELECT Nickname, Email, Passwort, Geschlecht FROM User WHERE Nickname = '$person'";	/* SQL-Abfrage nach den Accountdaten */
					$data = $conn->query($sql);											/* Befehl ausführen */
					$haupt = $data->fetch_assoc();										/* Daten in einem Array speichern. Index ist Spaltenname der Datenbanktabelle */
					if ($data->num_rows > 0)
					{
						echo "<table>";													/* Tabelle mit den aktuellen Werten, die vorhanden sein müssen */
							echo "<tr>";
								echo "<th>Nickname </th>";
								echo "<th>" .$haupt['Nickname']. "</th>";			
							echo "</tr>";
							
							echo "<tr>";
								echo "<th>Email </th>";
								echo "<th>" .$haupt['Email']."</th>";
							echo "</tr>";

							echo "<tr>";												/* Der Admin hat nur Zugriff auf das Passwort */
								echo "<th>Passwort </th>";								/* Die User haben den exklusiven Änderungszugriff */						
								echo "<th> <input type = 'password' name = 'pass1' class = 'box' value =" .$haupt['Passwort']."><br> </th>";
							echo "</tr>";

							echo "<tr>";
								echo "<th>Passwort wiederholen </th>";
								echo "<th> <input type = 'password' name = 'pass2' class = 'box' value =" .$haupt['Passwort']."><br> </th>";
							echo "</tr>";

						echo "</table>";

					}
					$datei = "../Avatar/".$_SESSION['login_user'].".png";									/* Variable für das User-Bild */
					
					if (file_exists($datei))																/* Test ob User Bild hochgeladen hat */
					{
						echo " <img src='$datei' alt='Avatar' class='avatar'> <br>";						/* Bild darstellen */
					}else{																					/* Wenn kein Bild vorhanden, dann Default-Bild nutzen */
						if ($haupt['Geschlecht'] == "m")													/* Geschlechtsabhängiges Default-Profilbild */
						{
							echo " <img src='../Avatar/avatarMD.png' alt='Avatar' class='avatar'> <br>";	/* männlich */
						}else
						{
							echo " <img src='../Avatar/avatarWD.png' alt='Avatar' class='avatar'> <br>";	/* weiblich */
						}
					}
					
				?>
				
			</div>
			
			
			<div id = "zusatzinfo">																		<!-- Bereich für die optionalen Profildaten -->
				<?php 
					$person = $_POST['profil'];
					$sql = "SELECT Vorname, Nachname, Strasse, Hausnummer, Plz, Wohnort, Handynummer, Public FROM User WHERE Nickname = '$person'";						
					$data = $conn->query($sql);
					$zusatz = $data->fetch_assoc();
					if ($data->num_rows > 0)
					{
						echo "<table>";																	/* Tabelle mit den Daten, die optional sind */
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
								if ($zusatz['Public'] == 0)											/* Ausgabe ob User seine Daten öffentlich geschaltet hat */
								{																	
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
			<input type = "submit" value = "Passwort zurücksetzen" name="submit"><br> 				<!-- Button um ein Passwortreset durchzuführen-->
			</form>
		</div>
		<div id="steuerung">																		<!-- Bereich für zusätzliche Steuerelemente -->
			<form action = "persHome.php">														
				<input type="submit" value="Zurück" >												<!-- Button um zu persHome.php zurückzukehren -->
			</form>
			<br>
			<form method="post" action="nutzerLöschen.php">											
				<input type="hidden" name="kill" value="<?php echo $person; ?>">
				<input type="submit" value="Profil löschen">										<!-- Button um das Nutzerprofil zu löschen -->
			</form>	
		</div>

		
		<?php
			$conn->close();																			/* Datenbankverbindung schließen */
		?>
		
	</body>
</html>