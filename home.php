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
				setInterval("startTime();", 7000);
			}
			function startTime()
			{
				$('#einladen').load("status.php");
				$('#beitreten').load("openchats.php");
			}
		</script>
    	
		<link rel="stylesheet" type="text/css" href="home.css">													<!-- home.css ist für das Styling der Seite zuständig -->
	</head>
	<body>
		
		<div id="main">																							<!-- Bereich für das eigene Profil -->
			<h1><?php echo strtoupper($_SESSION['login_user']) ?></h1>
			<form name = "update" action="update.php" method="post" enctype="multipart/form-data">
			<div id = "hauptinfo">																				<!-- Bereich für die Profildaten die als Minimum gesetzt sein müssen -->
				<?php
					$person = $_SESSION['login_user'];
					$sql = "SELECT Nickname, Email, Passwort, Geschlecht FROM User WHERE Nickname = '$person'";						
					$data = $db->query($sql);
					$haupt = $data->fetch(PDO::FETCH_ASSOC);
					if ($data->rowCount() > 0)
					{
						echo "<table>";																			/* Tabelle mit den aktuellen Werten, die vorhanden sein müssen */
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
				<input type='file' name='Bild'>																	<!-- Auswahl eines Profilbildes -->
			</div>
			
			
			<div id = "zusatzinfo">																				<!-- Bereich für die optinalen Profildaten -->
				<?php 
					$person = $_SESSION['login_user'];
					$sql = "SELECT Vorname, Nachname, Strasse, Hausnummer, Plz, Wohnort, Handynummer, Public FROM User WHERE Nickname = '$person'";						
					$data = $db->query($sql);
					$zusatz = $data->fetch(PDO::FETCH_ASSOC);
					if ($data->rowCount() > 0)
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
						if ($zusatz['Public'] == 0)															/* Auswahl ob anderen Nutzern die optionalen Daten angezeigt werden sollen */
						{																					/* Vorher wird geprüft ob schonmal eine Wahl getroffen wurde, entsprechend 																							wird die Checkbox angezeigt */
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
		

		<div id="interaktion" style="height: 610px;	background-color:  #28a745;	margin-top: 70px;	margin-left: 4px;float: left;	width: 15%;font-size: 18px;">
			<div id="einladen" style="height: 300px; background-color: #28a745; width: 100%; margin-left: 10px;font-size: 18px; ">																		<!-- Bereich für die möglichen Chatpartner -->
				
															<!-- Auswahlliste Liste erstellen -->
					<?php
						include('status.php')
					?>
					
					
			</div>

			<div id="beitreten" style="height: 150px; background-color: #28a745; width: 100%; margin-left: 10px; margin-top: 70px; font-size: 18px;">																	
				
					<?php 
						include('openchats.php') 
					?>
					
					
			</div>


			
		</div>
		<div id="steuerung">																	<!-- Bereich für die möglichen Chatpartner -->
				<form action="logout.php">															<!-- Logout-Button erstellen. Dafür wird das Skript logout.php genutzt -->
					<input type="submit" value="Logout">
				</form>
				<br>
				<form method="post" action="löschen.php">											<!-- Einladen eines Chatpartners mittels Button ermöglichen -->
					
					<input type="submit" value="Profil löschen">									<!-- Einladebutton, der auf das Skript einladen.php weiterleitet -->
				</form>	
		</div>
		<?php
			$db=null;																		/* Datenbankverbindung schließen */
		?>
		
	</body>
</html>