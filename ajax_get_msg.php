<?php
  include 'includes/connection.php';
  $user1 = $_GET['user1'];
  $user2 = $_GET['user2'];
    $sel_msg = "SELECT * FROM user_messages WHERE (user_to='$user1' AND user_from='$user2') OR (user_from='$user1' AND user_to='$user2') ORDER BY 1 DESC LIMIT 10";
    $result = mysqli_query($con, $sel_msg);

    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

    echo json_encode($row);
?>
