<!-- Startseite für die Mitarbeiter, wo sie sich mit ihrer Rolle einloggen können. Z.B. der Admin. Registrierung nicht notwendig, da man sich keine Rolle selbst zuteilen kann, sondern dies durch ensprechende Stellen im Unternehmen vorgenommen und in die Datenbank eingepflegt wird -->

<!DOCTYPE html>                                                                                       
<html>
   
   	<head>
      	<title>Chat</title>                                                                          <!-- Fehstertitel -->
                                                                                                      <!-- Styles werden hier direkt im Dokument festgelegt -->
      	<style type = "text/css">                                                                                     
         	body {
            	font-family:Arial, Helvetica, sans-serif;
            	font-size:14px;
         	}
         	label {
            	font-weight:bold;
            	width:100px;
            	font-size:14px;
         	}
         	.box {
            	border:#666666 solid 1px;
         	}
      	</style>
      
   	</head>
   
   	<body bgcolor = "#33ccff">                                                                                       <!-- Hintergrund festlegen -->
      	<div align = "center">                                                                                        <!-- div-Bereich mittig ausrichten -->
         	<div style = "width:300px; border: solid 1px #333333; " align = "left">                                    
            	<div style = "background-color:#33ccff; color:#FFFFFF; padding:3px;"><b>Willkommen</b></div>
            	<div style = "margin:30px">
               	<form action = "persLogin.php" method = "post">                                                    <!-- Login-Daten werden an login.php gepostet -->
               		<h2>Anmelden:</h2>
                  	<label>Nickname  :</label><br /><input type = "text" name = "logNick" class = "box"/><br /><br />       <!-- Datenfelder zum Befüllen -->
                  	<label>Passwort  :</label><br /><input type = "password" name = "logPass" class = "box" /><br/><br />
                  	<input type = "submit" value = " Einloggen " style="background-color: #33ccff" /><br />	       <!-- Button zum Einlogen -->
               	</form>
            	</div>
         	</div>
      	</div>
   	</body>
</html>