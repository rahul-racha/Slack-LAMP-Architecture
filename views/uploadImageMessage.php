<?php
session_start();
$_SESSION["basePath"] = "../";
require_once $_SESSION['basePath'].'controllers/home.php';
require_once $_SESSION["basePath"].'controllers/profile.php';

$workspaceUrl = "musicf17.slack.com";
$homeControlVar = new HomeController();
$profileControllerVar = new ProfileController();
$target_dir = "images/messages/";
$uploadedFileName = $_FILES["image_uploaded_post"]["name"];

$target_file = $target_dir.$uploadedFileName;
$uploadOk = 1;
$response = array("result"=>NULL, "message"=>NULL);

$imageType = $profileControllerVar->checkImageType($target_file);
if ($imageType == "" && $imageType == NULL) {
  $uploadOk = 0;
} else {
  $response["result"] = "true";
  $response["message"] = "File is an image - " . $imageType . ".";
}

// Check file size
if ($_FILES["image_uploaded_post"]["size"] > 500000) {
    $response["result"] = "false";
    $response["message"] = $response["message"]."Your file is too large.";
    //echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    $response["result"] = "false";
    $response["message"] = $response["message"]."Your file was not uploaded.";
    echo json_encode($response);
} else {
  if (move_uploaded_file($_FILES["image_uploaded_post"]["tmp_name"], $target_file)) {
    
    $message = $homeControlVar->insertMessage($channelName,$thread_message,$image_path,
               $snippet,$thread_id,$messageType,$workspaceUrl);
  } else {
    $response["result"] = "false";
    $response["message"] = $response["message"]."Sorry, there was an error uploading your file.";
    echo json_encode($response);
  }
}
