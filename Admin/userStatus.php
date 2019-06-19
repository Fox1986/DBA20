<!-- Dieses Skript dient dem Anzeigen der registrierten User, mit ihren jeweiligen Stati -->

<?php
	if (!isset($_SESSION))																/* Session nur einbinden, falls noch nicht passiert */
	{
		session_start();
	}
	
	require_once('datenbank.php');														/* Datenbank ggf. einbinden*/

	echo '<form action="profil.php" method="post" >';									/* Weiterleitung der Daten an profil.php */
		echo '<select name="profil" size="20">';										/* Liste erstellen */
		$sql="SELECT * FROM User";														/* Alle registrierten User anzeigen */
		foreach ($conn -> query($sql) as $zeile) 										/* Liste befüllen */
		{
			if ($zeile["Busy"] == 1)
			{
				echo "<option style='color:red'>" .$zeile["Nickname"]. "</option>";		/* Jeder User der in einem Chat ist, wird rot angezeigt */
			}elseif ($zeile['Online'] == 1)												/* Test ob User eingeloggt ist */
			{
				echo "<option style='color:green'>" .$zeile["Nickname"]. "</option>";	/* Jeder User der Online ist, wird grün angezeigt */
			}else
			{
				echo "<option style='color:grey'>" .$zeile["Nickname"]. "</option>";	/* User die Offline sind, werden grau angezeigt */
			}
		}
		echo '</select>';
		echo '<input type = "submit" value = "Profil einsehen" name="submit"><br>';		/* Button um User-Profil einzusehen */
	echo '</form>';
?>