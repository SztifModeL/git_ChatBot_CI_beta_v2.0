<?php

//include('inc_if_sam_numer.php');

		//testowanie stanów pytania //wynik analizy pytania
			//if ($_POST) { echo "</br>stany po odpowiedzi tak: $numer, $no_q, $status_q, $error_q, $logi_q, $accept_q, $negation_q</br>"; }

		//czy_pyta_numer(); //$numer mam z POST jak wpisał numer w formularzu
			//$numer
		//szukanie stringa w bazie
			//pobierz_max_id_talk();
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
							//echo "max_id_talk: $max_id_talk</br>";			
						}
						//$wynik_max_id_talk -> close(); // zwolnienie pamięci
						//$polaczenie -> close();
					}

			//pobierz_last_question();
					$id_last_question = $max_id_talk - 2;
					//echo "id_last_question: $id_last_question</br>";

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
							//echo "last question: $last_question</br>";		
						}
						//$wynik_last_question -> close(); // zwolnienie pamięci
						//$polaczenie -> close();
					}
		//
		//analiza stringa z bazy by sprawdić czy wcześniej pytał o status, błędy lub logi 
			//			
			//czy_pyta_status();
				$q_user = $last_question;	
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
				$q_user = $last_question;	
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
				$q_user = $last_question;	
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
				//
		//testowanie stanów pytania //wynik analizy pytania po odpowiedzi tak i stringa pytania z bazy
			//if ($_POST) { echo "</br>po odpowiedzi tak: stany zdania z bazy: $numer, $no_q, $status_q, $error_q, $logi_q, $accept_q, $negation_q</br>"; }

		//odpowieddzi jeśli teraz podał numer a wczesniej było w bazie pytanie o status, błędy lub logi
			//pytanie o numer i status i logi i błędy
				if(($no_q == 1) && ($status_q == 1) && ($logi_q == 1) && ($error_q == 1)){

					if ($error_integration == 0){
						echo "CI-BOT: Zmiana o numerze: $id_integration, ma status: $status_integration, ma logi: $log_integration i nie ma błędów</br>";
							//dodaj_rozmowe_do_db();	//add talk ze zmiennej
								$add_talk = "CI-BOT: Zmiana o numerze: $id_integration, ma status: $status_integration, ma logi: $log_integration i nie ma błędów";
								//echo "$add_talk</br>";
								$wynik_add_talk = @$polaczenie -> query("INSERT INTO talk_history (talk) VALUES ('$add_talk')");

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
					}
					else {
						echo "CI-BOT: Zmiana o numerze: $id_integration, ma status: $status_integration, ma logi: $log_integration, ma błąd: $error_integration</br>";
							//dodaj_rozmowe_do_db();	//add talk ze zmiennej
								$add_talk = "CI-BOT: Zmiana o numerze: $id_integration, ma status: $status_integration, ma logi: $log_integration, ma błąd: $error_integration";
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

			//pytanie o numer i status i logi
				else if(($no_q == 1) && ($status_q == 1) && ($logi_q == 1)){
					echo "CI-BOT: Zmiana o numerze: $id_integration, ma status: $status_integration, ma logi: $log_integration</br>";
						//dodaj_rozmowe_do_db();	//add talk ze zmiennej
								$add_talk = "CI-BOT: Zmiana o numerze: $id_integration, ma status: $status_integration, ma logi: $log_integration";
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
				
			//pytanie o numer i status i błędy
				else if(($no_q == 1) && ($status_q == 1) && ($error_q == 1)){

					if ($error_integration == 0){
						echo "CI-BOT: Zmiana o numerze: $id_integration, ma status: $status_integration i nie ma błędów</br>";
							//dodaj_rozmowe_do_db();	//add talk ze zmiennej
								$add_talk = "CI-BOT: Zmiana o numerze: $id_integration, ma status: $status_integration i nie ma błędów";
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
					else {
						echo "CI-BOT: Zmiana o numerze: $id_integration, ma status: $status_integration, ma błąd: $error_integration. Czy chcesz zobaczyć logi ?</br>";
							//dodaj_rozmowe_do_db();	//add talk ze zmiennej
								$add_talk = "CI-BOT: Zmiana o numerze: $id_integration, ma status: $status_integration, ma błąd: $error_integration. Czy chcesz zobaczyć logi ?";
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

			//pytanie o numer i logi i błędy
				else if(($no_q == 1) && ($logi_q == 1) && ($error_q == 1)){

					if ($error_integration == 0){
						echo "CI-BOT: Zmiana o numerze: $id_integration, ma logi: $log_integration i nie ma błędów</br>";
							//dodaj_rozmowe_do_db();	//add talk ze zmiennej
								$add_talk = "CI-BOT: Zmiana o numerze: $id_integration, ma logi: $log_integration i nie ma błędów";
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
					else {
						echo "CI-BOT: Zmiana o numerze: $id_integration, ma logi: $log_integration, ma błąd: $error_integration</br>";
							//dodaj_rozmowe_do_db();	//add talk ze zmiennej
								$add_talk = "CI-BOT: Zmiana o numerze: $id_integration, ma logi: $log_integration, ma błąd: $error_integration";
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

			//pytanie o numer i status
				else if(($no_q == 1) && ($status_q == 1)){
					echo "CI-BOT: Zmiana o numerze: $id_integration, ma status: $status_integration</br>";
							//dodaj_rozmowe_do_db();	//add talk ze zmiennej
								$add_talk = "CI-BOT: Zmiana o numerze: $id_integration, ma status: $status_integration";
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

			//pytanie o numer i logi
				else if(($no_q == 1) && ($logi_q == 1)){
					echo "CI-BOT: Zmiana o numerze: $id_integration, ma logi: $log_integration</br>";
							//dodaj_rozmowe_do_db();	//add talk ze zmiennej
								$add_talk = "CI-BOT: Zmiana o numerze: $id_integration, ma logi: $log_integration";
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
		
			//pytanie o numer i błędy
				else if(($no_q == 1) && ($error_q == 1)){					
					if ($error_integration == 0){
						echo "CI-BOT: Zmiana o numerze: $id_integration nie ma błędów</br>";
							//dodaj_rozmowe_do_db();	//add talk ze zmiennej
								$add_talk = "CI-BOT: Zmiana o numerze: $id_integration nie ma błędów";
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
					else {
						echo "CI-BOT: Zmiana o numerze: $id_integration, ma błąd: $error_integration. Czy chcesz zobaczyć logi ?</br>";
							//dodaj_rozmowe_do_db();	//add talk ze zmiennej
								$add_talk = "CI-BOT: Zmiana o numerze: $id_integration, ma błąd: $error_integration. Czy chcesz zobaczyć logi ?";
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
			//pytanie o sam numer
				else if($no_q == 1){
						echo "CI-BOT: jest zmiana o numerze: $id_integration i ma status: $status_integration. To domyślna odpowiedź na pytanie z poprawnym numerem zmiany. Zadaj pytanie szczegółowe z zakresu CI. Podaj numer zmiany i co Cię z niej interesuje. Dobry przykład: Chciałbym poznać aktualny status oraz logi zmiany numer 3.<br>";
								//dodaj_rozmowe_do_db();	//add talk ze zmiennej
									$add_talk = "CI-BOT: jest zmiana o numerze: $id_integration i ma status: $status_integration. To domyślna odpowiedź na pytanie z poprawnym numerem zmiany. Zadaj pytanie szczegółowe z zakresu CI. Podaj numer zmiany i co Cię z niej interesuje. Dobry przykład: Chciałbym poznać aktualny status oraz logi zmiany numer 3.";
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
				
			// jak nie padnie ani numer ani żadne słowo kluczowe
				else {
					echo "CI-BOT: Nie zrozumiałem pytania. Zadaj pytanie z zakresu CI np. o nr zmiany jej status, błędy lub logi.</br>";
							//dodaj_rozmowe_do_db();	//add talk ze zmiennej
								$add_talk = "CI-BOT: Nie zrozumiałem pytania. Zadaj pytanie z zakresu CI np. o nr zmiany jest status, błędy lub logi.";
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


?>