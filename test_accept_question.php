<?php
 
echo '<form method="post">
USER: <input type="text" name="question" />
<input type="submit" value="zapytaj">
</form>';

 if($_SERVER['REQUEST_METHOD'] == 'POST')
 { 
	echo "USER: ".$_POST['question']."</br>";

	$q_user = $_POST['question'];	
	$kw_accept1 = "tak";
	$kw_accept2 = "poproszę";
	$kw_accept3 = "yes";
	$kw_accept4 = "accept";

	if((stristr($q_user, $kw_accept1)!==False)
	OR(stristr($q_user, $kw_accept2)!==False)
	OR(stristr($q_user, $kw_accept3)!==False)
	OR(stristr($q_user, $kw_accept4)!==False))
	{
		echo "CI-BOT: Już pokazuję ...</br>";
		echo "CI-BOT: Zrób SELECT do bazy</br>";
		$accept_q = 1;
		echo "$accept_q";
	}
	else {
		echo "CI-BOT: Nie zrozumiałem. Rozpoznaję: tak, poproszę, yes, accept.</br>";
		$accept_q = 0;
		echo "$accept_q";
	}

 }
 else {	
	echo "CI-BOT: Teraz możesz coś wpisać !</br>";
 }
?>