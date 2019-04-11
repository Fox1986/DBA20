<?php
session_start();
include 'datenbank.php';
$usname=$_POST['nutzerkennung'];
$passd=$_POST['kennwort'];

$sql="SELECT * FROM `c_nutzer` WHERE n_name='$usname' AND n_psswd='&passd'";
$result=$conn->query($sql);

if(!$row=$result->fetch_assoc()){
	header("Location:error.php");
}else{
	$_SESSION['name']=$_POST['uname'];
	header("Location:home.php");
}

?>