<!-- Dieses Script dient dem Absenden von geschriebenen Nachrichten -->

<?php 																			

	session_start();																		/* Session starten */	
	include 'datenbank.php';																/* Datenbankverbindung einbinden */
	$tableHost = $_SESSION['currentChat'];																
	$resultHost = $db->query("SHOW TABLES LIKE '$tableHost'");								/* SQL Abfrage, ob Tabelle existiert */
	$vorhanden = $resultHost->rowCount();													/* Befehl ausführen */
	if( $vorhanden == 0) 																	/* Test ob Tabelle existiert in die geschrieben werde kann */
	{																						/* Falls kein Chat besteht schreiben verhindern */
		echo "<script LANGUAGE='JavaScript'> 															
			window.alert('Chat nicht verfügbar!')"; 										/* PopUp-Fenster Fehlermeldung, wenn Nachricht nicht gesendet werden kann */
		header("Location:chat.php");														/* Rückleitung an chat.php */
	}else
	{
		if($_SERVER["REQUEST_METHOD"] == "POST")												/* Prüft ob der Seitenaufruf mit einer POST-Methode stattgefunden hat*/
		{	
			$nachricht=$_POST['nachricht'];														/* Nachricht wird aus home.php ausgelesen */
			$sender=$_SESSION['login_user'];													/* Absender wird aus Session generiert */
			$tabelle=$_SESSION['currentChat'];													/* Chat wird auch aus Session ausgelesen */

			$sql="INSERT INTO $tabelle (Sender, Nachricht) VALUES ('$sender', '$nachricht')";	/* Nachricht in die Tabelle Chat schreiben */
			$kommando=$db->prepare($sql);														/* Ausführen des Befehls vorbereiten*/
			$kommando->execute();																/* SQL-Befehl ausführen */	
		}
		header("Location:chat.php"); 															/* Zurück zu home.php. Aktualisiert gleichzeitig die Anzeige */
	}
	
?>