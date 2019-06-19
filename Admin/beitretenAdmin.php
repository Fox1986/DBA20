<!-- Dieses Skript regelt das Beitreten des Admins in einen Chatraum -->

<?php
	session_start();													/* Session einbinden */
	include 'datenbank.php';											/* Datenbankverbindung einbinden */
	
	if($_SERVER["REQUEST_METHOD"] == "POST")							/* Prüfen ob Skript mittels POST-Methode aufgerufen wurde	 */
	{	
		$_SESSION['currentChat'] = $_POST['rooms'];						/* Ausgewählten Chatraum aus openchats.php in Session speichern */
	}

	header("Location:chatAdmin.php");									/* Weiterleitung an chatAdmin.php */
?>