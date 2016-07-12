<?php

/**
* different helper functions
* for reating personal letter and sending them to email from database. 
* @author Masha G (m.gorbunova@ukr.net)
*/
class GeneratorLetter {
	
	//current date for subject of the letter
    private $row = array();
	// subject of the letter
    private $subject;	

/**
* read letter from file 
* @param $var - name of person who get the letter
* @return $msg - letter with field name of person 
*/
function readLetter ($var) {
	$path = "mail-test.html";
	if (!file_exists($path)) {
		echo "Choose HTML-letter for sending \r\n";
	}
    else {
		$text = file_get_contents($path);
	$msg = str_replace ("\$name", $var, $text);

	return $msg;
	}	
}

/**
* generator personal letters
* @param $row - array with current date
* @param $name - name of person who get the letter
* @param $to - meil of person
*/
function letterGenerator ($name, $to) {
	
	$this->row = array('day'=>date(d,time()), 'month'=>date(m,time()), 'year'=>date(Y,time()));	 
	$this->subject = 'Лучшие предложения за ' . $this->row['day'] . '.' . $this->row['month'] . '.' . $this->row['year'];
	
/* headers for sending HTML-letter*/
$headers  = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
$headers .= "From: example@ukr.net\r\n";
$headers .= "Bcc: example@ukr.net\r\n";

//body of the letter
$text = $this->readLetter ($name);

// sending letter
if (!empty($text)) {
	if (mail($to, $this->subject, $msg, $headers)) {
	echo "Yes";
    }
    else echo "some error";
}
else {
	echo "No, for $name, e-mail $to <br>";
}
}

}

?>