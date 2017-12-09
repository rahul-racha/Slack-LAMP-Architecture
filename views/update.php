<?php
  session_start();
  $_SESSION["basePath"] = "../";
  require_once $_SESSION["basePath"].'controllers/login.php';
  require_once $_SESSION['basePath'].'controllers/home.php';
  require_once $_SESSION['basePath'].'controllers/profile.php';

  $response = NULL;
  $verificationURL = "https://www.google.com/recaptcha/api/siteverify";
  $profileControllerVar = new ProfileController();
  $homeControlVar = new HomeController();
  $redirectionURL = "profile.php?userid=".$_SESSION['userid'];
  if (isset($_POST["g-recaptcha-response"])) {
    $response = $_POST["g-recaptcha-response"];
  }
  $_SESSION["g-recaptcha-response"] = $_POST["g-recaptcha-response"];
  if ($response != NULL) {
    $data = array(
		    'secret' => '6Le3TjwUAAAAADZyXnzyh4PF5AjdjLnDUUg3Duk8',
		    'response' => $response
	  );
    $options = array(
      'http' => array (
        'method' => 'POST',
        'header' => 'Content-Type: application/x-www-form-urlencoded',
        'content' => http_build_query($data)
      )
    );
    $context  = stream_context_create($options);
	  $verify = file_get_contents($verificationURL, false, $context);
	  $captcha_success=json_decode($verify);
    // foreach($captcha_success as $key=>$value) {
    //   print_r($key);print_r($value);
    // }
    if ($captcha_success->success==false) {
      $profileControllerVar->redirectToView($redirectionURL);
    } else if ($captcha_success->success==true) {
        $workspaceUrl = "musicf17.slack.com";
        $update_userid = isset($_SESSION['update-userid']) ? $_SESSION['update-userid'] : $_SESSION['userid'];
        unset($_SESSION['update-userid']);
        $size = "500";
        $default_property = "404";
        $profile = array();
        $profilePicPath = "images/users/default-profile-pic.jpg";

        $profile = $homeControlVar->getProfile($_SESSION['userid'], $workspaceUrl);
        $email = (!empty($profile['profile']) && !empty($profile['profile'][0]['email']) != NULL) ? $profile['profile'][0]['email'] : NULL;

        if ($email != NULL) {
          $profilePicPath = $profileControllerVar->getGravatar($email, $default_property, $size, $profilePicPath);
        }
    }
  } else {
    $profileControllerVar->redirectToView($redirectionURL);
  }
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/update.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" src="js/update.js"></script>
  <link rel="icon" href="./images/favicon.jpg" type="image/gif" sizes="16x16">
</head>
<body>
  <div class="row">
    <div class="col-xs-6 root-div">
      <form method="post" action="<?php echo htmlspecialchars('upload.php'); ?>" id="editForm" enctype="multipart/form-data">
        <div class="row">
          <div class="col-xs-6 col-xs-offset-5 root-pic-div">
            <input type="image" id="profile-pic" src="images/users/default-avatar.png">
            <div class="col-xs-6 col-xs-offset-4"> <!-- class="hover-details" -->
              <span class="glyphicon glyphicon-camera profile-camera"></span>
              <span class="profile-text">Change Image</span>
            </div>
            <input type="hidden" name="profile_id" value="<?php echo $_SESSION['userid']; ?>">
            <input type="file" name="uploaded_file" id="profile-browse" onchange="loadFile(event)" multiple accept='image/*' style="display:none;">
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12">
            <div class="client_profile_pic_upload_submit">
              <a href="profile.php?userid=<?php echo $update_userid; ?>" class="btn btn-default">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back
              </a>
              <button type="submit" value="upload" class="btn btn-default">Submit</button>
            </div>
          </div>
        </div>
        <div class="row" >
          <div class="col-xs-6 col-xs-offset-5">
            <p id="message"></p>
          </div>
        </div>
      </form>
    </div>
    <!-- default image -->
    <div class="col-xs-6 root-div">
      <div>
        <img id="default-profile-pic" src="<?php echo $profilePicPath ?>">
      </div>
      <div>
        <form id="default-pic-form" method="post" action="<?php echo htmlspecialchars('router.php'); ?>">
          <input type="hidden" name="profile_id" value="<?php echo $_SESSION['userid'] ?>">
          <button type="submit" value="reset">reset</button>
        </form>
        <p id="msg-log-default"></p>
      </div>
    </div>
  </div>
</body>
</html>
