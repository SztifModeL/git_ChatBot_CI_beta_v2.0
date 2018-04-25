
<?php
 
echo '<form method="post">
USER: <input type="text" name="question" />
<input type="submit" value="zapytaj">
</form>';

 if($_SERVER['REQUEST_METHOD'] == 'POST')
 { 
	echo "USER: ".$_POST['question']."</br>";

	//$string='Czy istnieje intergacja nr 1234 ?';
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
 else {
	echo "CI-BOT: Teraz możesz coś wpisać !</br>";
 }
?>
