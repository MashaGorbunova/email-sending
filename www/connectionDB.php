<?php

/**
* Connection with DataBase, different helper functions
* for creating and selection data from base. 
* @author Masha G (m.gorbunova@ukr.net)
*/
class ConnectionWithDB {
/**
* establishment database connection
* @return connection with DB
*/	
private function unitDB () {
	
	//your name of host
	$DB_host = 'localhost';
	
	//your name of user of DB
	$DB_user = 'root';
	
	//your password for DB
	$DB_password = '';
	
	//your name of DB
	$DB_name = 'mail';
	
	//your name of DB
	$charset = 'utf8';
	
	$dsn = "mysql:host=$DB_host;port=3316;dbname=$DB_name;charset=$charset";
	
    $opt = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
				  
    $pdo = new PDO($dsn, $DB_user, $DB_password, $opt);

    return $pdo;
}

/**
* creating array with values from selecting from DB 
* for sedning letters.
* @return array of results from DB.
*/
function nameWithMail () {
	$link = $this->unitDB();
	
	$res = $link->prepare("SELECT * FROM mails m INNER JOIN users u ON u.id=m.users_name");
	$res->execute();
	$row = $res->fetchAll(PDO::FETCH_ASSOC);
	
	return $row;
}
}
?>