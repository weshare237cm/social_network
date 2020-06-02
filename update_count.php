<?php
  session_start();
  include 'includes/connection.php';
  $type = $_POST['type'];
  $id = $_POST['id'];
  $user_id = $_SESSION['user_id'];
  $current_count = $_POST['current_count'];
  if($type == 'like'){
    $query_like = "SELECT * FROM user_content_like WHERE user_id = $user_id AND content_id = $id";
    $run = mysqli_query($con, $query_like);
    $nombre = mysqli_num_rows($run);
    if($nombre == 0){
      $sql = "INSERT INTO user_content_like(content_id, user_id, status) VALUES ($id, $user_id, 1)";
      $sql1 = "UPDATE posts SET like_count = like_count+1 WHERE post_id = $id";
    }
    else {
      $sql = "DELETE FROM user_content_like WHERE user_id = $user_id AND content_id = $id";
      $sql1 = "UPDATE posts SET like_count = like_count-1 WHERE post_id = $id";
    }
  }
  else {
    $sql = "UPDATE posts SET dislike_count = dislike_count+1 WHERE post_id = $id";
  }
  $res = mysqli_query($con, $sql);
  $res1 = mysqli_query($con, $sql1);
?>
