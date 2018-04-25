<?php

//connect();
	$mysql_server = "localhost"; 
	// admin 
	$mysql_admin = "pomysl_ciadm"; 
	// hasło 
	$mysql_pass = "321qaz"; 
	// nazwa baza 
	$mysql_db = "pomysl_cidb"; 
	// nawiązujemy połączenie z serwerem MySQL 

	$polaczenie = @new mysqli($mysql_server, $mysql_admin, $mysql_pass, $mysql_db);
	if (mysqli_connect_errno() != 0){
	echo '<p>Wystąpił błąd połączenia: ' . mysqli_connect_error() . '</p>';
	}
	else {        
	// tutaj kod wykonywany, gdy zostało uzyskane połączenie z bazą
	echo "CI-BOT: Nawiązane połączenie z bazą</br>";
	}	

//pokaz_historie_rozmow();
	$wynik_history_talk = @$polaczenie -> query("SELECT id_talk, talk FROM talk_history");
	if ($wynik_history_talk === false){
		echo '<p>Zapytanie SELECT o historię nie zostało wykonane poprawnie!</p>';
		$polaczenie -> close();
	}

	elseif (mysqli_num_rows($wynik_history_talk) == 0){ //czy isnieją rekordy z historią
		echo "Brak historii rozmów</br>";
	}

	else {	
		echo "Historia:</br>";	
		while (($talk_history = $wynik_history_talk -> fetch_assoc()) !== null) //fetch_assoc pobiera tablicę asocjacyjną, czyli nazwy kolumn tabeli
		{
			$id_talk = $talk_history['id_talk'];
			$talk = $talk_history['talk'];

			//wyświetlenie historii 				
			echo "$id_talk,";
			echo "$talk</br>";			
		}
		//$wynik_history_talk -> close(); // zwolnienie pamięci
		//$polaczenie -> close();
	}

	
if($_SERVER['REQUEST_METHOD'] == 'POST')
{ 
	//echo "USER: ".$_POST['question']."</br>";
	
//dodaj_rozmowe_do_db();

	//add talk ze stringa
		//$wynik_add_talk = @$polaczenie -> query("INSERT INTO talk_history (talk) VALUES ('test wpisu do historii i test polskich znaków: ąęł')");

	//add talk ze zmiennej
		//$add_talk = "ze zmiennej test wpisu do historii i test polskich znaków: ąęł";
		//echo "$add_talk";
		//$wynik_add_talk = @$polaczenie -> query("INSERT INTO talk_history (talk) VALUES ('$add_talk')");

	//add talk ze zmiennej z POST
		$add_talk = $_POST['question'];
		//echo "$add_talk_post</br>";
		$wynik_add_talk = @$polaczenie -> query("INSERT INTO talk_history (talk) VALUES ('$add_talk')");
		

		if ($wynik_add_talk === false){
			echo 'Fail INSERT - dodanie rozmowy do DB nie powiodło się!</br>';
			$polaczenie -> close();
		}
		else {
			echo "JA: $add_talk</br>";
			echo "Powodzenie INSERT - dodano rozmowę do DB</br>";	
		
		//$wynik_add_talk -> close(); // zwolnienie pamięci
		//$polaczenie -> close();
		}
	
}
else {
	echo "CI-BOT: Teraz możesz coś wpisać !</br>";
}

	 echo '<form method="post">
	 USER: <input type="text" name="question" />
	 <input type="submit" value="zapytaj">
	 </form>';

 
?>