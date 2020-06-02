<?php
include 'includes/connection.php';
  $msg = htmlentities($_REQUEST['msg_box']);
  if($msg == ""){
    echo "<h4 style='color: red; text-align: center;'>Message was unable to send!</h4>";
  }
  else if(strlen($msg) > 37){
    echo "<h4 style='color: red; text-align: center;'>Message is too long! Use only 37 characters</h4>";
  }
  else {
    $insert = "INSERT INTO user_messages (user_to, user_from, msg_body, date, msg_seen) VALUES ('$user_to_msg', '$user_from_msg', '$msg', NOW(), 'no')";

    $run_insert = mysqli_query($con, $insert);
  }
?>
