<?php
  //include_once $_SESSION['basePath'].'errors.php';
  require_once $_SESSION['basePath'].'models/profile.php';

  if (!isset($_SESSION['userid']) || !isset($_SESSION['password']))
  {
   header("location:login.php", true, 303);
  }

  class ProfileController {
    private $profileModelVar;

    public function redirectToView($redirectionURL) {
      header("location:".$redirectionURL);
    }

    public function updateProfile($profileObject) {
      $this->profileModelVar = new ProfileModel();
      $filePath = $profileObject["file_name"];
      $profileID = $profileObject["profile_id"];
      $responseString = NULL;
      $affectedRows = $this->profileModelVar->setAvatarPath($filePath, $profileID);
      if ($affectedRows == 1) {
        $responseString = "true";
      } else {
        $responseString = "false";
      }
      return $responseString;
    }

    public function getResponseCode($url) {
      $http_code = NULL;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch,  CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_ENCODING ,'identity');
      curl_exec($ch);
      // Check HTTP status code
      if (!curl_errno($ch)) {
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        // switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
        //   case 200:
        //     $code = 200;
        //     break;
        //   case 404:
        //     $code = 404;
        //     break;
        //   default:
        //     $code = 0;
        //     //echo 'Unexpected HTTP code: ', $http_code, "\n";
        // }
      }
      curl_close($ch);
      return $http_code;
    }

    public function getGravatar($email, $default, $size, $localDefaultPic) {
      $profilePath = NULL;
      $url = 'https://www.gravatar.com/avatar/';
      $url .= md5( strtolower( trim( $email ) ) );
      $url .= "?d=$default&s=$size";
      $http_code = $this->getResponseCode($url);
      if ($http_code == 200) {
        $profilePath = $url;
      } else {
        $profilePath = $localDefaultPic;
      }
      return $profilePath;

    }

    public function checkImageType($mediaPath) {
      //$mimeType = "false";
      //if (function_exists('getimagesize')) {
      $check = getimagesize($mediaPath);
      return $check['mime'];
    }
  }


?>
