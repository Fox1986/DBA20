<!-- Mit diesem Skript tritt nimmt man eine Chateinladung an -->

<?php
	session_start();															/* Session einbinden */
	include 'datenbank.php';													/* Datenbank einbinden */
	
	if($_SERVER["REQUEST_METHOD"] == "POST")									/* Prüfen ob Skript mittels POST-Methode aufgerufen wurde */
	{	
		
		$ich = $_SESSION['login_user'];											/* Eigenen Nickname in Variable speichern */
		$_SESSION['guest'] = $_POST['rooms'];									/* Name des Gastes in Session speichern */
		$du = $_SESSION['guest'];												/* Gastname in Variable speichern */
	
		$tableGuest = "Chat_".$du. "_" .$ich;									/* Name des Chats generieren */

		$_SESSION['currentChat'] = $tableGuest;									/* Chatname in Session speichern */
		
		$anwesenheit = "UPDATE User SET Busy = TRUE WHERE Nickname = '$ich'";	/* Gast wird auf beschäftigt gesetzt, um weitere Chatanfragen zu verhindern */
	    $db -> exec($anwesenheit);												/* Befehl ausführen */
	}

	header("Location:chat.php");												/* Weiterleitung auf chat.php */
?>

