<?php
	session_start();
	include 'datenbank.php';
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{	
		
		$ich = $_SESSION['login_user'];
		$_SESSION['guest'] = $_POST['rooms'];
		$du = $_SESSION['guest'];
		$host = 0;
		$tableGuest = "Chat_".$du. "_" .$ich;

		$_SESSION['currentChat'] = $tableGuest;
		$sql = "SELECT * FROM Rooms WHERE Chat = '$tableGuest'";						
		
		foreach ($db -> query($sql) as $zeile) 										
			{
				$_SESSION[$zeile['ID']] = $zeile['ID'];
			}
		$anwesenheit = "UPDATE Rooms SET GuestAnwesend = TRUE WHERE Chat = '$tableGuest'";
	    $db -> exec($anwesenheit);
	}

	header("Location:chat.php");
?>

