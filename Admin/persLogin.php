<?php 																									/* Das Script regelt den Login */
	session_start();																					/* Session starten */
	include 'datenbank.php';																			/* Datenbank einbinden, um User-Daten laden zu können */
	if($_SERVER["REQUEST_METHOD"] == "POST") {															
		$loginNick = $_POST['logNick'];																	/* Login-Namen aus Index.php abgreifen */
		$loginPass = $_POST['logPass']; 																/* Passwort aus Index.php abgreifen */
		$sql = "SELECT ID FROM Personal WHERE Rolle = '$loginNick' AND Passwort = '$loginPass'";			/* User finden, auf den Nickname und Passwort zutreffen */
		$result = mysqli_query($conn,$sql);																/* SQL-Befehl ausführen */
				
		if (mysqli_num_rows($result) > 0)																/* Test ob User bereits registriert */ 
		{
		    																							/* session_register("loginNick"); */
		    $_SESSION['login_user'] = "$loginNick";														/* Session nach dem aktuellen User bennen */
		    
		    $sql="UPDATE Personal SET Online = TRUE WHERE Rolle = '$loginNick'";							/* Angemeldeten User als Online vermerken */
			$result=$conn->query($sql);     															/* SQL-Befehl ausführen */

		    header("location:persHome.php");																/* Bei erfolgreichen Einloggen, Weiterleitung nach home.php */
		}else {																							/* Javascript um die Fehlermeldung in ein Popupfenster zu verpacken. Dadurch wird 																									verhindert, dass Fehlermeldungen auf eigenen HTML-Seiten gezeigt werden*/
			echo "<script LANGUAGE='JavaScript'> 															
				window.alert('Name oder Passwort nicht korrekt'); 
				window.location.href='http://localhost/index.php'; </script>";							/* Ausgabe falls User noch kein Account besitzt oder Eingabefehler macht*/
		}
	}
?>