<?php
require 'config.php';

function updateTab() {
	global $db;

	$tabid = $_GET['id'];
	$text = $_POST['updateTabText'];
	//$tabSelect = $_POST['updateTitle'];
	//$submitUpdate = $_POST['updateTab'];

	
	//if query is executed -- need to update tab_title that's related in u_links
	//links are dependent on the title.
	$updateQuery = "UPDATE `category` SET `tab_title` = :titleupdate WHERE category.id = :id";
	$setUpdate = $db->prepare($updateQuery);
	$setUpdate->bindParam(':titleupdate', $text, PDO::PARAM_STR);
	$setUpdate->bindParam(':id', $tabid, PDO::PARAM_INT);
	$setUpdate->execute();

	if($setUpdate) {
		$relQuery = "";
	}
}

function init() {
	return updateTab();
}

init();

?>