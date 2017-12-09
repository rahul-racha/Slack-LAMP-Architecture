<?php
session_start();
$_SESSION["basePath"] = "../";
require_once $_SESSION["basePath"].'controllers/profile.php';

$profile_id = NULL;

if (isset($_POST["profile_id"])) {
  $profile_id = $_POST["profile_id"];
}

$profileControllerVar = new ProfileController();
$target_dir = "images/users/";
$uploadedFileName = $_FILES["uploaded_file"]["name"];
$imageFileType = pathinfo($uploadedFileName,PATHINFO_EXTENSION);
//$fileType = new SplFileInfo($uploadedFileName);
$target_file = $target_dir . $_SESSION['userid'].".".$imageFileType;//basename($_FILES["uploaded_file"]["name"]);
//$target_file = $target_dir .basename($_FILES["uploaded_file"]["name"]);
$uploadOk = 1;
//$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$response = array("result"=>NULL, "message"=>NULL);
// Check if image file is a actual image or fake image
//if(isset($_POST["submit"]) && $_POST["submit"] == "upload") {
    $check = getimagesize($_FILES["uploaded_file"]["tmp_name"]);
    if($check !== false) {
        $response["result"] = "true";
        $response["message"] = "File is an image - " . $check["mime"] . ".";
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $response["result"] = "false";
        $response["message"] = "File is not an image.";
        //echo "File is not an image.";
        $uploadOk = 0;
    }


// Check if file already exists
if (file_exists($target_file)) {
    $response["result"] = "false";
    $response["message"] = $response["message"]."File overwritten.";
    //echo "Sorry, file already exists.";
    unlink($target_file);
    $uploadOk = 1;
}

// Check file size
if ($_FILES["uploaded_file"]["size"] > 500000) {
    $response["result"] = "false";
    $response["message"] = $response["message"]."Your file is too large.";
    //echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $response["result"] = "false";
    $response["message"] = $response["message"]."Only JPG, JPEG, PNG & GIF files are allowed.";
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $response["result"] = "false";
    $response["message"] = $response["message"]."Your file was not uploaded.";
    echo json_encode($response);
    //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], $target_file)) {
        //global $profileControllerVar;
        //global $profile_id;
        $profileObject = array();
        $profileObject["file_name"] = $target_file;
        $profileObject["profile_id"] = $profile_id;

        $reply = $profileControllerVar->updateProfile($profileObject);

        if ($reply == "true") {
          $response["result"] = "true";
          $response["message"] = $response["message"]."The file ". basename( $_FILES["uploaded_file"]["name"]). " has been uploaded.";
        } else {
          unlink($target_file);
          $response["result"] = "false";
          $response["message"] = $response["message"]."Sorry, there was an error uploading your file.";
        }
        echo json_encode($response);
        //echo "The file ". basename( $_FILES["uploaded_file"]["name"]). " has been uploaded.";
    } else {
        $response["result"] = "false";
        $response["message"] = $response["message"]."Sorry, there was an error uploading your file.";
        echo json_encode($response);
        //echo "Sorry, there was an error uploading your file.";
    }
}
//}

?>
