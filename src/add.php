<?php
/**================================
	STORE LINK DATA TO DB
***=============================**/
require_once 'config.php';
require 'user.php';


try {
		
		//$t = $db->prepare("INSERT INTO `u_links` (`link_title`, `link`, `title`, `user_id`) VALUES (?, ?, 'My Links', $user_id)");
		//$t->execute(array($_POST['link_title'], $_POST['link'], $_POST['title']));


		$t = $db->prepare("INSERT INTO `custom_links` (`link_title`, `link`, `title`, `user_id`) VALUES (?, ?, 'My Links', $user_id)");
		$t->execute(array($_POST['link_title'], $_POST['link']));


} catch(PDOException $e) {
	die("Error!: " . $e->getMessage() . "<br />");

}

?>