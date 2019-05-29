<?php

session_start();																/* Session starten */	
include 'datenbank.php';														/* Datenbankverbindung einbinden */
$nachricht=$_POST['Nachricht'];													/* Nachricht wird aus home.php ausgelesen */
$sender=$_SESSION['login_user'];												/* Absender wird aus Session-Name generiert */

$sql="INSERT INTO Chat (Nachricht, Sender) VALUES ('$nachricht', '$sender')";	/* Nachricht in die Tabelle Chat schreiben */
$result=$conn->query($sql);														/* SQL-Befehl ausführen */


header("Location:home.php");													/* Zurück zu home.php. Aktualisiert gleichzeitig die Anzeige */

?>