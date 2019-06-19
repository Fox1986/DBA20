<!-- Dieses Skript erstellt eine Liste aller offenen Chats und ermöglicht das Beitreten zu einem Chat-->

<?php 																			

	if (!isset($_SESSION))															/* Session nur einbinden, falls noch nicht passiert */
	{
		session_start();
	}
	
	require_once('datenbank.php');													/* Datenbank einbinden*/


	echo '<form action="beitretenAdmin.php" method="post">';						/* Daten werden an beitreten.php weitergeleitet */
		echo '<select name="rooms" size="20">';										/* Auswahlliste erstellen */			
			
			$sql="SELECT * FROM Rooms ";											/* SQL-Befehl um alle registrierten Chaträume abfragen */
			foreach ($conn -> query($sql) as $zeile) 								/* Liste befüllen */
			{
				echo "<option style='color:black'>" .$zeile["Chat"]. "</option>";	/* Jeder User der Online ist, wird grün angezeigt */
			}
		
		echo '</select>';
						
		echo '<input type = "submit" value = "Chat betreten" name="submit"><br> ';	/* Button um Chat beizutreten */
	echo '</form>';
			
?>