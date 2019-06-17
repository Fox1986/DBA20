<!DOCTYPE html>                                                                                                        <!-- HTML-Seite die als Startseite dient und das Einloggen / Registieren ermöglicht -->
<html>
   
   	<head>
      	<title>Chat</title>                                                                                           <!-- Fehstertitel -->
                                                                                                                       <!-- Styles festlegen -->
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
   
   	<body bgcolor = "#28a745">                                                                                       <!-- Hintergrund festlegen -->
      	<div align = "center">                                                                                        <!-- div-Bereich mittig ausrichten -->
         	<div style = "width:300px; border: solid 1px #333333; " align = "left">                                    
            	<div style = "background-color:#33ccff; color:#FFFFFF; padding:3px;"><b>Willkommen</b></div>
				
            	<div style = "margin:30px">
               

               	<form action = "login.php" method = "post">                                                        <!-- Bereich für den Login. Alles im form-Bereich wird mit dem Button an login.php gepostet -->
               		<h2>Anmelden:</h2>
                  	<label>Nickname  :</label><br /><input type = "text" name = "logNick" class = "box"/><br /><br />       <!-- Datenfelder zum Befüllen -->
                  	<label>Passwort  :</label><br /><input type = "password" name = "logPass" class = "box" /><br/><br />
                  	<input type = "submit" value = " Einloggen " style="background-color: #33ccff" /><br />	       <!-- Button zum Einlogen und zur Datenübergabe an das nächste PHP-Skript -->
               	</form>


               	<form action = "registrieren.php" method = "post">                                                   <!-- Bereich für das Registrieren -->
               		<h2>Noch keinen Account? Registrieren sich sie gleich hier:</h2>

                     <label>Vorname  :</label><br /><input type = "text" name = "forname" class = "box"/><br /><br />   <!-- Datenfelder zum Befüllen -->
                     <label>Nachname  :</label><br /><input type = "text" name = "name" class = "box"/><br /><br />
                  	<label>E-Mail  :</label><br /><input type = "text" name = "mail" class = "box"/><br /><br />
                     <label>Nickname  :</label><br /><input type = "text" name = "nick" class = "box"/><br /><br />
                  	<label>Passwort  :</label><br /><input type = "password" name = "pass" class = "box" /><br/><br />
                     <label>Passwort wiederholen  :</label><br /><input type = "password" name = "passCompare" class = "box" /><br/><br />
                     <input type="radio" name="geschlecht" value="m">männlich<br>                                  <!-- Auswahl eines Geschlechts. Wichtig für das Default-Avatar-Bild. -->
                     <input type="radio" name="geschlecht" value="w">weiblich<br><br>
                  	<input type = "submit" value = " Registrieren " style="background-color: #33ccff" /><br />        <!-- Button um Registrierung abzuschließen und registrieren.php aufzurufen-->
               	</form>
					
            	</div>
				
         	</div>
			
      	</div>

   	</body>
</html>