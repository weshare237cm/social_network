<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Signin</title>
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
        <div class="well">
          <center><h1 style="color: white;">WeShare</h1></center>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="main-content w3-card w3-round w3-white">
          <div class="header">
            <h3 style="text-align: center;"><strong>Login to WeShare</strong></h3>
          </div>
          <div class="l-part">
            <form class="" action="" method="post">
              <input type="email" name="email" placeholder="Email" required class="form-control input-md"><br/>
              <div class="overlap-text">
                <input type="password" name="pass" placeholder="Password" required class="form-control input-md"><br/>
                <a style="text-decoration: none; float: right; color: #187FAB;" data-toggle="tooltip" title="Reset Password" href="forgot_password.php">Forgot?</a>
              </div>
              <a href="signup.php" style="text-decoration: none; float: right; color: #187FAB;" data-toggle="tooltip" title="Create Account!">Don't have an account?</a><br/><br/>
              <center><button id="signin" class="btn btn-info btn-lg" name="login">Login</button></center>
              <?php include 'login.php'; ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
