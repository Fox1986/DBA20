<!-- Dieses Skript zeigt die Chats, denen man beitreten kann -->

<?php 																			

	if (!isset($_SESSION))															/* Session nur einbinden, falls noch nicht passiert */
	{
		session_start();
	}
	
	require_once('datenbank.php');													/* Datenbank nur bei Bedarf einbinden */


	echo '<form method="post" action="beitreten.php">';								/* Die getroffene Wahl wird an beitreten.php weitergeleitet */
		echo '<select name="rooms" size="8">';				
			$person = $_SESSION['login_user'];										/* Die eigene Person in Variable speichern */
			$sql="SELECT * FROM Rooms WHERE Guest = '$person'";						/* Alle Chats suchen, in denen man als Gast aufgeführt wird */
			foreach ($db -> query($sql) as $zeile) 									/* Liste befüllen */
			{
				echo "<option style='color:black'>" .$zeile["Host"]. "</option>";	/* Alle Chats anzeigen */
			}

		
		echo '</select>';
						
		echo '<input style="font-size: 20px;" type="submit" value="Beitreten">';	/* Button */
	echo '</form>';
		
?>