<?php
session_start();
$_SESSION['basePath'] = '../';
require_once $_SESSION['basePath'].'controllers/home.php';

$homeControlVar = new HomeController();
$user_profile = array();
$metrics = array();
  if(isset($_GET['userid'])){
    global $homeControlVar;
    global $user_profile;
    global $metrics;
		$user_profile = array();
    $user_id = $_GET['userid'];
		$user_profile = $homeControlVar->getProfile($user_id);
    $metrics = $homeControlVar->getUserMetrics($user_id);
    //var_dump($metrics);
  }
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
  <body>
    <div class="container well">
	    <div class="row-fluid">
        <div class="col-xs-3" >
		      <img src="http://i.axs.com/2014/11/promoted-media-optimized_545bb90b3fc9a.jpg" style="height:100px;">
        </div>
        <div class="col-xs-7">
          <h3><?php echo $user_profile["profile"][0][first_name]."   ".$user_profile["profile"][0][last_name]; ?></h3>
          <h6>Email: <?php echo $user_profile["profile"][0][user_id]; ?></h6>
          <h6>Channels: </h6>
          <ul style="list-style: none;">
            <?php
              echo "<h6>Public:</h6>";
              foreach ($user_profile["membership"] as $value) {
                if($value["type"]== 'Public'){
                 echo "<li>". $value["channel_name"] ."</li>";
                }
              }
              echo "<h6>Private:</h6>";
              foreach ($user_profile["membership"] as $value) {
                if($value["type"]== 'Private'){
                 echo "<li>". $value["channel_name"] ."</li>";
                }
              }
            ?>
          </ul>
          <h6>Post Metrics: </h6>
          <ul style="list-style: none;">
            <?php
              $postMetrics = array();
              $postMetrics = $metrics["post"];
              echo "<li><strong>"."Channel -- #Messages"."</strong></li>";
              foreach ($postMetrics as $value) {
                echo "<li>".$value["channel_name"]." -- ".$value["msg_count"]."</li>";
                $total_messages_count += $value["msg_count"];
                $num_channels++;
              }
            ?>
          </ul>
          <h6>Reaction Metrics:</h6>
          <ul style="list-style: none;">
            <?php
                $rxnMetrics = array();
                $rxnMetrics = $metrics["reaction"];
                echo "<li><strong>"."Channel -- Emoticon -- #Rxn"."</strong></li>";
                foreach ($rxnMetrics as $value) {
                  echo "<li>".$value["channel_name"]." -- ". $value["emo_name"]. " -- ". $value["emo_count"]. "</li>";
                  $total_emo_count += $value["emo_count"];
                }
            ?>
          </ul>
          <!-- <h6><a href="#">More... </a></h6> -->
          <?php
            echo "<strong>Rating: </strong>";
            // echo $total_messages_count;
            // echo $num_channels;
            // echo $total_emo_count;
            // $rating = ($total_messages_count * 0.5) + ($total_emo_count * 0.5);
            echo $rating;
          ?>
        </div>
        <div class="col-xs-2">
          <div class="btn-group">
              <a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">
                  Action
                  <span class="icon-cog icon-white"></span><span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                  <li><a href="update.php"><span class="icon-wrench"></span> Modify</a></li>
                  <li><a href="#"><span class="icon-trash"></span> Delete</a></li>
              </ul>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
