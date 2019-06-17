<?php
	if (!isset($_SESSION))													/* Session nur einbinden, falls noch nicht passiert */
	{
		session_start();
	}
	
	require_once('datenbank.php');											/* Datenbank muss nicht immer wieder neu eingebunden wed*/
		$room = $_SESSION['Chat'];
		$chat = "SELECT * FROM Rooms WHERE Chat = '$room'";
		foreach ($db->query($chat) as $zeile)
		{
			$tableHost = $zeile['Chat'];
		}
		$sql="SELECT * FROM $tableHost";
		$verlauf = $db->query($sql);
		foreach ($verlauf as $zeile) 
		{
			echo "".$zeile["Sender"]. "<br>";
			echo "".$zeile["Zeit"]. ":: ".$zeile["Nachricht"]. "<br>";
			echo "<br>";
		}
?>


					