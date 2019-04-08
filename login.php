<?php
include 'datenbank.php';
$uname=$_POST['uname'];
$pass=$_POST['password'];

$sql="SELECT * FROM c_nutzer WHERE n_name='$uname' AND n_psswd='&pass'";
$result=$conn->query($sql);

if(!$row=$result->fetch_assoc()){
	header("Location:error.php");
}else{
	$_SESSION['name']=$_POST['uname'];


	
	header("Location:home.php");
}

?>