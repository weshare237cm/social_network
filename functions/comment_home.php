<?php
function number_com(){
  if(isset($_GET['post_id'])){
    global $con;

    $get_id = $_GET['post_id'];
    $get_posts = "SELECT * FROM posts WHERE post_id=$get_id";

    $run_posts = mysqli_query($con, $get_posts);
    $row_posts = mysqli_fetch_array($run_posts);

    $post_id = $row_posts['post_id'];
    $user_id = $row_posts['user_id'];
    $content = $row_posts['post_content'];
    $upload_image = $row_posts['upload_image'];
    $post_date = $row_posts['post_date'];

    $user = "SELECT * FROM users WHERE user_id=$user_id AND posts='yes'";
    $run_user = mysqli_query($con, $user);
    $row_user = mysqli_fetch_array($run_user);

    $user_name = $row_user['user_name'];
    $user_image = $row_user['user_image'];

    $user_com = $_SESSION['user_email'];
    $get_com = "SELECT * FROM users WHERE user_email='$user_com'";
    $run_com = mysqli_query($con, $get_com);
    $row_com = mysqli_fetch_array($run_com);

    $user_com_id = $row_com['user_id'];
    $user_com_name = $row_com['user_name'];

    if(isset($_GET['post_id'])){
      $post_id = $_GET['post_id'];
    }

    $get_posts = "SELECT post_id FROM users WHERE post_id=$post_id";
    $run_user = mysqli_query($con, $get_posts);

    $post_id = $_GET['post_id'];

    $post = $_GET['post_id'];
    $get_user = "SELECT * FROM posts WHERE post_id=$post";
    $run_user = mysqli_query($con, $get_user);
    $row = mysqli_fetch_array($run_user);

    $p_id = $row['post_id'];

      include 'comments.php';

      return $nombre_com;

  }
}
?>
