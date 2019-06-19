<!-- Dieses Skript löscht das eigene Profil -->

<?php 																				
	session_start();																	/* Session einbinden */
	include 'datenbank.php';															/* Datenbankverbindung einbinden */
	if ($_SERVER["REQUEST_METHOD"]=="POST")												/* Prüft ob der Seitenaufruf mit einer POST-Methode stattgefunden hat*/
	{	
		$person = $_SESSION['login_user'];												/* Eigene Person in Variable speichern */
		$sql =  "DELETE FROM User WHERE Nickname = '$person'";							/* Eintrag aus Datenbank löschen */
			
		$result=$db->query($sql);														/* Löschen durchführen */
		
		header("Location:index.php");													/* Zurück auf die Indexseite */
	}
?>
