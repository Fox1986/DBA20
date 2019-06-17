<?php 																			/* Dieses Script dient dem Absenden von geschriebenen Nachrichten */

	if (!isset($_SESSION))														/* Session nur einbinden, falls noch nicht passiert */
	{
		session_start();
	}
	
	require_once('datenbank.php');												/* Datenbank muss nicht immer wieder neu eingebunden wed*/


	echo '<form action="beitretenAdmin.php" method="post" target="_blank">';
		echo '<select name="rooms" size="20">';				
			
			$sql="SELECT * FROM Rooms ";					/* Alle registrierten User anzeigen */
			foreach ($conn -> query($sql) as $zeile) 										/* Liste befüllen */
			{
				echo "<option style='color:black'>" .$zeile["Chat"]. "</option>";	/* Jeder User der Online ist, wird grün angezeigt */
			}
		
		echo '</select>';
						
		echo '<input type = "submit" value = "Chat betreten" name="submit"><br> ';
	echo '</form>';
			
?>