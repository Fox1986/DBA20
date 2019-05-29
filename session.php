<?php

	include('datenbank.php');

   
   $user_check = $_SESSION['login_user'];
   
   $sql = "SELECT Nickname from User where Nickname = '$user_check' ";
   $ses_sql = mysqli_query($conn,$sql);
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['Nickname'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
      die();
   }



?>