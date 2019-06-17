
<?php
	if (!isset($_SESSION))													/* Session nur einbinden, falls noch nicht passiert */
	{
		session_start();
	}
	
	require_once('datenbank.php');											/* Datenbank muss nicht immer wieder neu eingebunden wed*/

			echo '<form action="profil.php" method="post" target="_blank">';
				echo '<select name="profil" size="20">';	
															
					
						$sql="SELECT * FROM User";														/* Alle registrierten User anzeigen */
						foreach ($conn -> query($sql) as $zeile) 										/* Liste befüllen */
						{
							if ($zeile['Online'] == 1)													/* Test auf Online-User */
							{
								echo "<option style='color:green'>" .$zeile["Nickname"]. "</option>";	/* Jeder User der Online ist, wird grün angezeigt */
							}else
							{
								echo "<option style='color:grey'>" .$zeile["Nickname"]. "</option>";	/* User die Offline sind, werden grau angezeigt */
							}
						}
					
					
				echo '</select>';
						
				echo '<input type = "submit" value = "Profil einsehen" name="submit"><br>';
			echo '</form>';
			
						
?>