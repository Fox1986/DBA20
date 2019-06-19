<!-- HTML-Seite die als Startseite dient und das Einloggen / Registieren ermöglicht -->

<!DOCTYPE html>                                                                                                        
<html>
   <head>
    	<title>Chat</title>                                                                       <!-- Fenstertitel -->
   
      <link rel="stylesheet" type="text/css" href="index.css">                                  <!-- css-Datei einbinden -->
   </head>
   
 	<body>                                                                                                 
      <div id= "main" >                                                                                
         	                           
         <div id="name"><b>Willkommen</b></div>                                              <!-- Überschrift für den Bereich festlegen -->
				
         <div id="logreg">
           	<form action = "login.php" method = "post">                                      <!-- Log-In: Weiterleitung der Daten an login.php --> 
           		<h2>Anmelden:</h2>
              	<label>Nickname  :</label><br /><input type = "text" name = "logNick" class = "box"/><br /><br />       <!-- Datenfelder zum Befüllen -->
              	<label>Passwort  :</label><br /><input type = "password" name = "logPass" class = "box" /><br/><br />
              	<input type = "submit" value = " Einloggen " /><br />	                        <!-- Button -->
           	</form>


           	<form action = "registrieren.php" method = "post">                               <!-- Registrieren: Weiterleitung der Daten an registrieren.php -->
           		<h2>Noch keinen Account? Registrieren sich sie gleich hier:</h2>
               <label>Vorname  :</label><br /><input type = "text" name = "forname" class = "box"/><br /><br />        <!-- Datenfelder zum Befüllen -->
               <label>Nachname  :</label><br /><input type = "text" name = "name" class = "box"/><br /><br />
             	<label>E-Mail  :</label><br /><input type = "text" name = "mail" class = "box"/><br /><br />
               <label>Nickname  :</label><br /><input type = "text" name = "nick" class = "box"/><br /><br />
            	<label>Passwort  :</label><br /><input type = "password" name = "pass" class = "box" /><br/><br />
               <label>Passwort wiederholen  :</label><br /><input type = "password" name = "passCompare" class = "box" /><br/><br />
               <input type="radio" name="geschlecht" value="m">männlich<br>                  <!-- Auswahl eines Geschlechts. Wichtig für das Default-Avatar-Bild. -->
               <input type="radio" name="geschlecht" value="w">weiblich<br><br>
             	<input type = "submit" value = " Registrieren "/><br />                       <!-- Button -->
           	</form>					
         </div>
      </div>
  	</body>
</html>