<!-- Dieses Skript erstellt einen Chat als Host. Der Chatpartner wird eingeladen -->

<?php
	session_start();																		/* Session einbinden */
	include 'datenbank.php';																/* Datenbank einbinden */
	
	if($_SERVER["REQUEST_METHOD"] == "POST")												/* Prüfen ob Skirpt mit POST-Methode aufgerufen wurde */
	{	
		$du="fehlt";																		/* Testvariable erstellen */
		$ich = $_SESSION['login_user'];														/* Eigenen Nickname in Variable speichern */
		$_SESSION['guest'] = $_POST['freunde'];												/* Session Gast anlegen */
		$du = $_SESSION['guest'];															/* Gast in Variable speichern */

		$busy = "SELECT Busy FROM User WHERE Nickname = '$du'";								/* Abfrage ob gewählte Person bereits in einem Chat ist */
		$result = $db -> query($busy);														/* Befehl ausführen */
		$test = $result -> fetch();															/* Daten speichern */
		
		if (!isset($_POST['freunde']))														/* Test ob Chatpartner gewählt wurde */
		{																					/* Auswahl kann durch Javascript-Aktualisierung verloren gehen */
			echo "<script LANGUAGE='JavaScript'> 															
				window.alert('Keinen Chatpartner gewählt!'); 
				window.location.href='http://localhost/home.php'; </script>";				/* PopUp-Fenster Fehlermeldung, wenn Auswahl verloren geht*/
		}else
		{
			if ($test['Busy'] == TRUE)														/* Test ob Chatpartner bereits in einem Chat ist */
			{
				echo "<script LANGUAGE='JavaScript'> 															
					window.alert('User ist bereits in einem Chat'); 
					window.location.href='http://localhost/home.php'; </script>";			/* PopUp-Fenster Fehlermeldung, wenn User bereits in einem Chat*/
				
			}else
			{
				$tableHost = "Chat_".$ich. "_" .$du;										/* Eindeutigen Tabellennamen für Datenbank erstellen */

				$_SESSION['currentChat'] = $tableHost;										/* Tabellenname als aktueller Chartraum in Session speichern */
				
				$resultHost = $db->query("SHOW TABLES LIKE '$tableHost'");					/* SQL Abfrage, ob Tabelle existiert */
				$zahlHost = $resultHost->rowCount();										/* Befehl ausführen */
			    if( $zahlHost == 0) 														/* Test ob Tabelle existiert wenn der Chat nicht ordentlich beendet wurde */
			  		    																	/* Wenn ja, keine neue Tabelle anlegen */
			    {																			/* Falls noch kein Chat besteht neue Tabelle anlegen */
			    	$newTable = "CREATE TABLE $tableHost (ID INT(11) AUTO_INCREMENT PRIMARY KEY, Sender VARCHAR(100), Zeit TIMESTAMP, Nachricht TEXT)";
			    	$db -> exec($newTable);													/* Befehl ausführen */
			    }

			    
			    $sql = "SELECT ID FROM Rooms WHERE Chat = '$tableHost'";					/* SQL-Befehl ob Chatroom im Verzeichnis eingetragen wurde */
				$result = $db -> query($sql);

				
				if ($result -> rowCount() == 0)												/* Wenn noch kein Eintrag besteht und Testvariable mit Gast belegt wurde */
				{
					$chatRoom = "INSERT INTO Rooms (Host, Guest, Chat) VALUE ('$ich', '$du', '$tableHost')";	/* Trage Chatraum in Tabelle ein */
			    	$db -> exec($chatRoom);
			    	
			    	$anwesenheit = "UPDATE User SET Busy = TRUE WHERE Nickname = '$ich'";	/* Host wird auf beschäftigt gesetzt, um Chatanfragen zu verhindern */
			    	$db -> exec($anwesenheit);
				}
				header("Location:chat.php");												/* Weiterleitung an chat.php */
			}
		}
	}
?>

