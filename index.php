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
	<link rel="stylesheet" type="text/css" href="css/popup.css"/>
	
	<!--[if lt IE 9]>
		<link rel="stylesheet" type="text/css" href="css/ie.css"/>
	<[endif]-->

</head>
<body>
<div class="container-fluid">
	<header class="header">
		<a href="index.php"><img src="img/logo.png" id="logo"/></a>
	</header>

	<div id="divider"></div>

	<div class="row-fluid">
		
	<div class="home-content">


	  <div id="home-message">
		<h1>Welcome to the Decipher Utility Portal (beta)</h1>
		
	  </div>

	<?php if(isset($personMarkup)): ?>
	<?php print $personMarkup; ?>
	<?php endif;?>
	
	<?php
		if (isset($authUrl)) { //user not logged in...show button
			//echo '<a class="popup" href="'. $authUrl . '"><img id="login-btn" src="img/google_login.png" width="225"/></a>';
			echo '<a class="popup" href="'. $authUrl . '"><img id="login-btn" src="img/google_login.png" width="225"/></a>';
		} else {//logged in

			
		 
			$person = $db->prepare("SELECT * FROM `google_users` WHERE id=$user_id");
			$person->execute();
			if ($person == false) {
				die($db->errorInfo());
			}

		

			$rowC = $person->fetchAll(PDO::FETCH_ASSOC);
			

			if (!$rowC) { //check if user exists (if user doesn't exist)
				echo 'You are now registered';
				//create new user
				
			
				$addUser = $db->prepare("INSERT INTO `google_users` (`id`, `google_name`, `google_email`, `google_link`, `google_picture_link`) VALUES ($user_id, '$user_name', '$email', '$profile_url', '$img')");
				$addUser->execute();


			
			} else { //user exists in database
				echo 'Welcome back ' . $user_name . '!';	
			}

			echo '<a class="logout" href="?logout">Logout</a>';

			//header('Location: /github/utility-portal/public/profile');
			header('Location: profile.php');

		}

	?>
	
	</div><!-- /home-content-->


	</div><!-- row-fluid -->

</div><!-- /container-fluid -->


<!-- Das Javascript -->
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.validate.min.js"></script>
<!--<script type="text/javascript" src="js/bootstrap.min.js"></script>-->
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/jquery.oauthpopup.js"></script>
<!-- template engine -->
<!--<script type="text/javascript" src="js/mustache.js"></script>-->

<script type="text/javascript">
	
  $(document).ready(function() {

  	$('body').hide();
  	$('body').fadeIn('slow').delay(2000);

	//dropdown menu
	$('.dropdown-toggle').dropdown();

	$('#lb-tabs a:first').tab('show'); // show first tab onload

	//tooltip
	$('#lb-info').tooltip();

	//modal box(es)
	$('#modal').modal('hide');

	$('#addTab').click(function() {
		$('#etab').modal();
	});

//oauth login popup onclick


/*$('a.popup').click(function(event) { 

	
	var auth = $.oauthpopup({
		path : '<?php if(isset($authUrl)) {echo $authUrl; }?>',
		windowName : true,
		width: 800,
		height: 500,
		callback: function() {
			window.location.reload();
		}

	});

	event.preventDefault();


	var denied = 'http://kb.decipherinc.com/utilityportal/?error=access_denied';
	var prourl = 'http://kb.decipherinc.com/utilityportal/profile.php'

	if (denied && prourl) {
		window.close();
	}
});*/





});



</script>
</body>
</html> 