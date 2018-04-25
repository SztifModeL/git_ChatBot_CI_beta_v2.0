<?php
 
echo '<form method="post">
USER: <input type="text" name="question" />
<input type="submit" value="zapytaj">
</form>';

 if($_SERVER['REQUEST_METHOD'] == 'POST')
 { 
	echo "USER: ".$_POST['question']."</br>";

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
 else {
	echo "CI-BOT: Teraz możesz coś wpisać !</br>";
 }
?>