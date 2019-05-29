<?php
	include 'datenbank.php';																			/* Datenbank einbinden, um User-Daten laden zu können */
	session_start();																					/* Session starten */
	if($_SERVER["REQUEST_METHOD"] == "POST") {															
		$loginNick = $_POST['logNick'];																	/* Login-Namen aus Index.php abgreifen */
		$loginPass = $_POST['logPass']; 																/* Passwort aus Index.php abgreifen */
		$sql = "SELECT ID FROM User WHERE Nickname = '$loginNick' AND Passwort = '$loginPass'";			/* User finden, auf den Nickname und Passwort zutreffen */
		$result = mysqli_query($conn,$sql);																/* SQL-Befehl ausführen */
				
		if (mysqli_num_rows($result) > 0)																/* Test ob User bereits registriert */ 
		{
		    //session_register("loginNick");
		    $_SESSION['login_user'] = "$loginNick";														/* Session nach dem aktuellen User bennen */
		    
		    $sql="UPDATE User SET Online = TRUE WHERE Nickname = '$loginNick'";							/* Angemeldeten User als Online vermerken */
			$result=$conn->query($sql);     															/* SQL-Befehl ausführen */

		    header("location:home.php");																/* Bei erfolgreichen Einloggen, Weiterleitung nach home.php */
		}else {																							/* Ausgabe falls User noch kein Account besitzt */
		    die("Name oder Passwort nicht korrekt");
		}
	}
?>