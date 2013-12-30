<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/utilityportal/src/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/utilityportal/api/src/Google_Client.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/utilityportal/api/src/contrib/Google_Oauth2Service.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utilityportal/src/user.php';

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<title>Decipher -- Utility Portal</title>

	<!-- Das Style -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<link rel="stylesheet" type="text/css" href="css/icomoon.css"/>
	<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'/>
	
	<!--[if lt IE 9]>
		<link rel="stylesheet" type="text/css" href="css/ie.css"/>
	<[endif]-->

</head>
<body>

<div class="container-fluid">
	<header class="header">
		<a href="index.php"><img src="img/logo.png" id="logo"/></a>

	<div class="auth">
	
	<?php if(isset($personMarkup)): ?>
	<?php print $personMarkup; ?>
	<?php endif;?>
	
	<?php
		if (isset($authUrl)) { //user not logged in...show button
			//echo '<a class="login" href="'. $authUrl . '"><img id="login-btn" src="img/google_login.png" width="190"/></a>';

			header('Location: index.php'); //redirect to index page
			
		} else {//logged in

			$person = $db->prepare("SELECT * FROM `google_users` WHERE id=$user_id");
			$person->execute();
			if ($person == false) {
				die($db->errorInfo());
			}

			$rowC = $person->fetchAll(PDO::FETCH_ASSOC);
			//print_r($rowC);

			if (!$rowC) { //check if user exists (if user doesn't exist)
				echo 'You are now registered';
				//create new user
				$addUser = $db->prepare("INSERT INTO `google_users` (id, google_name, google_email, google_link, google_picture_link) VALUES ($user_id, '$user_name', '$email', '$profile_url', '$img')");
				$addUser->execute();
			
			} else { //user exists in database
				//echo 'Welcome back ' . $user_name . '!';	

				//add a welcome message
			}

			echo '<a class="logout" href="?logout">Logout</a>';
		
		}

	?>
	
	</div><!-- /auth -->

	</header>

	<div id="divider"></div>