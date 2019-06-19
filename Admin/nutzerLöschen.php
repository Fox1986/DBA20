<!-- Dieses Skript dient dazu den ausgewählten Nutzer aus der Datenbank zu löschen -->

<?php 																	
	session_start();												/* Session einbinden */
	include 'datenbank.php';										/* Datenbankverbindung einbinden */
	if ($_SERVER["REQUEST_METHOD"]=="POST")							/* Prüft ob der Seitenaufruf mit einer POST-Methode stattgefunden hat*/
	{	
		$person = $_POST['kill'];									/* Zu löschende Person in Variable ablegen */
		$sql =  "DELETE FROM User WHERE Nickname = '$person'";		/* SQL-Befehl zum löschen der Person aus der User-Tabelle */
			
		$result=$conn->query($sql);									/* Befehl ausführen */
		
		header("Location:persHome.php");							/* Zu persHome.php zurückkehren */
	}
?>
