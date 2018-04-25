<?php
 
echo '<form method="post">
USER: <input type="text" name="question" />
<input type="submit" value="zapytaj">
</form>';

 if($_SERVER['REQUEST_METHOD'] == 'POST')
 { 
	echo "USER: ".$_POST['question']."</br>";

	$q_user = $_POST['question'];	
	$kw_negation1 = "nie";
	$kw_negation2 = "no";

	if((stristr($q_user, $kw_negation1)!==False)
	OR(stristr($q_user, $kw_negation2)!==False))
	{
		echo "CI-BOT: OK. Nie pokazuję ...</br>";
		$negation_q = 1;
		echo "$negation_q";
	}
	else {
		echo "CI-BOT: Nie zrozumiałem. Rozpoznaję: nie oraz no.</br>";
		$negation_q = 0;
		echo "$negation_q";
	}

 }
 else {	
	echo "CI-BOT: Teraz możesz coś wpisać !</br>";
 }
?>