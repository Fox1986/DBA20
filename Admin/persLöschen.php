<?php 																				/* Dieses Script dient der Registrierung eines neuen Nutzers */
	session_start();
	include 'datenbank.php';															/* Datenbankverbindung einbinden */
	if ($_SERVER["REQUEST_METHOD"]=="POST")												/* Prüft ob der Seitenaufruf mit einer POST-Methode stattgefunden hat*/
	{	
		$person = 
		$sql =  "DELETE FROM User WHERE Nickname = '$person'";
			
		$result=$conn->query($sql);
		
		header("Location:index.php");
	}
?>
