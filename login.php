<?php
	$test = "1";
	include 'datenbank.php';
	$test = "2";
	session_start();
	$test = "3";
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$myusername = $_POST['nutzerkennung'];
		$mypassword = $_POST['kennwort']; 
		$test = "4";
		$sql = "SELECT id FROM c_nutzer WHERE n_name = '$myusername' AND n_psswd = '$mypassword'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$active = $row['active'];
		    
		$count = mysqli_num_rows($result);
		      
		      // If result matched $myusername and $mypassword, table row must be 1 row
				
		if($count == 1) {
		    session_register("myusername");
		    $_SESSION['login_user'] = $myusername;
		         
		    header("location:home.php");
		}else {
		    $error = "Your Login Name or Password is invalid";
		}
	}
?>