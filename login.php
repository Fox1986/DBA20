<?php
	echo "1";
	include 'datenbank.php';
	echo "2";
	session_start();
	echo "3";
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$myusername = $_POST['nutzerkennung'];
		$mypassword = $_POST['kennwort']; 
		echo "4";
		$sql = "SELECT id FROM c_nutzer WHERE n_name = '$myusername' AND n_psswd = '$mypassword'";
		$result = mysqli_query($conn,$sql);
		//$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		//$active = $row['active'];
		echo "5";  
		//$count = mysqli_num_rows($result);
		      
		      // If result matched $myusername and $mypassword, table row must be 1 row
		echo "6";		
		if($row=$result->fetch_assoc()) {
			echo "7";
		    session_register("myusername");
		    $_SESSION['login_user'] = $myusername;
		         
		    header("location:home.php");
		}else {
		    die("Your Login Name or Password is invalid");
		}
	}
?>