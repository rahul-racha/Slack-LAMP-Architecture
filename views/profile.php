<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="./images/favicon.jpg" type="image/gif" sizes="16x16">
</head>
</html>
<?php
session_start();
$_SESSION['basePath'] = '../';
require_once $_SESSION['basePath'].'controllers/home.php';

$homeControlVar = new HomeController();
$workspaceUrl = "musicf17.slack.com";
//$user_messages_count = NULL;
//$emo_count_user = NULL;
//$t_rxn_count = NULL;
//$t_post_count = NULL;
// $ch_metrics_user = array();
$user_profile = array();
$metrics = array();
$postRating = NULL;
$rxnRating = NULL;
$emoCount = array("likes"=>0,"dislikes"=>0);

if (isset($_GET['userid'])) {
    global $homeControlVar;
    global $workspaceUrl;
    global $user_profile;
    global $metrics;
    global $postRating;
    global $rxnRating;
    global $emoCount;

    $user_id = $_GET['userid'];
    $_SESSION['update-userid'] = $_GET['userid'];
		$user_profile = $homeControlVar->getProfile($user_id, $workspaceUrl);
    $metrics = $homeControlVar->getUserMetrics($user_id, $workspaceUrl);
    $channelList = array();
    $channelList = $homeControlVar->retChannelsOfUser($user_id, $workspaceUrl);
    $metricRxArray = array();
    if (isset($metrics['reaction']) && !empty($metrics['reaction']) && $metrics['reaction'] != NULL) {
      $metricRxArray = $metrics['reaction'];
    }
    $postRating = computePostRatings($metrics['post'], $metrics['relPost']);
    $rxnRating = computeRxnRatings($metricRxArray, $channelList);
    $emoCount = computeEmoRating($metricRxArray);
}

function computeEmoRating($rxnInfo) {
  global $homeControlVar;
  global $workspaceUrl;

  $tlikes = 0;
  $tdislikes = 0;
  $total = array("likes"=>0,"dislikes"=>0);
  foreach ($rxnInfo as $valuePrime) {
    $tempKey = NULL;
    foreach ($valuePrime as $key=>$value) {

      if ($key != "channel_name") {
      if ($value == "like") {
        $tempKey = "like";
      } else if ($value == "dislike") {
        $tempKey = "dislike";
      }
      if ($tempKey == "dislike" && $key == "emo_count") {
        $tdislikes = $tdislikes + $value;
        $tempKey = NULL;
      } else if ($tempKey == "like" && $key == "emo_count") {
        $tlikes = $tlikes + $value;
        $tempKey = NULL;
      }
      //print_r($value);
    // if ($value['emo_name'] == "like") {
    //   $tlikes = $tlikes + $value['emo_count'];
    // } else if ($value['emo_name'] == "dislike") {
    //   $tdislikes = $tdislikes + $value['emo_count'];
    // }
  }
  }
  }

  $total["likes"] = $tlikes;
  $total["dislikes"] = $tdislikes;
  return $total;
}

function computeRxnRatings($rxnInfo, $channelList) {
  global $homeControlVar;
  global $workspaceUrl;
  $rxnRelCount = 0;
  $rxnCount = 0;
  $rating = 0;
  foreach ($rxnInfo as $value) {
    $rxnCount = $rxnCount + $value['emo_count'];
  }

  foreach ($channelList as $channel) {
    $userList = array();
    $userRxnCountList = array();
    $userList = $homeControlVar->retUsersFromChannel($channel, $workspaceUrl);
    foreach ($userList as $user) {
       $temp = $homeControlVar->getChMetricsForUser($user, $channel, $workspaceUrl);
       array_push($userRxnCountList, $temp);
    }
      $rxnRelCount = $rxnRelCount + max($userRxnCountList);
    }
   if ($rxnCount != 0 && $rxnRelCount != 0) {
     $rating = ($rxnCount/$rxnRelCount)*100;
   }
  return $rating;
}

