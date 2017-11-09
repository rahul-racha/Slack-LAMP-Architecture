<?php
  //session_start();
  //$_SESSION['basePath'] = '../';
  //session_write_close();
  //require_once $_SESSION['basePath'].'controllers/home.php';
  require 'homepage.php';
  require 'reactions.php';
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container-fluid">
    <div class="row client_main_row">
      <div class="col-xs-2 client_navbar row change_row_prop">
      <!-- side nav bar -->
        <div class="client_user_profile_button row change_row_prop">
          <input type="submit" class="btn btn-info " data-toggle="modal" data-target="#client_profile_page" value="musicf17.slack.com">
        </div>
        <div class="client_channel_display row">
          <h4>Channels
            <a href="#" class="client_new_chanenl" data-toggle="modal" data-target="#NewChannel">
              <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
          </h4>
        </div>
				<div class="client_channel_display row">
        	<?php displayChannels(); ?>
				</div>
      </div>
      <div class="col-xs-10 client_main_continer">
        <div class="client_message_header row change_row_prop">
          <!-- header -->
          <div class="client_channel_title row change_row_prop">
            <h5 class="client_channel_title_view"><strong><?php echo "#" . $channelName;?></strong></h5>
            <!-- inviting new users after creating channel -->
          </div>
          <div class="client_invite_users row change_row_prop">
            <a class="client_invite_users_link" href="#" data-toggle="modal" data-target = "#inviteUsers">
              <i class="fa fa-user-o" aria-hidden="true"></i>
            </a>
          </div>
        </div>
        <div class="client_message_display row change_row_pro">
          <?php displayMessages(); ?>
        </div>
          <!-- messge container -->
        	<div class="client_message_entry col-xs-12">
						<form method="post" action="<?php echo htmlspecialchars('router.php'); ?>">
              <input id="textArea" class="client_message_entry_textarea" type="text" name="textarea" placeholder="<?php echo "Message "."@".$_POST["channel"] ?>" required>
              <input type="hidden" name="channel" value="<?php echo $_POST["channel"]; ?>"/>
              <input id="SubmitButton" type="hidden" name="submit"/>
            </form>
          </div>
      </div>
      <div class="client_thread_display_main col-xs-3 row">
        <div class="well client_thread_header col-xs-12">
          <h4 class="client_thread_title">Thread
          <a class="close_thread_dispaly_area">x</a>
          </h4>
        </div>
        <div class="client_thread_message_display_area col-xs-12">
          <div class="client_thread_list">

          </div>
        </div>
        <div class="client_thread_reply_entry_area col-xs-12">
          <input class="client_thread_reply_input" type="text">
          <input type="hidden">
        </div>
      </div>
			<!-- <div class="col-xs-2 client_thread_main_contianer" style="display:none;">
				I am here
			</div> -->
    </div>
    <!-- <form method="post" action="<?php //echo htmlspecialchars("router.php"); ?>">
      <input type="submit" name="logout" value="logout">
    </form> -->
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
          <div class="row">
            <div class="col-xs-8">
                <form action="/action_page.php">
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
                  <div class="checkbox">
                    <label><input type="checkbox" name="remember"> Remember me</label>
                  </div>
                  <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
            <div class="col-xs-4">
              <!-- avatar details goes here -->
              <input type="image" src="https://www.fancyhands.com/images/default-avatar-250x250.png" width="30px"/>
              <input type="file" id="my_file" style="display: none;" />
            </div>
          </div>
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
            <div class="form-group">
              <label for="invitingNewUsers">Invite members</label>
              <input type="text" class="form-control" name="addUserExistingChannel[]">
            </div>
              <input type="hidden" name = "channel" value = "<?php echo $_POST['channel']; ?>" >
              <input type="hidden" name="inviteUsersExistingChannel" value = "inviteUser">
              <input type="submit" value="Invite" class="btn btn-primary btn-sm">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
