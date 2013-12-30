<?php
/*require_once '../api/src/Google_Client.php';
require_once '../api/src/contrib/Google_Oauth2Service.php';*/

/***this needs to be tested and changed when launched***/
require_once $_SERVER['DOCUMENT_ROOT'] . '/utilityportal/api/src/Google_Client.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/utilityportal/api/src/contrib/Google_Oauth2Service.php';

/***GOOGLE OAUTH2***/
session_start();

$client = new Google_Client();
$client->setApplicationName("");
// Visit https://code.google.com/apis/console?api=plus to generate your
// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
$client->setClientId('');
$client->setClientSecret('');
$client->setRedirectUri(''); //this needs to be changed to exact url in api settings
$client->setDeveloperKey('');


$oauth2 = new Google_Oauth2Service($client);



if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
  //header('Location: profile.php'); //redirect to members page
 
  return;
}

if (isset($_SESSION['token'])) {
 $client->setAccessToken($_SESSION['token']);
 //header('Location: profile.php'); //redirect to members page
 //echo '<script type="text/javascript"> window.close();</script>';
} 

if (isset($_REQUEST['logout'])) {
  unset($_SESSION['token']);
  session_destroy();
  $client->revokeToken();
  header('Location: index.php');

}

if ($client->getAccessToken()) {
  $user = $oauth2->userinfo->get();


  $_SESSION['google_data'] = $user;

  // These fields are currently filtered through the PHP sanitize filters.
  // See http://www.php.net/manual/en/filter.filters.sanitize.php
  $user_id = $user['id'];
  $user_name = filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
  $fname = filter_var($user['given_name'], FILTER_SANITIZE_SPECIAL_CHARS);
  $profile_url = filter_var($user['link'], FILTER_SANITIZE_URL);
  $email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
  $img = filter_var($user['picture'], FILTER_VALIDATE_URL);
  $personMarkup = "<a id='login-email' href='https://www.google.com/settings/account' target='_blank'>" . $email . "</a><div><img id='profile-img' src='$img?sz=50'></div>";



  // The access token may have been updated lazily.
  $_SESSION['token'] = $client->getAccessToken();

  //header('Location: profile.php');
  //echo '<script type="text/javascript">window.location.reload();</script>';
  //echo '<script type="text/javascript">window.close();</script>';

} else {
  $authUrl = $client->createAuthUrl();
  //echo '<script type="text/javascript">window.close();</script>';
}

?>

<script type="text/javascript">
//window.close();
</script>


