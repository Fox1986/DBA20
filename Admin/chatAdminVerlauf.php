<!-- Dieses Skript erstellt den Chat-Verlauf und wird regelmäßg neu aufgerufen-->

<?php
	if (!isset($_SESSION))													/* Session nur einbinden, falls noch nicht passiert */
	{
		session_start();
	}
	
	require_once('datenbank.php');											/* Datenbank ggf. einbinden*/
	

	$table = $_SESSION['currentChat'];										/* Den aktuellen Chatnamen in eine Variable speichern */
	

	$sql="SELECT * FROM $table";											/* Lese den Chat aus */
	$verlauf = $conn->query($sql);											/* Befehl ausführen */
	
	if( !$verlauf) 													/* Test ob Tabelle existiert in die geschrieben werde kann */
	{																		/* Falls kein Chat Nachricht an Gast */
		echo "Host hat Chat geschlossen";											
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


					

