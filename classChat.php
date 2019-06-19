<!-- Dieses Skript erstellt eine Klasse für den Chat, indem alle wichtigen Personendaten eingelesen werden -->

<?php
if (!isset($_SESSION))
{
	session_start();																	/* Session einbinden, falls noch nicht vorhanden */
}


class Chat 																				/* Klasse erstellen */
{
	private $db;																		/* Variablen erstellen */
	private $p1;																		/* p1 sind alle Daten des eigenen Accounts */
	private $p1Func;
	private $p1Avatar;
	private $p1Vorname;
	private $p1Nachname;
	private $p1Email;
	private $p1Strasse;
	private $p1Hausnummer;
	private $p1Plz;
	private $p1Wohnort;
	private $p2;																		/* p2 sind alle Daten des Chatpartners */
	private $p2Func;
	private $p2Avatar;
	private $p2Vorname;
	private $p2Nachname;
	private $p2Email;
	private $p2Strasse;
	private $p2Hausnummer;
	private $p2Plz;
	private $p2Wohnort;
	private $cr;																		/* cr ist der Chatraum */

	public function __construct()														/* Konstruktor */
	{
		$this-> db = new PDO("mysql:dbname=DBA20;host=localhost","root", "akad");		/* Datenbankverbindung aufbauen */
		$this-> p1 = $_SESSION['login_user'];											/* p1 mit Nickname vom eigenen Account belegen */
		$this-> p2 = $_SESSION['guest'];												/* p2 mit Nickname vom Chatpartner belegen */
		$this-> cr = $_SESSION['currentChat'];											/* cr mit Chatraum-Name belegen */
		
		$this ->getData($this-> p1);													/* Funktionsaufruf um eigenen Daten in Variablen zu laden */
		$this ->getData($this-> p2);													/* Funktionsaufruf um Daten des Chatpartners in Variablen zu laden */
	}

