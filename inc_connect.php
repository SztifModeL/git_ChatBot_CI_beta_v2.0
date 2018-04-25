<?php

//include('inc_connect.php');

//connect();
	$mysql_server = "localhost"; 
	// admin 
	$mysql_admin = "pomysl_ciadm"; 
	// hasło 
	$mysql_pass = "321qaz"; 
	// nazwa baza
	$mysql_db = "pomysl_cidb";
	// nazwa baza dla ChatBot v2.0 na ftp
	//$mysql_db = "pomysl_cidb2";

	// nawiązujemy połączenie z serwerem MySQL 
	$polaczenie = @new mysqli($mysql_server, $mysql_admin, $mysql_pass, $mysql_db);
	if (mysqli_connect_errno() != 0){
	echo '<p>Wystąpił błąd połączenia: ' . mysqli_connect_error() . '</p>';
	}
	else {        
	// tutaj kod wykonywany, gdy zostało uzyskane połączenie z bazą
	//echo "CI-BOT: Nawiązane połączenie z bazą</br>";
	}
?>