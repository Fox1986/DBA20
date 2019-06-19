<!-- Dieses Script dient dem Absenden von geschriebenen Nachrichten -->

<?php 																						

	session_start();																		/* Session starten */	
	include 'datenbank.php';																/* Datenbankverbindung einbinden */
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$nachricht=$_POST['nachricht'];														/* Nachricht wird aus home.php ausgelesen */
		$sender=$_SESSION['login_user'];													/* Absender wird aus Session-Name generiert */
		$tabelle=$_SESSION['currentChat'];

		$sql="INSERT INTO $tabelle (Sender, Nachricht) VALUES ('$sender', '$nachricht')";	/* Nachricht in die Tabelle Chat schreiben */
		$kommando=$conn->prepare($sql);
		$kommando->execute();																/* SQL-Befehl ausführen */
	}

	header("Location:chatAdmin.php"); 														/* Zurück zu home.php. Aktualisiert gleichzeitig die Anzeige */
?>