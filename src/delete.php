<?php
/**=========================
	DELETE FUNCTIONS 
***======================**/

require 'config.php';

function deleteLink() {
	/***
	  * Delete individual link on user request.
	***/

	global $db;
		
	$id = $_GET['id'];

	$del_sql = "DELETE FROM `custom_links` WHERE id = :id";
	$del_stmt = $db->prepare($del_sql);
	$del_stmt->bindParam(':id', $id, PDO::PARAM_STR);
	$del_stmt->execute();
	//$del_stmt->execute($values);
}


function deleteTab() {
	global $db;
}


function init() {
	return deleteLink();
}

init();

?>