<?php

include 'datenbank.php';
if ($_SERVER["REQUEST_METHOD"]=="POST")
{	
	//Variable um Fehler festzustellen und eine Datenbankschreiben zu verhindern
	$fehler = false;

	//Variablen die aus der Registration übergeben werden
	$fname=$_POST['forname'];
	$name=$_POST['name'];
	$email=$_POST['mail'];
	$nick=$_POST['nick'];
	$pass=$_POST['pass'];
	$passCompare=$_POST['passCompare'];

	//Test ob auch alle Felder befüllt sind. Email, Nickname und Passwort müssen gesetzt sein
	//Die Eingabe eines Vornamen und eines Nachnamen ist zwar gewünscht, wird aber nicht erzwungen, um eine gewisse Annonymität zu sichern
	if (strlen($pass) == 0)
	{
		echo "Passwort darf nicht leer sein! <br>";
		$fehler = true;
	}
	if (strlen($email) == 0)
	{
		echo "Email darf nicht leer sein! <br>";
		$fehler = true;
	}
	if (strlen($nick) == 0)
	{
		echo "Sie müssen ein Nickname vergeben! <br>";
		$fehler = true;
	}


	//Passwortvergleich um sicherzustellen, dass kein Nutzer sich bei der Passwortvergabe vertippt und sich anschließend nicht mehr einloggen kann
	if ($pass != $passCompare)
	{
		echo "Die Passwörter stimmen nicht überein <br>";
		$fehler = true;
	}

	
	//Test ob Nickname bereits vorhanden. Muss zur Identifikation des Gesprächspartners eindeutig sein.
	$testNick = "SELECT * FROM User WHERE Nickname = '$nick'";
	$resultNick = mysqli_query($conn,$testNick);
	
	if (mysqli_num_rows($resultNick) > 0)
	{
		echo "Der Nickname ist bereits vergeben <br>";
		$fehler = true;
	}
	//Test ob EMail bereits vorhanden. 2. Kriterium um Eindeutigkeit der Person festzustellen
	$testMail = "SELECT * FROM User WHERE Email = '$email'";
	$resultMail = mysqli_query($conn,$testMail);
	
	if (mysqli_num_rows($resultMail) > 0)
	{
		echo "Die Email-Adresse ist bereits vergeben <br>";
		$fehler = true;
	}

	//Wenn keine Fehler vorliegen, wird die Person in die Datenbank in die Tabelle User aufgenommen
	if (!$fehler)
	{
		$sql="INSERT INTO User(Vorname, Nachname, Nickname, Email, Passwort) VALUES ('$fname', '$name', '$nick', '$email', '$pass')";
		$result=$conn->query($sql);
		header("Location:index.php");
	}
}


?>