<?php
	if (!isset($_SESSION))													/* Session nur einbinden, falls noch nicht passiert */
	{
		session_start();
	}
	
	require_once('datenbank.php');	
											/* Datenbank muss nicht immer wieder neu eingebunden wed*/
	include ('classChat.php');

	$test = new Chat();
?>	

<!DOCTYPE html>
<html>
	<head>
		<title>ChatRoom</title>
		<link rel="stylesheet" type="text/css" href="chat.css">
		<script src="http://code.jquery.com/jquery-latest.js"> </script>
		
		<script type="text/javascript">
			window.onload = startInterval;
			
			function startInterval()
			{
				setInterval("startTime();", 1000);
				scroll();				
			}
			function startTime()
			{
			 $('#output').load("verlauf.php"); 
				scroll();
			}
			
			function scroll()
			{
				var objDiv = document.getElementById("output");
     			objDiv.scrollTop = objDiv.scrollHeight;
			}
		
		</script>
		
	</head>
	
	<body>
	<?php
		echo '<div id="main">';
			echo '<h1>Chat</h1>';
			echo '<div id="output">';
			
			include('verlauf.php');
			
			echo '</div>';
			echo '<form method="post" action="send.php">';
			
			echo '<textarea name="nachricht" placeholder="Tippen um Nachricht zu senden..." class="form-control"></textarea><br>';

			echo '<input style="font-size: 20px;" type="submit" value="Abschicken" >';

			echo '</form>';
			echo '<br>';
				
		echo '</div>';



		echo '<div id = "chatpartner">';

			echo '<div id="du">';											
				$du = $test -> p2;
				$datei = $test -> p2Avatar;
				$Vorname = $test -> p2Vorname;
				$Nachname = $test -> p2Nachname;
				$Email = $test -> p2Email;
				$Strasse = $test -> p2Strasse;
				$Hausnummer = $test -> p2Hausnummer;
				$Plz = $test -> p2Plz;
				$Wohnort = $test -> p2Wohnort;

				echo "<h1>$du</h1>";
				echo "<div class='output'>";
				echo " <img src='$datei' alt='Avatar' class='avatar'> <br>";
				echo "<br>";
				echo "$Vorname<br>";
				echo "$Nachname<br>";
				echo "$Email<br>";
				echo "$Strasse $Hausnummer<br>";
				echo "$Plz $Wohnort<br>";
				echo "</div>";
				echo "<br>";	
			echo '</div>';

			echo '<div id="ich">';											
				$ich = $test -> p1;
				$datei = $test -> p1Avatar;
				$Vorname = $test -> p1Vorname;
				$Nachname = $test -> p1Nachname;
				$Email = $test -> p1Email;
				$Strasse = $test -> p1Strasse;
				$Hausnummer = $test -> p1Hausnummer;
				$Plz = $test -> p1Plz;
				$Wohnort = $test -> p1Wohnort;
					
				echo "<h1>$ich</h1>";
				echo "<div class='output'>";
				echo " <img src='$datei' alt='Avatar' class='avatar'> <br>";
				echo "<br>";
				echo "$Vorname<br>";
				echo "$Nachname<br>";
				echo "$Email<br>";
				echo "$Strasse $Hausnummer<br>";
				echo "$Plz $Wohnort<br>";
				echo "</div>";
				echo "<br>";	
			echo "</div>";
		echo "</div>";
		
		echo '<div id="steuerung">';					
			echo '<form action="ende.php" method="post">';					
				$chat = $test -> cr;
				$partner = "SELECT * FROM Rooms";
					foreach ($db->query($partner) as $zeile)
					{
						if ($zeile['Guest'] == $ich && $zeile['Chat'] == $test -> cr)
						{
							echo "<input type='hidden' name='beenden' value='Guest'>";
							echo "<input type='hidden' name='chat' value='$chat'>";
							echo "<input type='submit' value='Chat verlassen'>";
						}elseif ($zeile['Host'] == $ich && $zeile['Chat'] == $test -> cr) 
						{
							echo "<input type='hidden' name='beenden' value='Host'>";
							echo "<input type='hidden' name='chat' value='$chat'>";
							echo "<input type='submit' value='Chat beenden'>";
						}
					}
			echo '</form>';			
		echo "</div>";
		
		$db=null; 
?>
	</body>
</html>

