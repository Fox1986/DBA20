<!-- Dieses Skript läd die Nicknames aller registrierten Nutzer und zeigt mittels Farbe die Verfügbarkeit des Nutzers an -->

<?php
	if (!isset($_SESSION))																/* Session nur einbinden, falls noch nicht passiert */
	{
		session_start();
	}
	
	require_once('datenbank.php');														/* Datenbank muss nicht immer wieder neu eingebunden wed*/

	echo '<form method="post" action="einladen.php">';
	echo '<select name="freunde" size="12">';	
					
	$sql="SELECT * FROM User";															/* Alle registrierten User anzeigen */
	foreach ($db -> query($sql) as $zeile) 												/* Liste befüllen */
	{
		if ($zeile["Nickname"] == $_SESSION['login_user'])								/* Verhindern das der eigene Nickname in der Liste auftaucht */
		{
			continue;
			
		}else
		{
			if ($zeile["Busy"] == 1)
			{
				echo "<option style='color:red'>" .$zeile["Nickname"]. "</option>";		/* Jeder User der bereits in einem Chat ist, wird rot angezeigt */
			}elseif ($zeile['Online'] == 1)												/* Test ob User eingeloggt ist */
			{
				echo "<option style='color:green'>" .$zeile["Nickname"]. "</option>";	/* Jeder User der Online ist, wird grün angezeigt */
			}else
			{
				echo "<option style='color:grey'>" .$zeile["Nickname"]. "</option>";	/* User die Offline sind, werden grau angezeigt */
			}
		}
	}
	echo '</select>';
	
	echo '<input style="font-size: 20px;" type="submit" value="Einladen">';				/* Button */
	echo '</form>';						
?>