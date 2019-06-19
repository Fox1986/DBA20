<!-- Das Script regelt den Login -->

<?php 																									
	session_start();																		/* Session starten */
	include 'datenbank.php';																/* Datenbank einbinden, um User-Daten laden zu können */
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {												/* Prüft ob der Seitenaufruf mit einer POST-Methode stattgefunden hat*/
		$loginNick = $_POST['logNick'];														/* Login-Namen aus Index.php abgreifen */
		$loginPass = $_POST['logPass']; 													/* Passwort aus Index.php abgreifen */
		$sql = "SELECT ID FROM User WHERE Nickname = '$loginNick' AND Passwort = '$loginPass'";			/* User finden, auf den Nickname und Passwort zutreffen */
		$result = $db -> query ($sql);														/* SQL-Befehl ausführen */
				
		if ($result->rowCount() > 0)														/* Test ob User bereits registriert */ 
		{
		    $_SESSION['login_user'] = "$loginNick";											/* Session für aktuellen User einrichten */
		    
		    $sql="UPDATE User SET Online = TRUE WHERE Nickname = '$loginNick'";				/* Angemeldeten User als Online vermerken */
			$result=$db->query($sql);     													/* SQL-Befehl ausführen */

		    header("location:home.php");													/* Bei erfolgreichen Einloggen, Weiterleitung nach home.php */
		}else {																				/* Javascript um die Fehlermeldung in ein Popupfenster zu verpacken. */
																							/* Dadurch wird keine HTML-Seite für Fehlermeldung benötigt */
			echo "<script LANGUAGE='JavaScript'> 															
				window.alert('Name oder Passwort nicht korrekt'); 
				window.location.href='http://localhost/index.php'; </script>";				/* Ausgabe falls User noch kein Account besitzt oder Eingabefehler macht*/
		}
	}
?>