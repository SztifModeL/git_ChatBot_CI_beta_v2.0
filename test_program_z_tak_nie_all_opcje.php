
<?php

// funkcje -----------------------------------------
function connect(){	 
    // serwer 
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

}

function pokaz_formularz(){		
	echo '<form method="post">
	<input type="text" name="question" />
	<input type="submit" value="zadaj pytanie">
	</form>';
}

function pokaz_pytanie(){
	echo "<p>JA: ".$_POST['question']."</p>";
}

function czy_pyta_numer(){
	$string = $_POST['question'];

	if (preg_match("/(\d+)/",$string,$matches))
	{
		//print_r($string);
		//print_r($matches);
		//print_r($matches[0]);
		$numer = $matches[0];		
		//echo $numer;
		//echo "dopasowanie zostało znalezione.";
		echo "CI-BOT: Szukam nr integracji $numer ...</br>";
		echo "CI-BOT: Zrób SELECT do bazy i sprawdź czy istnieje w bazie</br>";
		//return $numer; //zwraca wartość i Powoduje to natychmiastowe zakończenie wykonywania funkcji i wznowienie wykonywania skryptu od linijki w której funkcja została wywołana.
		$no_q = 1;
		echo "$no_q";
	}
	else {
		//echo "dopasowanie nie zostało znalezione.";
		echo "CI-BOT: Podaj nr istniejącej integracji.</br>";
		$no_q = 0;
		echo "$no_q";
	}
}

function czy_pyta_status(){
	$q_user = $_POST['question'];	
	$kw_status = "status";

	if(stristr($q_user, $kw_status)!==False)
	{
		echo "CI-BOT: Sprawdzam Status ...</br>";
		echo "CI-BOT: Zrób SELECT do bazy i podaj jaki ma status</br>";
		$status_q = 1;
		echo "$status_q";
	}
	else {
		echo "CI-BOT: Nie zrozumiałem pytania. Zadaj pytanie z zakresu CI np. o status jakiejś integracji.</br>";
		$status_q = 0;
		echo "$status_q";
	}
}

function czy_pyta_bledy(){
	$q_user = $_POST['question'];	
	$kw_error1 = "błęd";
	$kw_error2 = "błąd";

	if((stristr($q_user, $kw_error1)!==False)OR(stristr($q_user, $kw_error2)!==False))
	{
		echo "CI-BOT: Sprawdzam błędy ...</br>";
		echo "CI-BOT: Zrób SELECT do bazy, jesli błąd to podaj jaki</br>";
		$error_q = 1;
		echo "$error_q";
	}
	else {
		echo "CI-BOT: Nie zrozumiałem pytania. Zadaj pytanie z zakresu CI np. o powód błędu jakiejś integracji.</br>";
		$error_q = 0;
		echo "$error_q";
	}
}

function czy_pyta_logi(){
	$q_user = $_POST['question'];	
	$kw_logi = "logi";

	if(stristr($q_user, $kw_logi)!==False)
	{
		echo "CI-BOT: Sprawdzam logi ...</br>";
		echo "CI-BOT: Zrób SELECT do bazy i podaj jakie ma logi</br>";
		$logi_q = 1;
		echo "$logi_q";
	}
	else {
		echo "CI-BOT: Nie zrozumiałem pytania. Zadaj pytanie z zakresu CI np. o logi z jakiejś integracji.</br>";
		$logi_q = 0;
		echo "$logi_q";
	}
}

function czy_accept_question(){
	$q_user = $_POST['question'];	
	$kw_accept1 = "tak";
	$kw_accept2 = "poproszę";
	$kw_accept3 = "yes";
	$kw_accept4 = "accept";

	if((stristr($q_user, $kw_accept1)!==False)
	OR(stristr($q_user, $kw_accept2)!==False)
	OR(stristr($q_user, $kw_accept3)!==False)
	OR(stristr($q_user, $kw_accept4)!==False))
	{
		echo "CI-BOT: Już pokazuję ...</br>";
		echo "CI-BOT: Zrób SELECT do bazy</br>";
		$accept_q = 1;
		echo "$accept_q";
	}
	else {
		echo "CI-BOT: Nie zrozumiałem. Rozpoznaję: tak, poproszę, yes, accept.</br>";
		$accept_q = 0;
		echo "$accept_q";
	}
}

