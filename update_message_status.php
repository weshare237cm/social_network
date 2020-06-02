<?php
  include 'includes/connection.php';
  session_start();
  $u_id = $_SESSION['user_id'];

  mysqli_query($con, "UPDATE user_messages SET msg_seen = 'yes' WHERE user_to = $u_id");
?>
