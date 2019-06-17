<?php
	session_start();
	include 'datenbank.php';
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{	
		
		$_SESSION['Chat'] = $_POST['rooms'];
		
		$tableGuest = $_SESSION['Chat'];

		$_SESSION['currentChat'] = $tableGuest;
		$sql = "SELECT * FROM Rooms WHERE Chat = '$tableGuest'";						
		
		foreach ($conn -> query($sql) as $zeile) 										
			{
				$_SESSION[$zeile['ID']] = $zeile['ID'];
			}
		
	}

	header("Location:chatAdmin.php");
?>