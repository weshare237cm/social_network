<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Learn</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/custom.css">
    <script src="../js/jquery-1.12.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <style media="screen">
      body {
        font-family: "Comic sans MS";
        font-size: 15px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-4">
          <h3>Administrator</h3>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-8">
          <h3>Social Network Project</h3>
        </div>
      </div>
      <div class="row">
        <nav class="navbar navbar-default">
          <div class="container">
            <ul class="nav navbar-nav">
              <li class="active"><a href="index.php">Home</a></li>
            </ul>
            <ul class="nav navbar-nav pull-right">
              <li><a href="#"><?php echo "Hello: <b>" .  $_SESSION['username'] . "</b>"; ?></a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </div>
        </nav>
      </div>
