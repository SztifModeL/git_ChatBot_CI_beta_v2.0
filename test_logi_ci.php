<?php
 
echo '<form method="post">
USER: <input type="text" name="question" />
<input type="submit" value="zapytaj">
</form>';

 if($_SERVER['REQUEST_METHOD'] == 'POST')
 { 
	echo "USER: ".$_POST['question']."</br>";

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
 else {
	 echo "CI-BOT: Teraz możesz coś wpisać !</br>";
 }
?>