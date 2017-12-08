<?php
  //include_once $_SESSION['basePath'].'errors.php';
  require_once $_SESSION['basePath'].'models/profile.php';

  if (!isset($_SESSION['userid']) || !isset($_SESSION['password']))
  {
   header("location:login.php", true, 303);
  }

  class ProfileController {
    private $profileModelVar;

    public function updateProfile($profileObject) {
      $this->profileModelVar = new ProfileModel();
      $filePath = $profileObject["file_name"];
      $responseString = NULL;
      $affectedRows = $this->profileModelVar->setAvatarPath($filePath);
      if ($affectedRows == 1) {
        $responseString = "true";
      } else {
        $responseString = "false";
      }
      return $responseString;
    }

    public function checkImageType($mediaPath) {
      //$mimeType = "false";
      //if (function_exists('getimagesize')) {
      $check = getimagesize($mediaPath);
      return $check['mime'];
    }
  }


?>
