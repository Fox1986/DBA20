<?php 																			/* Dieses Script dient dem Absenden von geschriebenen Nachrichten */

	if (!isset($_SESSION))														/* Session nur einbinden, falls noch nicht passiert */
	{
		session_start();
	}
	
	require_once('datenbank.php');												/* Datenbank muss nicht immer wieder neu eingebunden wed*/


	echo '<form method="post" action="beitreten.php">';
		echo '<select name="rooms" size="8">';				
			$person = $_SESSION['login_user'];
			$sql="SELECT * FROM Rooms WHERE Guest = '$person'";					/* Alle registrierten User anzeigen */
			foreach ($db -> query($sql) as $zeile) 										/* Liste befüllen */
			{
				echo "<option style='color:black'>" .$zeile["Host"]. "</option>";	/* Jeder User der Online ist, wird grün angezeigt */
			}
		
		echo '</select>';
						
		echo '<input style="font-size: 20px;" type="submit" value="Beitreten">';
	echo '</form>';
			
?>