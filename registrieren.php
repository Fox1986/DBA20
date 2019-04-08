<?php
include 'datenbank.php';
$uname=$_POST['uname'];
$email=$_POST['email'];
$pass=$_POST['password'];

$sql="insert into c_nutzer(n_name, n_email, n_psswd)
values('$uname', '$email', '$pass')";
$result=$conn->query($sql);

header("Location:index.php")



?>