<?php

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/update.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/update.js"></script>
</head>
<body>
  <div class="row">
    <div class="col-xs-12 root-div">
      <form method="post" action="upload.php" id="editForm" enctype="multipart/form-data">
        <div class="row">
          <div class="col-xs-6 col-xs-offset-5 root-pic-div">
            <input type="image" id="profile-pic" src="images/users/default-avatar.png">
            <div class=hover-details>
              <span class="glyphicon glyphicon-camera profile-camera"></span>
              <span class="profile-text">Change Image</span>
            </div>
            <input type="file" name="uploaded_file" id="profile-browse" onchange="loadFile(event)" multiple accept='image/*' style="display:none;">
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12">
            <div class="client_profile_pic_upload_submit">
              <a href="profile.php" class="btn btn-default">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp Back
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
  </div>
</body>
</html>
