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
    <title>View Your Post</title>
  </head>
  <body>
    <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px; margin-bottom: 10px;">
      <div class="col-sm-2">

      </div>
      <div class="col-sm-8">
        <center><h2>Comments</h2><br/></center>
        <?php single_post(); ?>
      </div>
      <div class="col-sm-2">

      </div>
    </div>

  </body>
</html>
