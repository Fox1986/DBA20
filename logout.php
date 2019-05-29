<?php
include 'datenbank.php';													/* Datenbank einbinden, um Update vornehmen zu können */

session_start();
session_destroy();															/* Session beenden */

$user_check = $_SESSION['login_user'];										/* Den aktuellen User finden */

$sql="UPDATE User SET Online = FALSE WHERE Nickname = '$user_check'";		/* User als Offline in der Datenbank updaten */
$result=$conn->query($sql);													/* SQL-Befehl ausführen */

header("Location:index.php")												/* Rückführung auf die Anmeldeseite */


?>