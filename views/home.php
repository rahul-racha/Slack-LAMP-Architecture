<?php
  //session_start();
  //$_SESSION['basePath'] = '../';
  //session_write_close();
  //require_once $_SESSION['basePath'].'controllers/home.php';
  require 'homepage.php';
  echo '<script>'.
       'var userID = '.json_encode($_SESSION['userid']).';'.
       'var userRole = '.json_encode($_SESSION['userRole']).';'.
       '</script>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/homepage.css">
  <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/home.js"></script>
  <script type="text/javascript" src="js/typeahead.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container-fluid">
    <div class="row client_main_row">
      <div class="col-xs-2 client_navbar row change_row_prop">
      <!-- side nav bar -->
        <div class="client_navbar_header col-xs-12 row">
          <div class="dropdown col-xs-12">
            <button class="btn btn-default dropdown-toggle client_navbar_dropdown_button" type="button" data-toggle="dropdown">Musicf17.slack.com
            <span class="caret"></span></button>
            <ul class="dropdown-menu client_navbar_dropdown_ul">
              <li class="dropdown-header">
                <img style="width: 20%;" src='<?php echo "images/users/".$_SESSION['userid'].".jpg" ?>'> &nbsp
                <?php echo $_SESSION['userid']; ?>
              </li>
              <li class="divider"></li>
              <li>
                <a href='<?php echo "profile.php?userid=".$_SESSION['userid']; ?>'>
                  <span style="color:black;">Profile & Account</span>
                </a>
              </li>
              <li><a href="help.html">Help</a></li>
              <!-- <li><a href="#">JavaScript</a></li> -->
              <!-- <form method="post" action="<?php //echo htmlspecialchars("router.php"); ?>">
                <input type="submit" name="logout" value="logout">
              </form> -->
              <li class="divider"></li>
                <form method="post" action="<?php echo htmlspecialchars("router.php"); ?>">
                  <li>
                    <input type="submit" name="logout" value="logout" style="border:0;margin-left:5%;">
                  </li>
                </form>
                <!-- <a href="#">logout</a></li> -->
            </ul>
          </div>
        </div>
        <div class="client_channel_header col-xs-12 row">
          <h4>Channels
            <a href="#" class="client_new_chanenl" data-toggle="modal" data-target="#NewChannel">
              <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
          </h4>
        </div>
				<div class="client_channel_display col-xs-12 row">
        	<?php displayChannels(); ?>
				</div>
      </div>
      <div id="msg-cont" class="client_main_continer col-xs-10 row change_row_prop">
        <div class="client_message_header col-xs-12 row change_row_prop">
          <!-- header -->
          <div class="client_channel_title col-xs-8">
            <h5 class="client_channel_title_view"><strong><?php echo $channelHeading;?></strong></h5>
          </div>
          <div class="right-inner-addon serch_users_in_workspace col-xs-3">
            <!-- <i class="fa fa-search" aria-hidden="true"></i> -->
            <input type="text" class="client_user_search" autocomplete="off" spellcheck="false" id="wrkspace_user_search" placeholder="Search for names..">
          </div>

          <div class="col-xs-1">
          </div>
          <div class="client_invite_users col-xs-12">
            <a class="client_invite_users_link" href="#" data-toggle="modal" id="inviteUserLink" data-target = "#inviteUsers">
              <i class="fa fa-user-o" aria-hidden="true"></i>
            </a>
            <a class="client_invite_users_link" href="#" data-toggle="modal" id="removeUserLink" data-target = "#removeUsers">
              <i class="fa fa fa-trash-o" aria-hidden="true"></i>
            </a>
            <button type="button" id="archiveButton" value="<?php echo $_POST["channel"]; ?>" class="btn btn-primary"><?php echo $chStatus; ?></button>
          </div>
        </div>
        <div class="client_user_search_suggestions">
          <ul class="justList">

          </ul>
        </div>
        <div class="client_message_display col-xs-12 row change_row_prop">
          <?php
            $retChannel=0;
            $_SESSION['loadCount'] = 5;
            $channel_name = $_POST["channel"];
            // echo $channel_name;
            displayMessages($retChannel,$channel_name);
          ?>
        </div>
          <!-- messge container -->
        	<div class="client_message_entry col-xs-12 row change_row_prop">
            <div class="input-group">
              <span class="input-group-addon">
                <div class="dropup">
                  <a class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-plus" aria-hidden="true"></i></a>
                  <!-- <span class="caret"></span> -->
                  <ul class="dropdown-menu">
                    <li><a class="client_code_snippet_button" data-toggle="modal" data-target="#client_code_snippet">Code snippet</a></li>
                    <li><a class="client_code_snippet_button" data-toggle="modal" data-target="#client_Add_image_to_post">Add image</a></li>
                    <!-- <li><span><a>Add images</a><input type="file"></span></li> -->
                    <!-- <li><a href="#">JavaScript</a></li>
                    <li class="divider"></li>
                    <li><a href="#">About Us</a></li>($_POST["channelHeading"]) ? $_POST["channelHeading"]: NULL -->
                  </ul>
                </div>
              </span>
  						<form method="post" action="<?php echo htmlspecialchars('router.php'); ?>">
                <textarea id="textArea" class="client_message_entry_textarea col-xs-11" type="text" name="textarea" placeholder="<?php echo "Message "."@".$_POST["channel"] ?>" required></textarea>
                <input type="hidden" name="channel" value="<?php echo $_POST["channel"]; ?>"/>
                <input type="hidden" name="channelHeading" value="<?php echo $channelHeading; ?>"/>
                <input type="hidden" name="chStatus" value="<?php echo $chStatus; ?>"/>
                <input id="retChannel" type="hidden" name="channel" value="<?php echo $_POST["channel"]; ?>"/>
                <input id="SubmitButton" class="col-xs-1 client_messsage_entry_submit_button" type="submit" name="submit"/>
              </form>
          </div>
          </div>
      </div>
      <div class="client_thread_display_main" >
        <div class="well client_thread_header">
          <h4 class="client_thread_title">Thread
          <a class="close_thread_display">x</a>
          </h4>
        </div>
        <div class="client_thread_message_display_area">
          <div class="client_thread_list">
            <!-- reply messages display -->
          </div>
        </div>
      </div>
      <div class="client_user_profile_display_main">
        <div class="well client_thread_header">
          <h4> Profile Page
            <a class="close_thread_display">x</a>
          </h4>
        </div>
        <div class="client_user_profile_display">
          <!-- profile page -->
        </div>
      </div>
    </div>

  </div> <!--end of main container -->

  <!-- modal for user profile -->
  <div class="modal fade" id="client_profile_page" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Your Profile</h4>
        </div>
        <div class="modal-body">
          <form id="editForm" method="post" action="profile.php" enctype="multipart/form-data">
          <div class="row">

            <div class="col-xs-8">

                  <div class="form-group">
                    <label for="FirstName">First Name</label>
                    <input type="text" class="form-control" placeholder="First Name" name="FirstName" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="LastName">Last Name</label>
                    <input type="text" class="form-control" placeholder="Last Name" name="LastName" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="Status">Status</label>
                    <input type="text" class="form-control" placeholder="What is your status" name="Status" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="PhoneNumber">Phone number</label>
                    <input type="text" class="form-control" placeholder="(123) 456-7891" name="PhoneNumber" autocomplete="off">
                  </div>


            </div>
            <div class="col-xs-4">
              <!-- avatar details goes here -->
              <input type="image" id="profile-pic" src="images/users/default-avatar-250x250.png" width="170px">
              <input type="file" id="profile-browse" onchange="loadFile(event)" multiple accept='image/*' style="display:none;">
            </div>

          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="checkbox">
                <label><input type="checkbox" name="remember"> Remember me</label>
              </div>
              <button type="submit" value="upload" class="btn btn-default">Submit</button>
            </div>
          </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- create new channel -->
  <div class="modal fade" id="NewChannel" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create New Channel</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-xs-8">
                <form method="post" action="<?php echo htmlspecialchars('router.php'); ?>" id= "NewChannel">
                  <div class="form-group">
                    <label for="ChannelName">Channel Name</label>
                    <input type="text" class="form-control" placeholder="Channel name" name="channel" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="Purpose">Purpose</label>
                    <input type="text" class="form-control" placeholder="Purpose of Channel" name="purpose" autocomplete="off">
                  </div>
                  <div class="radio">
                    <label><input type="radio" name="channelType" value="Public">Public</label>
                    <label><input type="radio" name="channelType" value="Private">Private</label>
                  </div>
                  <div class="form-group">
                    <label for="invitingNewUsers">Invite members to this channel</label>
                    <input type="text" class="form-control" name="newUserSearch[]">
                  </div>
                  <input type="hidden" name="newChannel" value="newChannel">
                  <input type="hidden" name="chStatus" value="unarchived">
                  <input type="submit" value="Create Channel" class="btn btn-primary btn-sm">
                </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- invite user to channels -->
  <div class="modal fade" id="inviteUsers" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Invitation</h4>
        </div>
        <div class="modal-body">
          <form method="post" action="<?php echo htmlspecialchars('router.php'); ?>">
            <label for="invitingNewUsers">Invite member</label>
            <div id="inviteUsersSearchBox" class="form-group inviteUserClass">
              <input type="text" class="form-control typeahead" name="addUserExistingChannel[]">
            </div>
            <div class = "inviteUserClass">
              <input type="hidden" name = "channel" value = "<?php echo $_POST['channel']; ?>" >
              <input type="hidden" name="channelHeading" value="<?php echo isset($_POST["channelHeading"]) ? $_POST["channelHeading"] : NULL; ?>"/>
              <input type="hidden" name="chStatus" value="<?php echo $chStatus; ?>"/>
              <input type="hidden" name="inviteUsersExistingChannel" value = "inviteUser">
              <input type="submit" value="Invite" class="btn btn-primary btn-sm">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Remove Users -->
  <div class="modal fade" id="removeUsers" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Cancel Membership</h4>
        </div>
        <div class="modal-body">
          <form method="post" action="<?php echo htmlspecialchars('router.php'); ?>">
            <label for="removingNewUsers">Remove member</label>
            <div id="delUsersSearchBox" class="form-group delUserClass">
              <input type="text" class="form-control typeahead" name="removeUserExistingChannel[]">
            </div>
            <div class = "delUserClass">
              <input type="hidden" name = "channel" value = "<?php echo $_POST['channel']; ?>" >
              <input type="hidden" name="channelHeading" value="<?php echo isset($_POST["channelHeading"]) ? $_POST["channelHeading"] : NULL; ?>"/>
              <input type="hidden" name="chStatus" value="<?php echo $chStatus; ?>"/>
              <input type="hidden" name="removeUsersExistingChannel" value = "removeUser">
              <input type="submit" value="Remove" class="btn btn-primary btn-sm">
            </div>
          </form>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Code snippet -->
  <div class="modal fade" id="client_code_snippet" role="dialog">
    <div class="modal-dialog modal-lg client_code_snippet_modal_body">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <input id="retChannel" type="hidden" name="channel" value="<?php echo $_POST["channel"]; ?>"/>
          <textarea class="client_code_snippet_textarea" rows="9"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default client_snippet_submit" data-dismiss="modal">Create Snippet</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Add image -->
  <div class="modal fade" id="client_Add_image_to_post" role="dialog">
    <div class="modal-dialog modal-lg client_code_snippet_modal_body">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body client_add_image_modal_body">

          <div class="form-group">
            <label>Upload Image</label>
            <div class="input-group">
              <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                  Browse… <input type="file" name="image_uploaded_post" id="imgInp">
                </span>
              </span>
              <input id="retChannel" type="hidden" name="channel" value="<?php echo $_POST["channel"]; ?>"/>
              <input type="text" class="form-control client_image_upload_read" readonly>
            </div>
            <img id='img-upload'/>
          </div>
          <center><p>or</p></center>
          <div>
            <span>Images from web</span>
            <input style="width:100%" class="client_image_upload_from_url"></input>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default client_add_image_submit_button" data-dismiss="modal">Add image</button>
        </div>
      </div>
    </div>
  </div>


</body>
</html>
