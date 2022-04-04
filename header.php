<?php 
include('googleConfig.php');
$login_button = '';
if(isset($_GET["code"]))
{
//It will Attempt to exchange a code for an valid authentication token.
$token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

//This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
if(!isset($token['error']))
{
//Set the access token used for requests
$google_client->setAccessToken($token['access_token']);

//Store "access_token" value in $_SESSION variable for future use.
$_SESSION['access_token'] = $token['access_token'];

//Create Object of Google Service OAuth 2 class
$google_service = new Google_Service_Oauth2($google_client);

//Get user profile data from google
$data = $google_service->userinfo->get();

//Below you can find Get profile data and store into $_SESSION variable
if(!empty($data['given_name']))
{
$_SESSION['user_first_name'] = $data['given_name'];
}

if(!empty($data['family_name']))
{
$_SESSION['user_last_name'] = $data['family_name'];
}

if(!empty($data['email']))
{
$_SESSION['user_email_address'] = $data['email'];
}

if(!empty($data['gender']))
{
$_SESSION['user_gender'] = $data['gender'];
}

if(!empty($data['picture']))
{
$_SESSION['user_image'] = $data['picture'];
}
}
}
if(!isset($_SESSION['access_token']))
{
 //Create a URL to obtain user authorization
 $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="https://www.oncrashreboot.com/images/create-apple-google-signin-buttons-quick-dirty-way-google.png" /></a>';
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="img/dckap.png" height="80px;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Account
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li class="dropdown-item"><?php echo $_SESSION['user_first_name'] ?></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <?php 
          if($login_button == '')
          {
            echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />'; 
          }
          else{
            echo 'login';
          }
          ?>
        </li>
      </ul>
    </div>
  </div>
</nav>