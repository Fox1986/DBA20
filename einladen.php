<?php

session_start();
include 'datenbank.php';
$nachricht=$_POST['Nachricht'];
$sender=$_SESSION['login_user'];

$sql="INSERT INTO Chat (Nachricht, Sender) VALUES ('$nachricht', '$sender')";
$result=$conn->query($sql);


header("Location:home.php");

?>