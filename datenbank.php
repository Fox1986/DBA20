<?php

	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', 'akad');
    define('DB_DATABASE', 'DBA20');
    $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

	if(!$conn){
		die("Verbindung fehlgeschlagen".mysqli_connect_error());
}

?>