<?php 
/****************************************************** 
* connection.php 
* konfiguracja połączenia z bazą danych 
******************************************************/ 

function connect() { 
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
	echo 'CI-BOT: Wystąpił błąd połączenia: ' . mysqli_connect_error() . '</br>';
    }
    else {        
    // tutaj kod wykonywany, gdy zostało uzyskane połączenie z bazą
    echo "CI-BOT: Nawiązane połączenie z bazą</br>";
    }

}   

connect();

?>
