<?php 																						/* Dieses Script dient der Registrierung eines neuen Nutzers */
	session_start();
	include 'datenbank.php';																/* Datenbankverbindung einbinden */
	if ($_SERVER["REQUEST_METHOD"]=="POST")													/* Prüft ob der Seitenaufruf mit einer POST-Methode stattgefunden hat*/
	{	
		
		$fehler = false;																	/* Variable um Fehler festzustellen und eine Datenbankschreiben zu verhindern */

		$person = $_SESSION['login_user'];													/* Variablen die aus der Registration übergeben werden */
		$mail=$_POST['email'];
		$passw=$_POST['pass1'];
		$passw2=$_POST['pass2'];
		$forename=$_POST['vname'];
		$name=$_POST['name'];
		$strasse=$_POST['str'];
		$hausnr=$_POST['hausn'];
		$plz=$_POST['plz'];
		$ort=$_POST['ort'];
		$handyn=$_POST['handy'];
		$public= 0;

		if (isset($_POST['public']))															/* Variable wird je nach Ergebnis der Checkbox umgeschrieben */
		{
			$public = 1;
		}

		if (strlen($passw) == 0)															/* Test ob ein Passwort vergeben wurde */
		{
			echo "<script LANGUAGE='JavaScript'>										 															
				window.alert('Passwort darf nicht leer sein!'); 
				window.location.href='http://localhost/home.php'; </script>";				/* PopUp-Fenster Fehlermeldung */
			$fehler = true;
		}
		if (strlen($mail) == 0)																/* Test ob eine Mail-Adresse vergeben wurde */
		{
			echo "<script LANGUAGE='JavaScript'>										 															
				window.alert('Email darf nicht leer sein!'); 
				window.location.href='http://localhost/home.php'; </script>";				/* PopUp-Fenster Fehlermeldung */
			$fehler = true;
		}
		
		if ($passw != $passw2)																/* Sicherstellen dass beide Passwörter übereinstimmen, um User nicht auszuschließen */
		{
			echo "<script LANGUAGE='JavaScript'>										 															
				window.alert('Die Passwörter stimmen nicht überein'); 
				window.location.href='http://localhost/home.php'; </script>";				/* PopUp-Fenster Fehlermeldung */
			$fehler = true;
		}

			$bild = pathinfo($_FILES['Bild']['name'], PATHINFO_FILENAME);						/* Bilddatei einlesen */
			$dateityp = strtolower(pathinfo($_FILES['Bild']['name'], PATHINFO_EXTENSION));		/* Dateityp auslesen */
			$erlaubteTypen = array('png', 'jpg', 'jpeg', 'gif');								/* Diese Dateitypen können hochgeladen werden */
			$max_size = 2000*1024;																/* Dateigröße wird beschränkt*/
			$speicherOrt = "Avatar/";															/* Ordner für die Speicherung */

			$speicherPfad = $speicherOrt.$person.'.png';										/* Speicherformat. Datei wird nach Nickname benannt und ist damit einmalig. Endung wird immer 																							in png umgeschrieben */
			if (!isset($bild))																	/* Fehlermeldungen nicht ausgeben, wenn kein neues Profilbild gewählt wurde */
			{
				if(!in_array($dateityp, $erlaubteTypen)) 											/* Test ob Datei auch ein Bild ist */
				{
					echo "<script LANGUAGE='JavaScript'>										 															
						window.alert('Ungültige Dateiendung. Nur png, jpg, jpeg und gif-Dateien sind erlaubt'); 
						window.location.href='http://localhost/home.php'; </script>";				/* PopUp-Fenster Fehlermeldung */
					$fehler = true;
				}

				if($_FILES['Bild']['size'] > $max_size) 											/* Test ob die Datei die Größe einhält */
				{
					echo "<script LANGUAGE='JavaScript'>										 															
						window.alert('Bitte keine Dateien größer 2MB hochladen'); 
						window.location.href='http://localhost/home.php'; </script>";				/* PopUp-Fenster Fehlermeldung */
					$fehler = true;
				}
			}


		if (!$fehler)																		/* Bei Fehlerfreiheit wird der Nutzer in die Datenbank aufgenommen */
		{
			

			$sql =  "UPDATE User SET Vorname = '$forename', Nachname = '$name', Email = '$mail', Passwort = '$passw', Strasse = '$strasse', Hausnummer = '$hausnr', Plz = '$plz', Wohnort = '$ort', Handynummer = '$handyn', Public = '$public' WHERE Nickname = '$person'";

			$result=$db->query($sql);
			
			move_uploaded_file($_FILES['Bild']['tmp_name'], $speicherPfad);
			
			echo "<script LANGUAGE='JavaScript'>										 															
				window.alert('Änderungen gespeichert'); 
				window.location.href='http://localhost/home.php'; </script>";				/* PopUp-Fenster für bei erfolgreicher Speicherung */
		}
	}
?>
