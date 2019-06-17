<?php
	session_start();
	include 'datenbank.php';
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{	
		$du = 'fehlt';
		$ich = $_SESSION['login_user'];
		$_SESSION['guest'] = $_POST['freunde'];
		$du = $_SESSION['guest'];
		$host = 0;
		$tableHost = "Chat_".$ich. "_" .$du;

		$_SESSION['currentChat'] = $tableHost;
		
		$resultHost = $db->query("SHOW TABLES LIKE '$tableHost'");
		$zahlHost = $resultHost->rowCount();
	    if( $zahlHost > 0) {
	        echo 'Host';
	        $host = 1;
	    }else{
	    	echo 'new Host';
	    	$newTable = "CREATE TABLE $tableHost (ID INT(11) AUTO_INCREMENT PRIMARY KEY, Sender VARCHAR(100), Zeit TIMESTAMP, Nachricht TEXT)";
	    	$db -> exec($newTable);
	    	$host = 1;
	    }
	    $sql = "SELECT * FROM Rooms WHERE Chat = '$tableHost'";						
		$test = 0;
		foreach ($db -> query($sql) as $zeile) 										
			{
				$_SESSION[$zeile['ID']] = $zeile['ID'];
				if ($zeile['Chat'] == '$tableHost')													
				{
					$test = $test +1;
				}else
				{
					$test = $test +0;	
				}	
			}
		if ($test == 0  && $du != 'fehlt')
		{
			$chatRoom = "INSERT INTO Rooms (Host, Guest, Chat) VALUE ('$ich', '$du', '$tableHost')";
	    	$db -> exec($chatRoom);
	    	
	    	$anwesenheit = "UPDATE Rooms SET HostAnwesend = TRUE WHERE Chat = '$tableHost'";
	    	$db -> exec($anwesenheit);
	    	

		}
	    
	}
	header("Location:chat.php");
?>

