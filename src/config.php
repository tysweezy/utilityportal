<?php
/**================================
	DATABASE CONFIGURATION FILE
 **=============================**/

error_reporting(E_ALL);


$config = array(
	'host'  => 'localhost',
	'username' => 'root',
	'password' => '',
	'dbname'  => 'utility'	
);

try {
	$db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'], $config['username'],  $config['password'], array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	));
	
	

} catch(PDOException $e) {
	die('ERROR!' . $e->getMessage() . '<br />');
}