<?php

session_start();
include 'datenbank.php';
$nachricht=$_POST['nachricht'];
$name=$_SESSION['name'];

$sql="INSERT INTO verlauf (v_nachricht, v_name) VALUES ('$nachricht', '$name')";
$result=$conn->query($sql);


header("Location:home.php");

?>