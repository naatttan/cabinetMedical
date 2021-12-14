<?php	
	define('HOST','localhost');
	define('DB_NAME','bdcabinetmedical');
	define('USER','root');
	define('PASS','');
	try{
		$db = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USER, PASS);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connecte > ok!";
	} catch(PDOException $e){
		die('Erreur : ' . $e->getMessage());
	}

	$wew = 'wew'

?>