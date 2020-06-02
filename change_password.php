<!DOCTYPE html>
<?php
  session_start();
  include 'includes/connection.php';

  if(!isset($_SESSION['user_email'])){
    header("location: index.php");
  }

?>
<html lang="en" dir="ltr">
  <head>
    <title>Forgotten Password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style/style.css">
  </head>
  <body>
    <div class="row">
      <div class="col-sm-12">
        <div class="well">
          <center><h1 style="color: white;"><strong>WeShare</strong></h1></center>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="main-content">
          <div class="header">
            <h3 style="text-align: center;"><strong>Change Your Password</strong></h3><hr/>
          </div>
          <div class="l_pass">
            <form class="" action="" method="post">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input id="password" class="form-control" type="password" name="pass" placeholder="New Password" required>
              </div><br/>
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input id="password" type="password" name="pass1" class="form-control" placeholder="Re-enter New Password">
              </div><br/>
              <center><button id='signup' class="btn btn-info btn-lg" name="change">Change Password</button></center>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<?php
  if(isset($_POST['change'])){
    $user = $_SESSION['user_email'];
    $get_user = "SELECT * FROM users WHERE user_email='$user'";
    $run_user = mysqli_query($con, $get_user);
    $row = mysqli_fetch_array($run_user);

    $user_id = $row['user_id'];

    $pass = htmlentities(mysqli_real_escape_string($con, $_POST["pass"]));
    $pass1 = htmlentities(mysqli_real_escape_string($con, $_POST["pass1"]));

    if($pass == $pass1){
      if(strlen($pass) >= 9 && strlen($pass1) <= 60){
        $update = "UPDATE users SET user_pass='$pass' WHERE user_id=$user_id";

        $run = mysqli_query($con, $update);

        echo "<script>alert('Your Password is changed a moment ago')</script>";
        echo "<script>window.open('home.php', '_self')</script>";
      }
      else {
        echo "<script>alert('Your Password should be greater than 9 words')</script>";
      }
    }
    else {
      echo "<script>alert('Your Password did not match')</script>";
      echo "<script>window.open('change_password.php', '_self')</script>";
    }
  }
?>
