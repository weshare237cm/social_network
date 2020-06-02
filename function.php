<?php
  function is_user_has_already_like_content($con, $user_id, $content_id){
    $query = "SELECT * FROM user_content_like WHERE content_id = $content_id AND user_id = $user_id";

    $statement = mysqli_query($con, $query);
    $total_rows = mysqli_num_rows($statement);

    if($total_rows > 0){
      return true;
    }
    else {
      return false;
    }
  }

  function count_content_like($con, $content_id){
    $query = "SELECT * FROM user_content_like WHERE content_id=$content_id";

    $statement = mysqli_query($con, $query);
    $total_rows = mysqli_num_rows($statement);
    return $total_rows;
  }
?>
