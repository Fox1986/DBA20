
<?php
	if (!isset($_SESSION))													/* Session nur einbinden, falls noch nicht passiert */
	{
		session_start();
	}
	
	require_once('datenbank.php');											/* Datenbank muss nicht immer wieder neu eingebunden wed*/

			echo '<form method="post" action="einladen.php">';
				echo '<select name="freunde" size="12">';	
															
					
						$sql="SELECT * FROM User";														/* Alle registrierten User anzeigen */
						foreach ($db -> query($sql) as $zeile) 										/* Liste befüllen */
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
						
				echo '<input style="font-size: 20px;" type="submit" value="Einladen">';
			echo '</form>';
			
						
?>