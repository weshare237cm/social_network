<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>WeShare</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css"/>
    <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
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
      <div class="col-sm-12 col-lg-6">
        <div class="col-xs-12" style="left: 0.5%; margin-bottom: 5%;">
          <img src="images/wesharelogo.jpg" class="img-rounded" title="WeShare" width="100%" height="565px">
          <div id="centered1" class="centered">
            <h3 style="color: #fff;"><span class="glyphicon glyphicon-search"></span>&nbsp&nbsp<strong>Follow Your Interests.</strong></h3>
          </div>
          <div id="centered2" class="centered">
            <h3 style="color:#fff;"><span class="glyphicon glyphicon-search"></span>&nbsp&nbsp<strong>Hear what people are talking about.</strong></h3>
          </div>
          <div id="centered3" class="centered">
            <h3 style="color: #fff;"><span class="glyphicon glyphicon-search"></span>&nbsp&nbsp<strong>Join the conversation.</strong></h3>
          </div>
      </div>
      </div>
      <div class="col-sm-12 col-lg-6">
        <div class="col-xs-12" style="left: 8%;">
          <img src="images/logo.jpg" class="img-rounded" title="WeShare" width="120px" height="120px">
          <h2><strong>See what's happening in <br/> the world right now</strong></h2><br/><br/>
          <h4><strong>Join WeShare Community Today</strong></h4>
          <form class="" action="" method="post">
            <button id="signup" class="btn btn-info btn-lg" name="signup">Sign up</button><br/><br/>
            <?php
              if(isset($_POST["signup"])){
                echo "<script>window.open('signup.php', '_self')</script>";
              }
            ?>
            <button id="login" class="btn btn-info btn-lg" name="login"><i class='glyphicon glyphicon-log-in'></i> Login</button><br/><br/>
            <?php
              if(isset($_POST["login"])){
                echo "<script>window.open('signin.php', '_self')</script>";
              }
            ?>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
