<?php

//include('inc_if_status_logi_bledy.php');

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
					include('inc_if_sam_numer.php');
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