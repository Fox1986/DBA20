<!-- Dieses Script regelt dir Prozedur beim abmelden -->

<?php 																		
	session_start();
	session_destroy();															/* Session beenden */

	include 'datenbank.php';													/* Datenbank einbinden, um Update vornehmen zu können */

	$user_check = $_SESSION['login_user'];										/* Den aktuellen User finden */

	$sql="UPDATE User SET Online = FALSE WHERE Nickname = '$user_check'";		/* User als Offline in der Datenbank updaten */
	$result=$db->query($sql);													/* SQL-Befehl ausführen */

	$sql="UPDATE User SET Busy = FALSE WHERE Nickname = '$user_check'";			/* User als Offline in der Datenbank updaten */
	$result=$db->query($sql);													/* SQL-Befehl ausführen */

	header("Location:index.php")												/* Rückführung auf die Anmeldeseite */
?>