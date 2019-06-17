<?php
	session_start();
	include 'datenbank.php';

?>

<!DOCTYPE html>
<html>
	<head>
		<title>AdminChat</title>
		<script src="http://code.jquery.com/jquery-latest.js"> 
		</script>
		<script type="text/javascript">
			function close(event)
			{
				window.close();
			}
		</script>
		<script type="text/javascript">
			window.onload = startInterval;
			
			function startInterval()
			{
				setInterval("startTime();", 1000);
				scroll();				
			}
			function startTime()
			{
			 $('#output').load("chatAdminVerlauf.php"); 
				scroll();
			}
			
			function scroll()
			{
				var objDiv = document.getElementById("output");
     			objDiv.scrollTop = objDiv.scrollHeight;
			}
		
		</script>
		<script language="javascript" type="text/javascript">
			function windowClose() 
			{
				window.open('','_parent','');
				window.close();
			}
		</script>
		<link rel="stylesheet" type="text/css" href="chatAdmin.css">
	</head>

	<body>
		<div id="main">
			<h1>Chat</h1>
			<div id="output">
				<?php
					
					include('chatAdminVerlauf.php');
				?>
			</div>
			<form method="post" action="sendAdmin.php">
			<input type="hidden" name="chat" value="<?php echo $tableHost ?>">
			<textarea name="nachricht" placeholder="Tippen um Nachricht zu senden..." class="form-control"></textarea><br>
			<input style="font-size: 20px;" type="submit" value="Abschicken" onsubmit="return room()">
			</form>
			<br>
				
		</div>
		<div id = "chatpartner">																					<!-- Bereich für die beteiligten Personen -->
			<div id="du">																							<!-- Bereich für das Profil des Chatpartners -->
				<?php 
					$partner = "SELECT * FROM Rooms";
					foreach ($db->query($partner) as $zeile)
					{
							$host = $zeile['Host'];
					}
					
					echo "<h1>HOST</h1>";
					echo "<div class='output'>";

					$sql="SELECT * FROM User WHERE Nickname = '$host'";
					$result = $conn->query($sql);
					if ($result->num_rows > 0){
						while($row = $result->fetch_assoc()){
							$datei = "../Avatar/".$host.".png";															/* Variable für das User-Bild */
					
							if (file_exists($datei))																/* Test ob User Bild hochgeladen hat */
							{
								echo " <img src='$datei' alt='Avatar' class='avatar'> <br>";
							}else{																					/* Wenn NEIN, dann Default-Bild nutzen */
								if ($row['Geschlecht'] == "m")														/* Geschlechtsabhängiges Default-Profilbild */
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
					}else{
						echo "0 results";
					}
					
					?>
				</div>
				<br>
			</div>
			<div id="ich">																							<!-- Bereich für die eigenen Profildaten -->
				<?php 
					$partner = "SELECT * FROM Rooms";
					foreach ($db->query($partner) as $zeile)
					{
							$guest = $zeile['Guest'];
					}
					
					
					echo "<h1>GUEST</h1>";
					echo "<div class='output'>";
						
					
					$sql="SELECT * FROM User WHERE Nickname = '$guest'";
					$result = $conn->query($sql);
					if ($result->num_rows > 0){
						while($row = $result->fetch_assoc()){
							$datei = "../Avatar/".$guest.".png";										/* Variable für das User-Bild */
					
							if (file_exists($datei))																/* Test ob User Bild hochgeladen hat */
							{
								echo " <img src='$datei' alt='Avatar' class='avatar'> <br>";
							}else{																					/* Wenn NEIN, dann Default-Bild nutzen */
								if ($row['Geschlecht'] == "m")														/* Geschlechtsabhängiges Default-Profilbild */
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
					}else{
						echo "0 results";
					}
					
					?>
				</div>
				<br>
		<div id="steuerung">				
			
			<input type="button" value="Close this window" onclick="windowClose();">
				
		</div>
		<?php $conn->close(); ?>
	</body>
</html>