function computePostRatings($postInfo, $relPostInfo) {
  $postCount = 0;
  $postRelCount = 0;
  $rating = 0;
  //if (count($postInfo) == count($relPostInfo)) {
    foreach($postInfo as $value) {
      $postCount = $postCount + $value["msg_count"];
    }
    foreach($relPostInfo as $value) {
      $postRelCount = $postRelCount + $value["max_count"];
    }
    // for ($x = 0; $x < count($postInfo); $x++) {
    //   $postCount = $postCount + $postInfo[$x]["msg_count"];
    //   $postRelCount = $postRelCount + $relPostInfo[$x]["max_count"];
    // }
    if ($postCount != 0 && $postRelCount != 0) {
      $rating = ($postCount/$postRelCount)*100;
    }
  //}
  return $rating;
}

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/starRating.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
  <body>
    <div class="container well">
	    <div class="row-fluid">
        <div class="col-xs-12" style="margin-bottom:2%;">
          <a href="home.php" class="btn btn-default">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp Back
          </a>
        </div>
        <div class="col-xs-3" >
		      <img src="<?php echo $user_profile["profile"][0]["avatar"] ?>" style="height:100px;">
        </div>
        <div class="col-xs-7">
          <h3><?php echo $user_profile["profile"][0]["first_name"]."   ".$user_profile["profile"][0]["last_name"]; ?></h3>
          <h6>Email: <?php echo $user_profile["profile"][0]["user_id"]; ?></h6>
          <h6>Public Channels </h6>
          <ul style="list-style: none;">
            <?php
              //echo "<h6>Public:</h6>";
              //print_r($user_profile["membership"]);
              foreach ($user_profile["membership"] as $value) {
                if($value["type"]== 'Public'){
                 echo "<li>". $value["channel_name"] ."</li>";
                }
              }
              // echo "<h6>Private:</h6>";
              // foreach ($user_profile["membership"] as $value) {
              //   if($value["type"]== "Private") {
              //    echo "<li>". $value['channel_name'] ."</li>";
              //   }
              // }
            ?>
          </ul>

          <ul style="list-style: none;">
            <?php
              $postMetrics = array();
              $postMetrics = $metrics["post"];
              echo "<li><strong>"."Channel -- #Messages"."</strong></li>";
              foreach ($postMetrics as $value) {
                echo "<li>".$value["channel_name"]." -- ".$value["msg_count"]."</li>";
                //$user_messages_count += $value["msg_count"];
              }
            ?>
          </ul>

          <ul style="list-style: none;">
            <?php
            $like_count = 0;
            $dislike_count = 0;
                $rxnMetrics = array();
                $rxnMetrics = $metrics["reaction"];
                // print_r($rxnMetrics);
                echo "<li><strong>"."Channel -- #Reactions"."</strong></li>";
                foreach ($rxnMetrics as $value) {
                  if($value["emo_name"] == "like"){
                    $like_count = $value["emo_count"];
                  }
                  else {
                    $dislike_count = $value["emo_count"];
                  }
                  echo "<li>".$value["channel_name"]." -- ". $value["emo_name"]. " -- ". $value["emo_count"]. "</li>";
                }
            ?>
          </ul>

            <?php
              echo "<h6>Post Metrics: </h6>";
              echo "<div class='star-ratings-sprite'>
                      <span style='width:".$postRating."%' class='star-ratings-sprite-rating'></span>
                    </div>
                    <span style='margin-left:2%;'>".$postRating."%</span>";

              echo "<h6>Reaction Metrics:</h6>";
              echo "<div class='star-ratings-sprite'>
                      <span style='width:".$rxnRating."%' class='star-ratings-sprite-rating'></span>
                    </div>
                    <span style='margin-left:2%;'>".$rxnRating."%</span>
                    <i class='fa fa-thumbs-o-up' aria-hidden='true'></i>
                    <span>".$emoCount["likes"]."</span>
                    <i class='fa fa-thumbs-o-down' aria-hidden='true'></i>
                    <span>".$emoCount["dislikes"]."</span>";
            ?>
          <!-- </ul> -->
        </div>
        <div class="col-xs-2">
          <div class="btn-group">
              <a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">
                  Action
                  <span class="icon-cog icon-white"></span><span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                  <li><a href="recaptcha.php"><span class="icon-wrench"></span> Modify</a></li>
                  <!-- ?userid=<?php //echo $_GET['userid']; ?>
                  <!-- <li><a href="#"><span class="icon-trash"></span> Delete</a></li> -->
              </ul>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
