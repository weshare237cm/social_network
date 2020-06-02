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
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/home_style2.css">
    <link rel="stylesheet" href="style/style.css">
    <script type="text/javascript" src="bootstrap/js/w3.js"> </script>

  </head>
  <body>
    <div class="w3-container w3-content" style="max-width:1000px;margin-top:80px">
      <div class="col-sm-12">
        <center><h2>Find New People</h2><br/></center>
        <div class="row">
          <div class="col-sm-4">

          </div>
          <div class="col-sm-4">
            <form class="search_form" action="">
              <input type="text" name="search_user" placeholder="Search Friend" oninput="w3.filterHTML('#search_user', '.item', this.value)">
            </form>
          </div>
          <div class="col-sm-4">

          </div>
        </div><br/><br/>
        <div id="search_user">
        <?php
        $u_id = $_GET['u_id'];
        
          $get_user = "SELECT * FROM `users` WHERE user_id IN (SELECT follower_id FROM followers WHERE followed_id = $user_id) AND user_id != $user_id";
          $run_user = mysqli_query($con, $get_user);
          while($row_user = mysqli_fetch_array($run_user)){
            $user_id = $row_user['user_id'];
            $f_name = $row_user['f_name'];
            $l_name = $row_user['l_name'];
            $username = $row_user['user_name'];
            $user_image = $row_user['user_image'];

            echo "

                    <div class='w3-container w3-card w3-white w3-round w3-margin' style='padding: 10px;'>
                      <div class='row'>
                        <div class='col-sm-4'>

                          <a href='user_profile.php?u_id=$user_id'><img src='users/$user_image' width='150px' height='140px' title='$username' style='border-radius: 50%; float: left; margin: 1px;'/></a>
                        </div><br/><br/>
                        <div class='col-sm-6'>
                          <a href='user_profile.php?u_id=$user_id' style='text-decoration: none; cursor: pointer; color: #3897f0;'>
                            <strong><h2>$f_name $l_name</h2></strong>
                          </a>
                        </div>
                        <div class='col-sm-3'>
                        </div>
                      </div>
                    </div>
                    <br/>";
          }


        ?>
      </div>
      </div>
    </div>
  </body>
</html>