function czy_negation_question(){
	$q_user = $_POST['question'];	
	$kw_negation1 = "nie";
	$kw_negation2 = "no";

	if((stristr($q_user, $kw_negation1)!==False)
	OR(stristr($q_user, $kw_negation2)!==False))
	{
		//echo "CI-BOT: OK. Zrozumiałem że nie.</br>";
		$negation_q = 1;
		//echo "$negation_q";
	}
	else {
		//echo "CI-BOT: Nie zrozumiałem. Rozpoznaję: nie oraz no.</br>";
		$negation_q = 0;
		//echo "$negation_q";
	}
}

// specjalistyczne funkcje --------------------------
function jaki_status_numeru(){
	$wynik = @$polaczenie -> query("SELECT id_integration, status_integration, error_integration, log_integration FROM ci_table WHERE id_integration = $numer");
	if ($wynik === false){
		echo '<p>Zapytanie SELECT o integrację nie zostało wykonane poprawnie!</p>';
		$polaczenie -> close();
	}

	elseif (mysqli_num_rows($wynik) == 0){ //czy isnieje taki numer w bazie
		echo "CI-BOT: Niepoprawny nr zmiany. Zmiana $numer nie istnieje</br>";
	}

	else {				
		while (($numer_status = $wynik -> fetch_assoc()) !== null) //fetch_assoc pobiera tablicę asocjacyjną, czyli nazwy kolumn tabeli
		{ 
			$id_integration = $numer_status['id_integration'];
			$status_integration = $numer_status['status_integration'];			
			$error_integration = $numer_status['error_integration'];
			$log_integration = $numer_status['log_integration'];

			//odpowiedzi 
			echo "CI-BOT: Znalazłem</br>";
			echo "CI-BOT: Zmiana o numerze: $id_integration ";
			echo "ma status: $status_integration</br>";
			echo "ma logi: $log_integration</br>";
			
			if ($error_integration == 0){
				echo "nie ma błędów</br>";
			}
			else {
				echo "ma błąd: $error_integration</br>";
			}
			
		}
		//$wynik -> close(); // zwolnienie pamięci
		//$polaczenie -> close();
	}

}

function pokaz_historie_rozmow(){
	$wynik_history_talk = @$polaczenie -> query("SELECT id_talk, talk FROM talk_history");
	if ($wynik_history_talk === false){
		echo "Zapytanie SELECT o historię nie zostało wykonane poprawnie!</br>";
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
			echo "<p>";
			//echo "$id_talk,";
			echo "$talk";
			echo "</p>";	
		}
		//$wynik_history_talk -> close(); // zwolnienie pamięci
		//$polaczenie -> close();
	}
}

