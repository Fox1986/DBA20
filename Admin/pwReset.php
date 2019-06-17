<?php 																						/* Dieses Script dient der Registrierung eines neuen Nutzers */
	session_start();
	include 'datenbank.php';																/* Datenbankverbindung einbinden */
	if ($_SERVER["REQUEST_METHOD"]=="POST")													/* Prüft ob der Seitenaufruf mit einer POST-Methode stattgefunden hat*/
	{	
		$person = $_POST['profil'];													/* Variablen die aus der Registration übergeben werden */
		
		echo "$person";
		$sql =  "UPDATE User SET Passwort = 'passwort' WHERE Nickname = '$person'";

		$result=$conn->query($sql);
			
		echo "<script LANGUAGE='JavaScript'>										 															
				window.alert('Änderungen gespeichert'); 
				window.location.href='http://localhost/persHome.php'; </script>";				/* PopUp-Fenster für bei erfolgreicher Speicherung */	
	}
?>
