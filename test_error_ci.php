<?php
 
echo '<form method="post">
USER: <input type="text" name="question" />
<input type="submit" value="zapytaj">
</form>';

 if($_SERVER['REQUEST_METHOD'] == 'POST')
 { 
	echo "USER: ".$_POST['question']."</br>";

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
 else {	
	echo "CI-BOT: Teraz możesz coś wpisać !</br>";
 }
?>