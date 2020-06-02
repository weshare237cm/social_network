<!DOCTYPE html>
<?php
  session_start();
  include 'includes/header.php';

  if(!isset($_SESSION['user_email'])){
    header("location: index.php");
  }
?>
<html lang="en" dir="ltr">
  <head>
    <title>Find People</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style/w3.css">
    <link rel="stylesheet" href="style/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/home_style2.css">
    <link rel="stylesheet" href="style/style.css">
  </head>
  <body>
    <div class="w3-container w3-content" style="max-width:1600px;margin-top:80px">
      <?php
        if(isset($_GET['u_id'])){
          $u_id = $_GET['u_id'];
        }

        if($u_id < 0 || $u_id == ""){
          echo "<script>window.open('home.php', '_self')</script>";
        }
        else {
      ?>
      <div class="col-sm-12">
        <?php
          if(isset($_GET['u_id'])){
            global $con;

            $user_id = $_GET['u_id'];
            $select = "SELECT * FROM users WHERE user_id=$user_id";

            $run = mysqli_query($con, $select);
            $row = mysqli_fetch_array($run);

            $name = $row['user_name'];
          }
        ?>

        <?php
          if(isset($_GET['u_id'])){
            global $con;

            $user_id = $_GET['u_id'];
            $select = "SELECT * FROM users WHERE user_id=$user_id";
            $run = mysqli_query($con, $select);
            $row = mysqli_fetch_array($run);

            $id = $row['user_id'];
            $image = $row['user_image'];
            $name = $row['user_name'];
            $f_name = $row['f_name'];
            $l_name = $row['l_name'];
            $describe_user = $row['describe_user'];
            $country = $row['user_country'];
            $gender = $row['user_gender'];
            $register_date = $row['user_reg_date'];

            $following = "SELECT * FROM followers WHERE follower_id=$user_id";
            $run1 = mysqli_query($con, $following);
            $nombre1 = mysqli_num_rows($run1);

            $follower = "SELECT * FROM followers WHERE followed_id=$user_id";
            $run2 = mysqli_query($con, $follower);
            $nombre2 = mysqli_num_rows($run2);

            echo "<div class='row'>
                    <div class='col-sm-1'>
                    </div>
                    <center>
                      <div class='col-sm-3' style='background: #e6e6e6;'>
                        <h2>Informations About</h2>
                        <img class='img-circle' src='users/$image' width='150' height='150'/><br/><br/>
                        <ul class='list-group'>
                          <li class='list-group-item' title='Username'><strong>$f_name $l_name</strong></li>
                          <li class='list-group-item' title='User Status'><strong style='color: grey;'>$describe_user</strong></li>
                          <li class='list-group-item' title='Gender'><strong>$gender</strong></li>
                          <li class='list-group-item' title='Country'><strong>$country</strong></li>
                          <li class='list-group-item' title='User Registration Date'><strong>$register_date</strong></li>
                          <li class='list-group-item' title='User Registration Date'><strong><a href='followers2.php?u_d=$user_id'>Followers</a>: $nombre2</strong></li>
                          <li class='list-group-item' title='User Registration Date'><strong><a href='following2.php?u_d=$user_id'>Following</a>: $nombre1</strong></li>
                        </ul>";

            $user = $_SESSION['user_email'];
            $get_user = "SELECT * FROM users WHERE user_email='$user'";
            $run_user = mysqli_query($con, $get_user);
            $row = mysqli_fetch_array($run_user);

            $userown_id = $row['user_id'];

            if($user_id == $userown_id){
              echo "<a href='edit_profile.php?u_id=$userown_id' class='btn btn-success'>Edit Profile</a><br/><br/><br/>";
            }

            echo "  <div>
                  </center>";
          }
        ?>

        <div class="col-sm-8">
          <center><h1><strong><?php echo "$f_name $l_name" ?></strong> Posts</h1></center>
          <?php
            global $con;

            if(isset($_GET['u_id'])){
              $u_id = $_GET['u_id'];
            }

              $get_posts = "SELECT * FROM posts WHERE user_id=$u_id ORDER BY 1 DESC LIMIT 5";
              $run_posts = mysqli_query($con, $get_posts);

              while($row_posts = mysqli_fetch_array($run_posts)){
                $post_id = $row_posts['post_id'];
                $user_id = $row_posts['user_id'];
                $content = $row_posts['post_content'];
                $upload_image = $row_posts['upload_image'];
                $post_date = $row_posts['post_date'];

                $user = "SELECT * FROM users WHERE user_id=$user_id AND posts='yes'";

                $run_user = mysqli_query($con, $user);
                $row_user = mysqli_fetch_array($run_user);

                $user_name = $row_user['user_name'];
                $f_name = $row_user['f_name'];
                $l_name = $row_user['l_name'];
                $user_image = $row_user['user_image'];

                if($content == "No" && strlen($upload_image) >= 1){
                  echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
                          <img src='users/$user_image' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
                          <span class='w3-right w3-opacity'>$post_date</span>
                          <h4>$user_name</h4><br>
                          <hr class='w3-clear'>
                          <img id='post-img' src='imagepost/$upload_image' style='margin-bottom: 5px;'/>
                        </div>";
                }
                else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
                  echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
                          <img src='users/$user_image' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
                          <span class='w3-right w3-opacity'>$post_date</span>
                          <h4>$user_name</h4><br>
                          <hr class='w3-clear'>
                          <p>$content</p>
                          <img id='post-img' src='imagepost/$upload_image' style='margin-bottom: 5px;'/>
                        </div>";
                }
                else{
                  echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
                          <img src='users/$user_image' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
                          <span class='w3-right w3-opacity'>$post_date</span>
                          <h4>$user_name</h4><br>
                          <hr class='w3-clear'>
                          <p>$content</p>
                        </div>";
                }
              }
          ?>
        </div>
      </div>
    </div>
    <?php } ?>
  </body>
</html>