function dodaj_rozmowe_do_db(){

	//add talk ze stringa
		//$wynik_add_talk = @$polaczenie -> query("INSERT INTO talk_history (talk) VALUES ('test wpisu do historii i test polskich znaków: ąęł')");

	//add talk ze zmiennej
		//$add_talk = "ze zmiennej test wpisu do historii i test polskich znaków: ąęł";
		//echo "$add_talk";
		//$wynik_add_talk = @$polaczenie -> query("INSERT INTO talk_history (talk) VALUES ('$add_talk')");

	//add talk ze zmiennej z POST
		$add_talk = $_POST['question'];
		//echo "$add_talk_post</br>";
		$wynik_add_talk = @$polaczenie -> query("INSERT INTO talk_history (talk) VALUES ('JA: $add_talk')");
		

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

function pobierz_max_id_talk(){
		$wynik_max_id_talk = @$polaczenie -> query("SELECT id_talk FROM talk_history ORDER BY id_talk DESC LIMIT 1");
		if ($wynik_max_id_talk === false){
			echo '<p>Zapytanie SELECT o historię nie zostało wykonane poprawnie!</p>';
			$polaczenie -> close();
		}

		elseif (mysqli_num_rows($wynik_max_id_talk) == 0){ // jesli nie ma wyników dla zapytania
			echo "Brak historii rozmów</br>";
		}

		else {	
			while (($max_id_talk_history = $wynik_max_id_talk -> fetch_assoc()) !== null) //fetch_assoc pobiera tablicę asocjacyjną, czyli nazwy kolumn tabeli
			{
				$max_id_talk = $max_id_talk_history['id_talk'];				
				echo "max_id_talk: $max_id_talk</br>";			
			}
			//$wynik_max_id_talk -> close(); // zwolnienie pamięci
			//$polaczenie -> close();
		}
}

function pobierz_last_question(){
		$id_last_question = $max_id_talk - 2;
		echo "id_last_question: $id_last_question</br>";

			$wynik_last_question = @$polaczenie -> query("SELECT talk FROM talk_history WHERE id_talk = $id_last_question");
			if ($wynik_last_question === false){
				echo '<p>Zapytanie SELECT o historię nie zostało wykonane poprawnie!</p>';
				$polaczenie -> close();
			}
			elseif (mysqli_num_rows($wynik_last_question) == 0){ // jesli nie ma wyników dla zapytania
				echo "CI-BOT: Nie ma wyników dla zapytania o takie id_last_question: $id_last_question</br>";
			}

			else {	
				while (($last_question_history = $wynik_last_question -> fetch_assoc()) !== null) //fetch_assoc pobiera tablicę asocjacyjną, czyli nazwy kolumn tabeli
				{
					$last_question = $last_question_history['talk'];
					echo "last question: $last_question</br>";		
				}
				//$wynik_last_question -> close(); // zwolnienie pamięci
				//$polaczenie -> close();
			}
}

// program ------------------------------------------

//connect();
	include('inc_connect.php');

//pokaz_historie_rozmow();
	$wynik_history_talk = @$polaczenie -> query("SELECT id_talk, talk FROM talk_history");
	if ($wynik_history_talk === false){
		echo "Zapytanie SELECT o historię nie zostało wykonane poprawnie!</br>";
		$polaczenie -> close();
	}

	elseif (mysqli_num_rows($wynik_history_talk) == 0){ //czy isnieją rekordy z historią
		echo "Brak historii rozmów</br>";
	}

	else {	
		//echo "Historia:</br>";	
		while (($talk_history = $wynik_history_talk -> fetch_assoc()) !== null) //fetch_assoc pobiera tablicę asocjacyjną, czyli nazwy kolumn tabeli
		{
			$id_talk = $talk_history['id_talk'];
			$talk = $talk_history['talk'];

			//wyświetlenie historii 
			echo "<p>";
			//echo "$id_talk,";
			echo "$talk";
			echo "</p>";				
		}
		//$wynik_history_talk -> close(); // zwolnienie pamięci
		//$polaczenie -> close();
	}


if($_SERVER['REQUEST_METHOD'] == 'POST') {
	
//czy_pyta_numer();
	$string = $_POST['question'];

	if (preg_match("/(\d+)/",$string,$matches))
	{
		//print_r($string);
		//print_r($matches);
		//print_r($matches[0]);
		$numer = $matches[0];		
		//echo $numer;
		//echo "dopasowanie zostało znalezione.";
		//echo "CI-BOT: Szukam nr integracji $numer ...</br>";
		//echo "CI-BOT: Zrób SELECT do bazy i sprawdź czy istnieje w bazie</br>";
		//return $numer; //zwraca wartość i Powoduje to natychmiastowe zakończenie wykonywania funkcji i wznowienie wykonywania skryptu od linijki w której funkcja została wywołana.
		$no_q = 1;
		//echo "$no_q";
	}
	else {
		//echo "dopasowanie nie zostało znalezione.";
		//echo "CI-BOT: Podaj nr istniejącej integracji.</br>";
		$no_q = 0;
		//echo "$no_q";
	}


//czy_pyta_status();
	$q_user = $_POST['question'];	
	$kw_status = "status";

	if(stristr($q_user, $kw_status)!==False)
	{
		//echo "CI-BOT: Sprawdzam Status ...</br>";
		//echo "CI-BOT: Zrób SELECT do bazy i podaj jaki ma status</br>";
		$status_q = 1;
		//echo "$status_q";
	}
	else {
		//echo "CI-BOT: Nie zrozumiałem pytania. Zadaj pytanie z zakresu CI np. o status jakiejś integracji.</br>";
		$status_q = 0;
		//echo "$status_q";
	}


//czy_pyta_bledy();
	$q_user = $_POST['question'];	
	$kw_error1 = "błęd";
	$kw_error2 = "błąd";

	if((stristr($q_user, $kw_error1)!==False)OR(stristr($q_user, $kw_error2)!==False))
	{
		//echo "CI-BOT: Sprawdzam błędy ...</br>";
		//echo "CI-BOT: Zrób SELECT do bazy, jesli błąd to podaj jaki</br>";
		$error_q = 1;
		//echo "$error_q";
	}
	else {
		//echo "CI-BOT: Nie zrozumiałem pytania. Zadaj pytanie z zakresu CI np. o powód błędu jakiejś integracji.</br>";
		$error_q = 0;
		//echo "$error_q";
	}


//czy_pyta_logi();
	$q_user = $_POST['question'];	
	$kw_logi = "logi";

	if(stristr($q_user, $kw_logi)!==False)
	{
		//echo "CI-BOT: Sprawdzam logi ...</br>";
		//echo "CI-BOT: Zrób SELECT do bazy i podaj jakie ma logi</br>";
		$logi_q = 1;
		//echo "$logi_q";
	}
	else {
		//echo "CI-BOT: Nie zrozumiałem pytania. Zadaj pytanie z zakresu CI np. o logi z jakiejś integracji.</br>";
		$logi_q = 0;
		//echo "$logi_q";
	}

//czy_accept_question();
		$q_user = $_POST['question'];	
		$kw_accept1 = "tak";
		$kw_accept2 = "poproszę";
		$kw_accept3 = "yes";
		$kw_accept4 = "accept";

		if((stristr($q_user, $kw_accept1)!==False)
		OR(stristr($q_user, $kw_accept2)!==False)
		OR(stristr($q_user, $kw_accept3)!==False)
		OR(stristr($q_user, $kw_accept4)!==False))
		{
			//echo "CI-BOT: Już pokazuję ...</br>";
			//echo "CI-BOT: Zrób SELECT do bazy</br>";
			$accept_q = 1;
			//echo "$accept_q";
		}
		else {
			//echo "CI-BOT: Nie zrozumiałem. Rozpoznaję: tak, poproszę, yes, accept.</br>";
			$accept_q = 0;
			//echo "$accept_q";
		}
//czy_negation_question();
	$q_user = $_POST['question'];	
	$kw_negation1 = "nie";
	$kw_negation2 = "no";

	if((stristr($q_user, $kw_negation1)!==False)
	OR(stristr($q_user, $kw_negation2)!==False))
	{
		//echo "CI-BOT: OK. Zrozumiałem że nie.</br>";
		$negation_q = 1;
		//echo "$negation_q";
	}
	else {
		//echo "CI-BOT: Nie zrozumiałem. Rozpoznaję: nie oraz no.</br>";
		$negation_q = 0;
		//echo "$negation_q";
	}

//echo "</br></br></br>";
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
	$wynik_add_talk = @$polaczenie -> query("INSERT INTO talk_history (talk) VALUES ('JA: $add_talk')");
	

	if ($wynik_add_talk === false){
		echo 'Fail INSERT - dodanie rozmowy do DB nie powiodło się!</br>';
		$polaczenie -> close();
	}
	else {
		//echo "JA: $add_talk</br>";
		//echo "Powodzenie INSERT - dodano rozmowę do DB</br>";	
	
	//$wynik_add_talk -> close(); // zwolnienie pamięci
	//$polaczenie -> close();
	}
//
pokaz_pytanie();
//
//jeśli isnieje zmienna $numer
	if (isset($numer)) { 
	//jaki_status_numeru();
		//echo "CI-BOT: Szukam nr integracji $numer ...</br>";
		//echo "CI-BOT: Zrób SELECT do bazy i sprawdź czy istnieje w bazie</br>";
		$wynik = @$polaczenie -> query("SELECT id_integration, status_integration, error_integration, log_integration FROM ci_table WHERE id_integration = $numer");
		if ($wynik === false){
			echo '<p>Zapytanie SELECT o integrację nie zostało wykonane poprawnie!</p>';
			$polaczenie -> close();
		}

		elseif (mysqli_num_rows($wynik) == 0){ //czy isnieje taki numer w bazie
			echo "CI-BOT: Niepoprawny nr zmiany. Zmiana $numer nie istnieje. Posiadam informacje o 7 zmianach.</br>";
						//dodaj_rozmowe_do_db();	//add talk ze zmiennej
							$add_talk = "CI-BOT: Niepoprawny nr zmiany. Zmiana $numer nie istnieje. Posiadam informacje o 7 zmianach.";
							//echo "$add_talk</br>";
							$wynik_add_talk = @$polaczenie -> query("INSERT INTO talk_history (talk) VALUES ('$add_talk')");

							if ($wynik_add_talk === false){
								echo 'Fail INSERT - dodanie rozmowy do DB nie powiodło się!</br>';
								$polaczenie -> close();
							}
							else {
								//echo "JA: $add_talk</br>"; echo "Powodzenie INSERT - dodano rozmowę do DB</br>";								
								//$wynik_add_talk -> close(); // zwolnienie pamięci
								//$polaczenie -> close();
							}

		//---------- FIX z integracji - START - dodane kasowanie pytania o numer żeby wrócic stan początkowy gdy nie ma takiego numeru w bazie ------ //
			$no_q = 0;
			//echo "$no_q";
		//---------- FIX z integracji - END - dodane kasowanie pytania o numer żeby wrócic stan początkowy gdy nie ma takiego numeru w bazie ------- //
		}

		else {				
			while (($numer_status = $wynik -> fetch_assoc()) !== null) //fetch_assoc pobiera tablicę asocjacyjną, czyli nazwy kolumn tabeli
			{ 
				$id_integration = $numer_status['id_integration'];
				$status_integration = $numer_status['status_integration'];			
				$error_integration = $numer_status['error_integration'];
				$log_integration = $numer_status['log_integration'];

				//odpowiedzi
					/*
					echo "CI-BOT: Znalazłem</br>";
					echo "CI-BOT: Zmiana o numerze: $id_integration ";
					echo "ma status: $status_integration</br>";
					echo "ma logi: $log_integration</br>";
					
					if ($error_integration == 0){
						echo "nie ma błędów</br>";
					}
					else {
						echo "ma błąd: $error_integration</br>";
					}
					*/					
			}
			//$wynik -> close(); // zwolnienie pamięci
			//$polaczenie -> close();


		}
	}
//opcje logiczne rozmowy
	//czy numer + słowa kluczowe
	if ($no_q == 1) {
		include('inc_if_status_logi_bledy.php'); 
	}

	//czy accept na pytanie o logi
	else if($accept_q == 1) {
		include('inc_if_accept_to_logi.php'); 		
	}

	//czy odmowa na pytanie o logi
	else if($negation_q == 1) {
		echo "CI-BOT: OK. Nie to nie.</br>";
			//dodaj_rozmowe_do_db();	//add talk ze zmiennej
				$add_talk = "CI-BOT: OK. Nie to nie.";
				//echo "$add_talk</br>";
				$wynik_add_talk = @$polaczenie -> query("INSERT INTO talk_history (talk) VALUES ('$add_talk')");

				if ($wynik_add_talk === false){
					echo 'Fail INSERT - dodanie rozmowy do DB nie powiodło się!</br>';
					$polaczenie -> close();
				}
				else {
					//echo "JA: $add_talk</br>"; echo "Powodzenie INSERT - dodano rozmowę do DB</br>";								
					//$wynik_add_talk -> close(); // zwolnienie pamięci
					//$polaczenie -> close();
				}
	}

	//jak nie padnie ani numer + słowa kluczowe, ani accept
	else {
		echo "CI-BOT: Podaj numer zmiany, która Cię interesuje. Posiadam informacje o 7 zmianach. Najlepiej do numeru dopisz co chcesz wiedzieć o statusie, błędach lub logach. Przykład: Chciałbym poznać aktualny status oraz logi zmiany numer 3.</br>";
							//dodaj_rozmowe_do_db();	//add talk ze zmiennej
								$add_talk = "CI-BOT: Podaj numer zmiany, która Cię interesuje. Posiadam informacje o 7 zmianach. Najlepiej do numeru dopisz co chcesz wiedzieć o statusie, błędach lub logach. Przykład: Chciałbym poznać aktualny status oraz logi zmiany numer 3.";
								//echo "$add_talk</br>";
								$wynik_add_talk = @$polaczenie -> query("INSERT INTO talk_history (talk) VALUES ('$add_talk')");

								if ($wynik_add_talk === false){
									echo 'Fail INSERT - dodanie rozmowy do DB nie powiodło się!</br>';
									$polaczenie -> close();
								}
								else {
									//echo "JA: $add_talk</br>"; echo "Powodzenie INSERT - dodano rozmowę do DB</br>";								
									//$wynik_add_talk -> close(); // zwolnienie pamięci
									//$polaczenie -> close();
								}
	}
}
else {
	echo "</br></br>";
	echo "Teraz możesz coś wpisać !</br>";
}

//testowanie stanów pytania //wynik analizy pytania
	//if ($_POST) { echo "</br>Aktualne stany: $numer, $no_q, $status_q, $error_q, $logi_q, $accept_q, $negation_q</br>"; }

echo "</br></br>";
pokaz_formularz();
echo "</br></br>";
 
?>
