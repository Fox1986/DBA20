<?php
if (!isset($_SESSION))
{
	session_start();
}
require_once('datenbank.php');

class Chat
{
	public $db;
	public $p1;
	public $p1Func;
	public $p1Avatar;
	public $p1Vorname;
	public $p1Nachname;
	public $p1Email;
	public $p1Strasse;
	public $p1Hausnummer;
	public $p1Plz;
	public $p1Wohnort;
	public $p2;
	public $p2Func;
	public $p2Avatar;
	public $p2Vorname;
	public $p2Nachname;
	public $p2Email;
	public $p2Strasse;
	public $p2Hausnummer;
	public $p2Plz;
	public $p2Wohnort;
	public $cr;

	public function __construct()
	{
		$this-> db = new PDO("mysql:dbname=DBA20;host=localhost","root", "akad");
		$this-> p1 = $_SESSION['login_user'];
		$this-> p2 = $_SESSION['guest'];
		$this-> cr = $_SESSION['currentChat'];
		$this ->hostguest();
		$this ->getData($this-> p1);
		$this ->getData($this-> p2);
	}

	private function hostguest()
	{
		$sql = "SELECT * FROM Rooms WHERE Chat = '$this->cr'";
		foreach ($this-> db->query($sql) as $zeile)
		{
			if ($zeile['Host'] == $this-> p1)
			{
				$this-> p1Func = "HOST";
				$this-> p2Func = "GUEST";
			}else
			{
				$this-> p1Func = "GUEST";
				$this-> p2Func = "HOST";
			} 
		}
	}

	private function getData($pers)
	{
		$sql="SELECT * FROM User WHERE Nickname = '$pers'";
		$data = $this-> db->query($sql);
		if ($pers == $this-> p1)
		{
			while($row = $data->fetch(PDO::FETCH_ASSOC)){
				$this-> p1Avatar = "Avatar/".$pers.".png";	/* Variable für das User-Bild */
					
				if (!file_exists($this-> p1Avatar))	/* Test ob User Bild hochgeladen hat */
				{
					if ($row['Geschlecht'] == "m")	/* Geschlechtsabhängiges Default-Profilbild */
					{
						$this-> p1Avatar ='Avatar/avatarMD.png';
					}else
					{
						$this-> p1Avatar ='Avatar/avatarWD.png';
					}
				}		
				if ($row["Public"] == 1)	/* Zusatzinformationen wenn die der Partner öffentlich gemacht hat */
				{
					$this->  p1Vorname = $row['Vorname'];
					$this->  p1Nachname = $row['Nachname'];
					$this->  p1Email = $row['Email'];
					$this->  p1Strasse = $row['Strasse'];
					$this->  p1Hausnummer = $row['Hausnummer'];
					$this->  p1Plz = $row['Plz'];
					$this->  p1Wohnort = $row['Wohnort'];
				}
			}
		}elseif ($pers == $this->p2) {
			while($row = $data->fetch(PDO::FETCH_ASSOC)){
				$this-> p2Avatar = "Avatar/".$pers.".png";	/* Variable für das User-Bild */
					
				if (!file_exists($this-> p2Avatar))	/* Test ob User Bild hochgeladen hat */
				{
					if ($row['Geschlecht'] == "m")	/* Geschlechtsabhängiges Default-Profilbild */
					{
						$this-> p2Avatar ='Avatar/avatarMD.png';
					}else
					{
						$this-> p2Avatar ='Avatar/avatarWD.png';
					}
				}		
				if ($row["Public"] == 1)	/* Zusatzinformationen wenn die der Partner öffentlich gemacht hat */
				{
					$this->  p2Vorname = $row['Vorname'];
					$this->  p2Nachname = $row['Nachname'];
					$this->  p2Email = $row['Email'];
					$this->  p2Strasse = $row['Strasse'];
					$this->  p2Hausnummer = $row['Hausnummer'];
					$this->  p2Plz = $row['Plz'];
					$this->  p2Wohnort = $row['Wohnort'];
				}
			}
		}
	}

