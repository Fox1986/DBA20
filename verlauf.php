<!-- Dieses Skript erstellt den Nachrichtenverlauf für den Chat -->

<?php
	if (!isset($_SESSION))													/* Session nur einbinden, falls noch nicht passiert */
	{
		session_start();
	}
	
	$db = new PDO("mysql:dbname=DBA20;host=localhost","root", "akad");		/* Der Verlauf funktioniert nur, wenn die Datenbank hier nochmal eingebunden wird */

	$table = $_SESSION['currentChat'];										/* Den aktuellen Chatnamen in eine Variable speichern */
	
	$tableTest = $db->query("SHOW TABLES LIKE '$table'");					/* SQL Abfrage, ob Tabelle existiert */
	$vorhanden = $tableTest->rowCount();									/* Befehl ausführen */

	$du = $_SESSION['guest'];
	$guest = "SELECT Busy FROM User WHERE Nickname = '$du'";				/* Abfrage ob Guest noch im Chat ist */
	$result = $db -> query($guest);											/* Befehl ausführen */
	$test = $result -> fetch();												/* Daten abgreifen */

	$sql="SELECT * FROM $table";											/* Lese den Chat aus */
	$verlauf = $db->query($sql);											/* Befehl ausführen */
	
	if( $vorhanden == 0) 													/* Test ob Tabelle existiert in die geschrieben werde kann */
	{																		/* Falls kein Chat Nachricht an Gast */
		echo "Host hat Chat geschlossen";										
	}elseif ($test['Busy'] == FALSE) 
	{
		echo "$du ist nicht anwesend";	
	}else
	{
		foreach ($verlauf as $zeile) 										/* Gebe alles aus, was in der Datenbank steht */
		{
			echo "".$zeile["Sender"]. "<br>";
			echo "".$zeile["Zeit"]. ":: ".$zeile["Nachricht"]. "<br>";
			echo "<br>";
		}
	}	
?>