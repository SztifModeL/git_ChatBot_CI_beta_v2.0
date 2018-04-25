
<?php

// funkcje -----------------------------------------

function pokaz_formularz(){
	echo '<form method="post">
	USER: <input type="text" name="question" />
	<input type="submit" value="zapytaj">
	</form>';
}

function pokaz_pytanie(){
	echo "USER: ".$_POST['question']."</br>";
}

function czy_jest_numer(){
	$string = $_POST['question'];

	if (preg_match("/(\d+)/",$string,$matches))
	{
		$numer = $matches[0];

		echo "CI-BOT: Szukam nr integracji $numer ...</br>";
		echo "CI-BOT: Zrób SELECT do bazy i sprawdź czy istnieje w bazie</br></br>";
		//return $numer; //zwraca wartość i Powoduje to natychmiastowe zakończenie wykonywania funkcji i wznowienie wykonywania skryptu od linijki w której funkcja została wywołana.	
	
	}
	else {
		echo "CI-BOT: Podaj jakiś numer integracji np od 1-7 bo tyle mam w bazie</br>";
	}
}

function jaki_status_numeru(){
	$wynik = @$polaczenie -> query("SELECT id_integration, status_integration FROM ci_table WHERE id_integration = $numer");
	if ($wynik === false){
		echo '<p>Zapytanie nie zostało wykonane poprawnie!</p>';
		$polaczenie -> close();
	}

	elseif (mysqli_num_rows($wynik) == 0){ //czy isnieje taki numer w bazie
		echo "CI-BOT: Niepoprawny nr zmiany. Zmiana $numer nie istnieje</br>";
	}
	
	else {				
		while (($numer_status = $wynik -> fetch_assoc()) !== null){ //stwórz tablicę z wyniku
			echo "CI-BOT: Znalazłem</br>";
			echo "CI-BOT: Integracja o numerze: ".$numer_status['id_integration']." ma status ".$numer_status['status_integration']."</br>";
		}
		//$wynik -> close(); // zwolnienie pamięci
		//$polaczenie -> close();
	}

}

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
	echo "nawiązane połączenie z bazą";
    }

}

// specjalistyczne funkcje --------------------------






// program ------------------------------------------

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	pokaz_pytanie();
	//czy_jest_numer();

//------------------Gotowiec na szybko Start------------------

//czy jest numer - Start
	$string = $_POST['question'];

	if (preg_match("/(\d+)/",$string,$matches))
	{
		$numer = $matches[0];

		echo "CI-BOT: Szukam nr integracji $numer ...</br>";
		echo "CI-BOT: Zrobię SELECT do bazy i sprawdzę czy istnieje w bazie</br>";
		//return $numer; //zwraca wartość i Powoduje to natychmiastowe zakończenie wykonywania funkcji i wznowienie wykonywania skryptu od linijki w której funkcja została wywołana.	
	


//connect - Start
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
			echo "CI-BOT: Nawiązłem połączenie z bazą</br>";



//jaki_status_numeru - Start
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
			
//jaki_status_numeru - End





			}
//connect - End




	}
	else {
		echo "CI-BOT: Podaj jakiś numer integracji np od 1-7 bo tyle mam w bazie</br>";
	}
//czy jest numer - END

//---------------------Gotowiec na szybko END---------------------
		
}
else {	
	pokaz_formularz();
}

 
?>
