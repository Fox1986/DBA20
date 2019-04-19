<?php

	define('DB_SERVER', 'localhost:3036');
	define('DB_USERNAME', 'taeger');
	define('DB_PASSWORD', 'foxdie');
    define('DB_DATABASE', 'chat');
    $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

	if(!$conn){
		die("Verbindung fehlgeschlagen".mysqli_connect_error());
}

?>