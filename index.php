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
            	<div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            	<div style = "margin:30px">
               
               	<form action = "login.php" method = "post">
               		<h2>Anmelden:</h2>
                  	<label>Nutzername  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  	<label>Passwort  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  	<input type = "submit" value = " Submit "/><br />
                  	<button style="background-color: #6495ed; color: white" type="submit"> <b>Abschicken</b> </button>
               	</form>
               	<form action = "registrieren.php" method = "post">
               		<h2>Wenn Sie keinen Account haben, Registrieren sich sie bitte hier:</h2>
                  	<label>Nutzername  :</label><input type = "text" name = "uname" class = "box"/><br /><br />
                  	<label>E-Mail  :</label><input type = "text" name = "email" class = "box"/><br /><br />
                  	<label>Passwort  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  	<input type = "submit" value = " Submit "/><br />
                  	<button style="background-color: #6495ed; color: white" type="submit"> <b>Abschicken</b> </button>
               	</form>
               
               	<div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            	</div>
				
         	</div>
			
      	</div>

   	</body>
</html>