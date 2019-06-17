<?php 																				/* Dieses Script dient der Registrierung eines neuen Nutzers */
	include 'datenbank.php';															/* Datenbankverbindung einbinden */
	if ($_SERVER["REQUEST_METHOD"]=="POST")												/* Prüft ob der Seitenaufruf mit einer POST-Methode stattgefunden hat*/
	{	
		
		$fehler = false;																/* Variable um Fehler festzustellen und eine Datenbankschreiben zu verhindern */

																						/* Variablen die aus der Registration übergeben werden */
		$fname=$_POST['forname'];
		$name=$_POST['name'];
		$email=$_POST['mail'];
		$nick=$_POST['nick'];
		$pass=$_POST['pass'];
		$male=$_POST['geschlecht'];
		$passCompare=$_POST['passCompare'];

		if (strlen($pass) == 0)															/* Test ob ein Passwort vergeben wurde */
		{																				
			echo "<script LANGUAGE='JavaScript'> 															
				window.alert('Passwort darf nicht leer sein'); 
				window.location.href='http://localhost/index.php'; </script>";			/* PopUp-Fenster Fehlermeldung */		
			$fehler = true;
		}
		if (strlen($email) == 0)														/* Test ob eine Mail-Adresse vergeben wurde */
		{
			echo "<script LANGUAGE='JavaScript'> 															
				window.alert('Email darf nicht leer sein'); 
				window.location.href='http://localhost/index.php'; </script>";			/* PopUp-Fenster Fehlermeldung */			
			$fehler = true;
		}
		if (strlen($nick) == 0)															/* Test ob ein Nickname gewählt wurde */
		{
			echo "<script LANGUAGE='JavaScript'> 															
				window.alert('Sie müssen ein Nickname vergeben!'); 
				window.location.href='http://localhost/index.php'; </script>";			/* PopUp-Fenster Fehlermeldung */		
			$fehler = true;
		}
																						/* Die Eingabe eines Vornamen und eines Nachnamen ist zwar gewünscht, wird aber nicht erzwungen, um eine gewisse Annonymität zu sichern */

		if ($pass != $passCompare)														/* Sicherstellen dass beide Passwörter übereinstimmen, um User nicht auszuschließen */
		{
			echo "<script LANGUAGE='JavaScript'> 															
				window.alert('Die Passwörter stimmen nicht überein!'); 
				window.location.href='http://localhost/index.php'; </script>";			/* PopUp-Fenster Fehlermeldung */
			$fehler = true;
		}

		$testNick = "SELECT * FROM User WHERE Nickname = '$nick'";						/* Test ob der Nickname nicht schon vergeben wurde */
		$resultNick = $db -> query($testNick);
		
		if ($resultNick -> rowCount() > 0)
		{
			echo "<script LANGUAGE='JavaScript'> 															
				window.alert('Der Nickname ist bereits vergeben'); 
				window.location.href='http://localhost/index.php'; </script>";			/* PopUp-Fenster Fehlermeldung */
			$fehler = true;
		}
		
		$testMail = "SELECT * FROM User WHERE Email = '$email'";						/* Test ob die Mail-Adresse nicht zweimal vergeben wurde. */
		$resultMail = $db -> query($testMail);
		
		if ($resultMail -> rowCount() > 0)
		{
			echo "<script LANGUAGE='JavaScript'> 															
				window.alert('Die Email ist bereits vergeben'); 
				window.location.href='http://localhost/index.php'; </script>";			/* PopUp-Fenster Fehlermeldung */
			$fehler = true;
		}

		if (!$fehler)																	/* Bei Fehlerfreiheit wird der Nutzer in die Datenbank aufgenommen */
		{
			$sql="INSERT INTO User(Geschlecht, Vorname, Nachname, Nickname, Email, Passwort) VALUES ('$male', '$fname', '$name', '$nick', '$email', '$pass')";
			$result=$db->query($sql);
			header("Location:index.php");
		}
	}
?>