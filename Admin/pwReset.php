<!-- Dieses Skript setzt das Passwort auf ein vom Admin gewähltes zurück -->

<?php 																						
	session_start();																/* Session einbinden */
	include 'datenbank.php';														/* Datenbankverbindung einbinden */
	if ($_SERVER["REQUEST_METHOD"]=="POST")											/* Prüft ob der Seitenaufruf mit einer POST-Methode stattgefunden hat*/
	{	
		$fehler = false;
		$person = $_POST['profil'];													/* Name des zu ändernden Profils */
		
		$passw=$_POST['pass1'];														/* Passwort empfangen */	
		$passw2=$_POST['pass2'];													/* Passwortwiederholung empfangen */


		if (strlen($passw) == 0)													/* Test ob ein Passwort vergeben wurde */
		{
			echo "<script LANGUAGE='JavaScript'>										 															
				window.alert('Passwort darf nicht leer sein!'); 
				window.location.href='http://localhost/Admin/profil.php'; </script>";		/* PopUp-Fenster Fehlermeldung */
			$fehler = true;
		}

		if (strlen($passw2) == 0)													/* Test ob Passwort wiederholt wurde */
		{
			echo "<script LANGUAGE='JavaScript'>										 															
				window.alert('Bitte Passwort wiederholen'); 
				window.location.href='http://localhost/Admin/profil.php'; </script>";		/* PopUp-Fenster Fehlermeldung */
			$fehler = true;
		}

		if ($passw != $passw2)														/* Sicherstellen dass beide Passwörter übereinstimmen, um User nicht auszuschließen */
		{
			echo "<script LANGUAGE='JavaScript'>										 															
				window.alert('Die Passwörter stimmen nicht überein'); 
				window.location.href='http://localhost/Admin/profil.php'; </script>";		/* PopUp-Fenster Fehlermeldung */
			$fehler = true;
		}

		if (!$fehler)																	/* Prüfen ob Fehler vorliegt */
		{
			$sql =  "UPDATE User SET Passwort = '$passw' WHERE Nickname = '$person'";	/* SQL-Befehl das Passwortfeld zu aktualisieren */

			$result=$conn->query($sql);													/* Befehl ausführen */
			
			echo "<script LANGUAGE='JavaScript'>										 															
				window.alert('Änderungen gespeichert'); 
				window.location.href='http://localhost/Admin/persHome.php'; </script>";	/* PopUp-Fenster für bei erfolgreicher Speicherung */	
		}
	}
?>
