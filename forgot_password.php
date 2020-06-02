<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Forgotten Password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style/w3.css">
    <link rel="stylesheet" href="style/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/style.css">
  </head>
  <body>
    <div class="row">
      <div class="col-sm-12">
        <div class="well w3-bar w3-theme-d2 w3-large">
          <center><h1 style="color: white;"><strong>WeShare</strong></h1></center>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="main-content w3-card w3-round w3-white">
          <div class="header">
            <h3 style="text-align: center;"><strong>Forgot Password</strong></h3><hr/>
          </div>
          <div class="l_pass">
            <form class="" action="" method="post">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="email" class="form-control" type="email" name="email" placeholder="Enter your Email" required>
              </div><br/>
              <hr>
              <pre class="text">Enter your Best Friend name down below?</pre>
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                <input id="msg" type="text" name="recovery_account" class="form-control" placeholder="Someone">
              </div><br/>
              <a href="signin.php" style="text-decoration: none; float: right; color: #187FAB;" data-toggle="tooltip">Back to Signin?</a><br/><br/>
              <center><button id='signup' class="w3-button w3-theme" name="submit">Submit</button></center>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<?php
  session_start();
  include 'includes/connection.php';

  if(isset($_POST['submit'])){
    $email = htmlentities(mysqli_real_escape_string($con, $_POST["email"]));
    $recovery_account = htmlentities(mysqli_real_escape_string($con, $_POST['recovery_account']));

    $select_user = "SELECT * FROM users WHERE user_email = '$email' AND recovery_account='$recovery_account'";
    $query = mysqli_query($con, $select_user);
    $check_user = mysqli_num_rows($query);

    if($check_user == 1){
      $_SESSION['user_email'] = $email;
      echo "<script>window.open('change_password.php', '_self')</script>";
    }
    else{
      echo "<script>alert('Your Email or Best Friend is incorrect')</script>";
    }
  }
?>
