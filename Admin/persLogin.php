<!-- Dieses Skript regelt den Login der Mitarbeiter mit ihrer jeweiligen Rolle -->

<?php 																									
	session_start();																					/* Session starten */
	include 'datenbank.php';																			/* Datenbank einbinden, um Personal-Daten laden zu können */
	if($_SERVER["REQUEST_METHOD"] == "POST") {															
		$loginNick = $_POST['logNick'];																	/* Login-Namen aus Index.php abgreifen */
		$loginPass = $_POST['logPass']; 																/* Passwort aus Index.php abgreifen */
		$sql = "SELECT ID FROM Personal WHERE Rolle = '$loginNick' AND Passwort = '$loginPass'";		/* Personal finden, auf den Nickname und Passwort zutreffen */
		$result = mysqli_query($conn,$sql);																/* SQL-Befehl ausführen */
				
		if (mysqli_num_rows($result) > 0)																/* Test ob Mitarbeiter Account besitzt */ 
		{
		    																							/* Mitarbeiter-Rolle in Session speichern*/
		    $_SESSION['login_user'] = "$loginNick";														
		    
		    $sql="UPDATE Personal SET Online = TRUE WHERE Rolle = '$loginNick'";						/* Angemeldeten Mitarbeiter als Online vermerken */
			$result=$conn->query($sql);     															/* SQL-Befehl ausführen */

		    header("location:persHome.php");															/* Bei erfolgreichen Einloggen, Weiterleitung nach home.php */
		}else {																							/* Javascript für Fehlermeldung in Popupfenster */ 

			echo "<script LANGUAGE='JavaScript'> 															
				window.alert('Name oder Passwort nicht korrekt'); 
				window.location.href='http://localhost/index.php'; </script>";							/* Ausgabe bei Anmeldefehlern */
		}
	}
?>