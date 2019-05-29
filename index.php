<!DOCTYPE html>
<html>
   
   	<head>
      	<title>Chat</title>
      
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
   
   	<body bgcolor = "#FFFFFF">
      	<div align = "center">
         	<div style = "width:300px; border: solid 1px #333333; " align = "left">
            	<div style = "background-color:#28a745; color:#FFFFFF; padding:3px;"><b>Willkommen</b></div>
				
            	<div style = "margin:30px">
               

               	<form action = "login.php" method = "post">
               		<h2>Anmelden:</h2>
                  	<label>Nickname  :</label><br /><input type = "text" name = "logNick" class = "box"/><br /><br />
                  	<label>Passwort  :</label><br /><input type = "password" name = "logPass" class = "box" /><br/><br />
                  	<input type = "submit" value = " Einloggen " style="background-color: #28a745" /><br />	
               	</form>


               	<form action = "registrieren.php" method = "post">
               		<h2>Noch keinen Account? Registrieren sich sie gleich hier:</h2>
                     <label>Vorname  :</label><br /><input type = "text" name = "forname" class = "box"/><br /><br />
                     <label>Nachname  :</label><br /><input type = "text" name = "name" class = "box"/><br /><br />
                  	<label>E-Mail  :</label><br /><input type = "text" name = "mail" class = "box"/><br /><br />
                     <label>Nickname  :</label><br /><input type = "text" name = "nick" class = "box"/><br /><br />
                  	<label>Passwort  :</label><br /><input type = "password" name = "pass" class = "box" /><br/><br />
                     <label>Passwort wiederholen  :</label><br /><input type = "password" name = "passCompare" class = "box" /><br/><br />
                  	<input type = "submit" value = " Registrieren " style="background-color: #28a745" /><br />
               	</form>
               


               	<div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            	</div>
				
         	</div>
			
      	</div>

   	</body>
</html>