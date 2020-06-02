<?php
  include 'includes/connection.php';
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $msg = $_POST['msg_box'];
    $user1 = $_POST['user1'];
    $user2 = $_POST['user2'];

    $insert = "INSERT INTO user_messages (user_to, user_from, msg_body, date, msg_seen) VALUES ('$user1', '$user2', '$msg', NOW(), 'no')";

    $run_insert = mysqli_query($con, $insert);
    echo "ok";
  }
?>
