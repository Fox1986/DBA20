<!-- Dieses Script regelt dir Prozedur beim abmelden -->

<?php 																		
	session_start();
	session_destroy();															/* Session beenden */

	include 'datenbank.php';													/* Datenbank einbinden, um Update vornehmen zu können */

	$user_check = $_SESSION['login_user'];										/* Den aktuellen Mitarbeiter finden */

	$sql="UPDATE Personal SET Online = FALSE WHERE Rolle = '$user_check'";		/* Mitarbeiter als Offline in der Datenbank updaten */
	$result=$conn->query($sql);													/* SQL-Befehl ausführen */

	header("Location:persIndex.php")											/* Rückführung auf die Anmeldeseite */


?>