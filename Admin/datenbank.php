<?php 																			/* Dieses Script lagert die Datenbankverbindung aus.*/

	define('DB_SERVER', 'localhost');											/* Datenbank Verbindung. Localhost bei z.B. XAMPP. IP-Adresse bei externem Server */
	define('DB_USERNAME', 'root');												/* Datenbanknutzer */
	define('DB_PASSWORD', 'akad');												/* Nutzerpasswort */
    define('DB_DATABASE', 'DBA20');												/* Datenbank auf die zugegriffen werden soll */
    $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);		/* Verbindung wird Variable gespeichert. Diese kann von anderen PHP Seiten genutzt werden */

    $db = new PDO("mysql:dbname=DBA20;host=localhost","root", "akad");
	

	if(!$conn){																	/* Fehlermeldung */
		die("Verbindung fehlgeschlagen".mysqli_connect_error());
}

?>