	private function verlauf()
	{
		$table = $this -> cr;
		$sql="SELECT * FROM $table";										/* Lese den Chat aus */
		$verlauf = $this-> db->query($sql);
		foreach ($verlauf as $zeile) 											/* Gebe alles aus, was in der Datenbank steht */
		{
			echo "".$zeile["Sender"]. "<br>";
			echo "".$zeile["Zeit"]. ":: ".$zeile["Nachricht"]. "<br>";
			echo "<br>";
		}
	}

	public function ausgabe()
	{
	
		echo '<div id="main">';
			echo '<h1>Chat</h1>';
			echo '<div id="output">';
			
			$this->verlauf();
			
			echo '</div>';
			echo '<form method="post" action="send.php">';
			
			echo '<textarea name="nachricht" placeholder="Tippen um Nachricht zu senden..." class="form-control"></textarea><br>';

			echo '<input style="font-size: 20px;" type="submit" value="Abschicken" >';

			echo '</form>';
			echo '<br>';
				
		echo '</div>';



		echo '<div id = "chatpartner">';

			echo '<div id="du">';											
				$du = $this -> p2;
				$datei = $this -> p2Avatar;
				$Vorname = $this -> p2Vorname;
				$Nachname = $this -> p2Nachname;
				$Email = $this -> p2Email;
				$Strasse = $this -> p2Strasse;
				$Hausnummer = $this -> p2Hausnummer;
				$Plz = $this -> p2Plz;
				$Wohnort = $this -> p2Wohnort;

				echo "<h1>$du</h1>";
				echo "<div class='output'>";
				echo " <img src='$datei' alt='Avatar' class='avatar'> <br>";
				echo "<br>";
				echo "$Vorname<br>";
				echo "$Nachname<br>";
				echo "$Email<br>";
				echo "$Strasse $Hausnummer<br>";
				echo "$Plz $Wohnort<br>";
				echo "</div>";
				echo "<br>";	
			echo '</div>';

			echo '<div id="ich">';											
				$ich = $this -> p1;
				$datei = $this -> p1Avatar;
				$Vorname = $this -> p1Vorname;
				$Nachname = $this -> p1Nachname;
				$Email = $this -> p1Email;
				$Strasse = $this -> p1Strasse;
				$Hausnummer = $this -> p1Hausnummer;
				$Plz = $this -> p1Plz;
				$Wohnort = $this -> p1Wohnort;
					
				echo "<h1>$ich</h1>";
				echo "<div class='output'>";
				echo " <img src='$datei' alt='Avatar' class='avatar'> <br>";
				echo "<br>";
				echo "$Vorname<br>";
				echo "$Nachname<br>";
				echo "$Email<br>";
				echo "$Strasse $Hausnummer<br>";
				echo "$Plz $Wohnort<br>";
				echo "</div>";
				echo "<br>";	
			echo "</div>";
		echo "</div>";
		
		echo '<div id="steuerung">';					
			echo '<form action="ende.php" method="post">';					
				$chat = $this -> cr;
				$partner = "SELECT * FROM Rooms";
					foreach ($this-> db->query($partner) as $zeile)
					{
						if ($zeile['Guest'] == $ich && $zeile['Chat'] == $this -> cr)
						{
							echo "<input type='hidden' name='beenden' value='Guest'>";
							echo "<input type='hidden' name='chat' value='$chat'>";
							echo "<input type='submit' value='Chat verlassen'>";
						}elseif ($zeile['Host'] == $ich && $zeile['Chat'] == $this -> cr) 
						{
							echo "<input type='hidden' name='beenden' value='Host'>";
							echo "<input type='hidden' name='chat' value='$chat'>";
							echo "<input type='submit' value='Chat beenden'>";
						}
					}
			echo '</form>';			
		echo "</div>";
		
		
	}
}
?>