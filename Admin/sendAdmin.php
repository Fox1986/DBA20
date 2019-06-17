<?php 																			/* Dieses Script dient dem Absenden von geschriebenen Nachrichten */

	session_start();																/* Session starten */	
	include 'datenbank.php';														/* Datenbankverbindung einbinden */
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$nachricht=$_POST['nachricht'];													/* Nachricht wird aus home.php ausgelesen */
		$sender=$_SESSION['login_user'];												/* Absender wird aus Session-Name generiert */
		$tabelle=$_SESSION['Chat'];

		$sql="INSERT INTO $tabelle (Sender, Nachricht) VALUES ('$sender', '$nachricht')";	/* Nachricht in die Tabelle Chat schreiben */
		$kommando=$db->prepare($sql);
		$kommando->execute();														/* SQL-Befehl ausführen */


		
	}

	header("Location:chatAdmin.php"); 													/* Zurück zu home.php. Aktualisiert gleichzeitig die Anzeige */
?>