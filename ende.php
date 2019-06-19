<!-- Dieses Skript beendet den aktuellen Chat -->

<?php
	session_start();																/* Session einbinden */
	include 'datenbank.php';														/* Datenbank einbinden */

	if($_SERVER["REQUEST_METHOD"] == "POST")										/* Prüfen ob Skriptaufruf mittels POST-Methode durchgeführt wurde */
	{
		$user = $_SESSION['login_user'];
		$type = $_POST['beenden'];													/* In Variable speichern, wer den Chat beendet */
		$chat = $_SESSION['currentChat'];											/* Name des Chats in Variable speichern */
	    if( $type == "Host")														/* Test ob Host den Chat beendet */ 
	    {
	        $killTable = "DROP TABLE $chat";										/* SQL-Befehl zum löschen des Chatraums aus der Datenbank */
	        $db -> exec($killTable);												/* Befehl ausführen */
	        $deleteRoom = "DELETE FROM Rooms WHERE Chat = '$chat'";					/* Löschen des Eintrags der offenen Chats aus der Datenbank */
	        $db -> exec($deleteRoom);												/* Befehl ausführen */
	        $verlassen = "UPDATE User SET Busy = FALSE WHERE Nickname = '$user'";	/* User wieder als Verfügbar makieren*/
		    $db -> exec($verlassen);
	        header("Location:home.php");											/* Auf home.php zurückkehren */
	    }else 																		/* Alternativ, wenn Gast den Chat verlässt */
	    {
	    	$verlassen = "UPDATE User SET Busy = FALSE WHERE Nickname = '$user'";	/* User wieder als Verfügbar makieren*/
		    $db -> exec($verlassen);
	    	header("Location:home.php");											/* Auf home.php zurückkehren */
	    }
	}
?>