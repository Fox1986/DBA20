<?php
	session_start();
	include 'datenbank.php';
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$type = $_POST['beenden'];
		$chat = $_POST['chat'];
	    if( $type == "Host") 
	    {
	        $killTable = "DROP TABLE $chat";
	        $db -> exec($killTable);
	        $deleteRoom = "DELETE FROM Rooms WHERE Chat = '$chat'";
	        $db -> exec($deleteRoom);
	        echo "<script type='text/javascript'>window.close();</script>";
	    }else
	    {
	    	echo "<script type='text/javascript'>window.close();</script>";
	    }
	}
?>