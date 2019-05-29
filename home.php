
<?php
	session_start();
	include('session.php');
?>



<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="home.css">
</head>
<body>
	<div id="main">
	<h1><?php echo $_SESSION['login_user'] ?></h1>
	<div class="output">
		<?php 
		$sql="SELECT * FROM verlauf";
		$result = $conn->query($sql);
		
		$sql="SELECT * FROM Chat";
		foreach ($conn -> query($sql) as $zeile) 
		{
			echo "".$zeile["Sender"]. "<br>";
			echo "".$zeile["Zeit"]. ":: ".$zeile["Nachricht"]. "<br>";
			echo "<br>";
		}
		?>
	</div>

	<form method="post" action="send.php">
		<textarea name="Nachricht" placeholder="Tippen um Nachricht zu senden..." class="form-control"></textarea><br>
		<input style="font-size: 20px;" type="submit" value="Abschicken">
	</form>
	<br>
	
	</div>



	<div id="chatpartner">
	<h1>Aktuell</h1>
	<div class="output">
		<?php 
		$sql="SELECT * FROM verlauf";
		$result = $conn->query($sql);
		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				echo "".$row["v_name"]." " .":: ".$row["v_nachricht"]." --"-$row["v_date"]. "<br>";
				echo "<br>";
			}
		}else{
			echo "0 results";
		}
		
		?>
	</div>
	<br>
	</div>


	<div id="freunde">
	<h1>Freunde</h1>
	<div class="outputFreunde">
		<?php
		$sql="SELECT * FROM User";

		echo '<form action="#">';
		echo '<select name="freunde" size="35">';
				
		foreach ($conn -> query($sql) as $zeile) 
		{
			
			
			if ($zeile['Online'] == 1)
			{
				echo '<option><font color = "red">'.$zeile["Nickname"].'</font></option>';
			}else
			{
				echo '<option><font color = "black">'.$zeile["Nickname"].'</font></option>';
			}
			
		}
		echo '</select>';	
		echo '</form>';
		if ()
		?>
	</div>
	
	<form method="post" action="einladen.php">
		<input style="font-size: 20px;" type="submit" value="Einladen">
	</form>
	<br>
	<form action="logout.php">
		<input type="submit" value="Logout">
		
	</form>

	</div>
	<?php
	$conn->close();
	?>
	<div class="clear"></div>

</body>
</html>