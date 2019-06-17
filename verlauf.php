<?php
	if (!isset($_SESSION))													/* Session nur einbinden, falls noch nicht passiert */
	{
		session_start();
	}
	
	
	
	$db = new PDO("mysql:dbname=DBA20;host=localhost","root", "akad");
	$table = $_SESSION['currentChat'];
	$sql="SELECT * FROM $table";											/* Lese den Chat aus */
	$verlauf = $db->query($sql);
	foreach ($verlauf as $zeile) 											/* Gebe alles aus, was in der Datenbank steht */
	{
		echo "".$zeile["Sender"]. "<br>";
		echo "".$zeile["Zeit"]. ":: ".$zeile["Nachricht"]. "<br>";
		echo "<br>";
	}
	
?>