	private function getData($pers)														/* Funktion um Accountdaten aus Datenbank zu laden */
	{
		$sql="SELECT * FROM User WHERE Nickname = '$pers'";								/* SQL-Abfrage zu den Accountdaten */
		$data = $this-> db->query($sql);												/* Befehl ausführen */
		if ($pers == $this-> p1)														/* Unterscheiden wessen Daten in welche Variablen kommen */
		{
			while($row = $data->fetch(PDO::FETCH_ASSOC))								/* While-Schleife um die Daten alle auszulesen */
			{
				$this-> p1Avatar = "Avatar/".$pers.".png";								/* Variable für das User-Bild */
					
				if (!file_exists($this-> p1Avatar))										/* Test ob User Bild hochgeladen hat */
				{
					if ($row['Geschlecht'] == "m")										/* Geschlechtsabhängiges Default-Profilbild */
					{
						$this-> p1Avatar ='Avatar/avatarMD.png';						/* männlich */
					}else
					{
						$this-> p1Avatar ='Avatar/avatarWD.png';						/* weiblich */
					}
				}		
				if ($row["Public"] == 1)												/* Zusatzinformationen laden, wenn Veröffentlichung erlaubt */
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
		}elseif ($pers == $this->p2) 													/* Abschnitt für die Daten von p2 */
		{
			while($row = $data->fetch(PDO::FETCH_ASSOC))								/* While-Schleife um die Daten alle auszulesen */
			{
				$this-> p2Avatar = "Avatar/".$pers.".png";								/* Variable für das User-Bild */
					
				if (!file_exists($this-> p2Avatar))										/* Test ob User Bild hochgeladen hat */
				{
					if ($row['Geschlecht'] == "m")										/* Geschlechtsabhängiges Default-Profilbild */
					{
						$this-> p2Avatar ='Avatar/avatarMD.png';						/* männlich */
					}else
					{
						$this-> p2Avatar ='Avatar/avatarWD.png';						/* weiblich */
					}
				}		
				if ($row["Public"] == 1)												/* Zusatzinformationen laden, wenn Veröffentlichung erlaubt */
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

	private function verlauf()															/* Funktion um den Chatverlauf auszugeben */
	{
		$table = $this -> cr;															/* Chautraum in Variable legen */
		$sql="SELECT * FROM $table";													/* SQL-Befehl zum Einlesen der Daten aus der Tabelle */
		$verlauf = $this-> db->query($sql);												/* Befehl ausführen */
		foreach ($verlauf as $zeile) 													/* Gebe alles aus, was in der Datenbank steht */
		{
			echo "".$zeile["Sender"]. "<br>";
			echo "".$zeile["Zeit"]. ":: ".$zeile["Nachricht"]. "<br>";
			echo "<br>";
		}
	}

	public function ausgabeVerlauf()													/* Funktion für das HTML-Rahmenwerk der Verlaufsausgabe */
	{
	
		echo '<div id="main">';															/* DIV mit ID belegen */
			echo '<h1>Chat</h1>';														/* Überschrift festlegen */
			echo '<div id="output">';													/* DIV für den eigentlichen Verlauf */
			
			$this->verlauf();															/* Aufruf der privaten Verlaufsfunktion */
			
			echo '</div>';
			echo '<form method="post" action="send.php">';								/* Eingegebene Nachrichten werden an send.php weitergeleitet */
			
			echo '<textarea name="nachricht" placeholder="Tippen um Nachricht zu senden..." class="form-control"></textarea><br>'; /* Textbereich für die Nachrichten */

			echo '<input style="font-size: 20px;" type="submit" value="Abschicken" >';	/* Button zum Abschicken der Nachrichten */

			echo '</form>';
			echo '<br>';
				
		echo '</div>';
	}

	public function ausgabeDu()															/* Funktion um die den Bereich für den Chatpartner zu erstellen */
	{
		echo '<div id="du">';											
				$du = $this -> p2;														/* Daten in Variablen legen */
				$datei = $this -> p2Avatar;
				$Vorname = $this -> p2Vorname;
				$Nachname = $this -> p2Nachname;
				$Email = $this -> p2Email;
				$Strasse = $this -> p2Strasse;
				$Hausnummer = $this -> p2Hausnummer;
				$Plz = $this -> p2Plz;
				$Wohnort = $this -> p2Wohnort;

				echo "<h1>$du</h1>";													/* PHP-Variablen in den gewünschten HTML-Code verpacken */
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
	}
		
	public function ausgabeIch()														/* Funktion um den Bereich für die eigenen Daten zu erstellen */
	{
		echo '<div id="ich">';											
				$ich = $this -> p1;														/* Daten in Variablen legen */
				$datei = $this -> p1Avatar;
				$Vorname = $this -> p1Vorname;
				$Nachname = $this -> p1Nachname;
				$Email = $this -> p1Email;
				$Strasse = $this -> p1Strasse;
				$Hausnummer = $this -> p1Hausnummer;
				$Plz = $this -> p1Plz;
				$Wohnort = $this -> p1Wohnort;
					
				echo "<h1>$ich</h1>";													/* PHP-Variablen in den gewünschten HTML-Code verpacken */
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
	}		

	public function ausgabeSteuerung()													/* Funktion um Bereich für zusätzliche Steuerelemente zu erstellen */	
	{	
		echo '<div id="steuerung">';					
			echo '<form action="ende.php" method="post">';								/* Daten werden an ende.php weitergeleitet */		
				$chat = $this -> cr;															/* Chatraum in Variable legen */
				$partner = "SELECT * FROM Rooms";
					foreach ($this-> db->query($partner) as $zeile)								/* Alle Verfügbaren Chats durchsuchen */
					{
						if ($zeile['Guest'] == $this -> p1 && $zeile['Chat'] == $this -> cr)	/* Wenn man selbst Gast ist und Chatraum gefunden wurde */
						{
							echo "<input type='hidden' name='beenden' value='Guest'>";			/* Übergabe, dass man Gast den Raum verlassen will */
							
							echo "<input type='submit' value='Chat verlassen'>";				/* Button zum Verlassen */
						}elseif ($zeile['Host'] == $this -> p1 && $zeile['Chat'] == $this -> cr) /* Wenn man selbst Host ist und Chatraum gefunden wurde */
						{
							echo "<input type='hidden' name='beenden' value='Host'>";			/* Übergabe, dass man als Host den Chat beendet */
							
							echo "<input type='submit' value='Chat beenden'>";					/* Button zum Beenden */
						}
					}
			echo '</form>';			
		echo "</div>";
	}
}
?>