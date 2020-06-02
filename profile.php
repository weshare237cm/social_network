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
    <?php
      $user = $_SESSION['user_email'];
      $get_user = "SELECT * FROM users WHERE user_email = '$user'";
      $run_user = mysqli_query($con, $get_user);
      $row = mysqli_fetch_array($run_user);

      $user_name = $row['user_name'];
    ?>
    <title><?php echo "$user_name"; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/style_msg.css">
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
    <div class="row" style="margin-top: 80px;">
      <div class="col-sm-2">

      </div>
      <div class="col-sm-9">
        <?php
          echo "<div class='w3-card w3-round w3-white'>
                  <div><img id='cover-img' class='img-rounded' src='cover/$user_cover' alt='cover'/></div>
                  <form action='profile.php?u_id=$user_id' method='post' enctype='multipart/form-data'>
                    <ul class='nav pull-left' style='position: absolute; top: 10px; left: 40px;'>
                      <li class='dropdown'>
                        <button class='dropdown-toggle btn btn-default' data-toggle='dropdown'>Change Cover</button>
                        <div class='dropdown-menu'>
                          <center>
                            <p>Click <strong>Select Cover</strong> and then click the <br/> <strong>Update Cover</strong></p>
                            <label class='btn btn-info'>Select Cover
                              <input type='file' name='u_cover' size='60'/>
                            </label><br/><br/>
                            <button name='submit' class='btn btn-info'>Update Cover</button>
                          </center>
                        </div>
                      </li>
                    </ul>
                  </form>
                </div>
                <div id='profile-img'>
                  <img src='users/$user_image' alt='profile' class='img-circle' width='180px' height='185px'/>
                  <form action='profile.php?u_id=$user_id' method='post' enctype='multipart/form-data'>
                    <label id='update_profile'>Select Profile
                      <input type='file' name='u_image' size='60'/>
                    </label><br/><br/>
                    <button id='button_profile' name='update' class='btn btn-info'>Update Profile</button>
                  </form>
                </div><br/>";
        ?>
        <?php
          if(isset($_POST['submit'])){
            $u_cover = $_FILES['u_cover']['name'];
            $image_tmp = $_FILES['u_cover']['tmp_name'];
            $random_number = rand(1, 100);

            if($u_cover == ''){
              echo "<script>alert('Please Select Cover Image')</script>";
              echo "<script>window.open('profile.php?u_id=$user_id', '_self')</script>";
              exit();
            }
            else {
              move_uploaded_file($image_tmp, "cover/$u_cover.$random_number");
              $update = "UPDATE users SET user_cover = '$u_cover.$random_number' WHERE user_id=$user_id";

              $run = mysqli_query($con, $update);
              if($run){
                echo "<script>alert('Your Cover Updated')</script>";
                echo "<script>window.open('profile.php?u_id=$user_id', '_self')</script>";
                exit();
              }
            }
          }
        ?>
      </div>
      <?php
        if(isset($_POST['update'])){
          $u_image = $_FILES['u_image']['name'];
          $image_tmp = $_FILES['u_image']['tmp_name'];
          $random_number = rand(1, 100);

          if($u_image == ''){
            echo "<script>alert('Please Select Profile Image on clicking on your profile image')</script>";
            echo "<script>window.open('profile.php?u_id=$user_id', '_self')</script>";
            exit();
          }
          else {
            move_uploaded_file($image_tmp, "users/$u_image.$random_number");
            $update = "UPDATE users SET user_image = '$u_image.$random_number' WHERE user_id=$user_id";

            $run = mysqli_query($con, $update);
            if($run){
              echo "<script>alert('Your Profile Updated')</script>";
              echo "<script>window.open('profile.php?u_id=$user_id', '_self')</script>";
              exit();
            }
          }
        }
      ?>
      <div class="col-sm-2">

      </div>
    </div>
    <div class="row">
      <div class="col-sm-2">

      </div>
      <div class="col-sm-3">
        <div class="w3-card w3-round w3-white">
          <div class="w3-container">
            <?php
              $following = "SELECT * FROM followers WHERE follower_id=$user_id";
              $run1 = mysqli_query($con, $following);
              $nombre1 = mysqli_num_rows($run1);

              $follower = "SELECT * FROM followers WHERE followed_id=$user_id";
              $run2 = mysqli_query($con, $follower);
              $nombre2 = mysqli_num_rows($run2);

              echo "<h4 class='w3-center'>Informations</h4>
                    <hr>
                    <p><i class='fa fa-pencil fa-fw w3-margin-right w3-text-theme'></i> $first_name $last_name</p>
                    <p><i class='fa fa-home fa-fw w3-margin-right w3-text-theme'></i> $describe_user</p>
                    <p><i class='fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme'></i> $Relationship_status</p>
                    <p><i class='fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme'></i> $user_country</p>
                    <p><i class='fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme'></i> $register_date</p>
                    <p><i class='fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme'></i> $user_gender</p>
                    <p><i class='fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme'></i> $user_birthday</p>
                    <p><i class='fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme'></i> <a href='followers.php?u_id=$user_id'>Followers</a>: $nombre2</p>
                    <p><i class='fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme'></i> <a href='following.php?u_id=$user_id'>Following</a>: $nombre1</p>";
            ?>
          </div>
        </div>
      </div>
      <div class="col-sm-6" style="margin-top: -0.8%;">
        <!-- Display user posts -->

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
            $user_image = $row_user['user_image'];

            //now we will display the posts

            if($content == "No" && strlen($upload_image) >= 1){
              echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
                      <img src='users/$user_image' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
                      <span class='w3-right w3-opacity'>$post_date</span>
                      <h4>$user_name</h4><br>
                      <hr class='w3-clear'>
                      <img id='post-img' src='imagepost/$upload_image' style='margin-bottom: 5px;'/>
                      <a style='text-decoration: none;' href='single.php?post_id=$post_id'><button type='button' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-eye'></i>  View</button></a>
                      <a style='text-decoration: none;' href='functions/delete_post.php?post_id=$post_id'><button type='button' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-trash'></i>  Delete</button></a>
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
                      <a style='text-decoration: none;' href='single.php?post_id=$post_id'><button type='button' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-eye'></i>  View</button></a>
                      <a style='text-decoration: none;' href='functions/delete_post.php?post_id=$post_id'><button type='button' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-trash'></i>  Delete</button></a>
                    </div>";
            }
            else{
              echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
                      <img src='users/$user_image' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
                      <span class='w3-right w3-opacity'>$post_date</span>
                      <h4>$user_name</h4><br>
                      <hr class='w3-clear'>
                      <p>$content</p>
                      <a style='text-decoration: none;' href='single.php?post_id=$post_id'><button type='button' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-eye'></i>  View</button></a>
                      <a style='text-decoration: none;' href='edit_post.php?post_id=$post_id'><button type='button' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-edit'></i>  Edit</button></a>
                      <a style='text-decoration: none;' href='functions/delete_post.php?post_id=$post_id'><button type='button' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-trash'></i>  Delete</button></a>
                    </div>";


              include 'functions/delete_post.php';
            }
          }
        ?>
      </div>
      <div class="col-sm-2">

      </div>
    </div><br/>
    <?php include 'includes/footer.php'; ?>
  </body>
</html>
