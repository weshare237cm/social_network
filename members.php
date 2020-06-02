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
    <script type="text/javascript" src='js/w3.js'></script>
    <link rel="stylesheet" href="style/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/home_style2.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style_msg.css">

    <script type="text/javascript" src="bootstrap/js/w3.js"> </script>
    <style>
    .follow {
      text-decoration: none;
      background-color: rgba(0, 255, 0, 0.8);
      color: white;
      padding: 10px;
      border-radius: 5px;
    }

    .follow:hover {
      color: #ddd;
    }

    .searchbar{
   margin-bottom: auto;
   margin-top: auto;
   height: 60px;
   background-color: #353b48;
   border-radius: 30px;
   padding: 10px;
   }

   .search_input{
   color: white;
   border: 0;
   outline: 0;
   background: none;
   width: 0;
   caret-color:transparent;
   line-height: 40px;
   transition: width 0.4s linear;
   }

   .searchbar:hover > .search_input{
   padding: 0 10px;
   width: 450px;
   caret-color:red;
   transition: width 0.4s linear;
   }

   .searchbar:hover > .search_icon{
   background: white;
   color: #e74c3c;
   }

   .search_icon{
   height: 40px;
   width: 40px;
   float: right;
   display: flex;
   justify-content: center;
   align-items: center;
   border-radius: 50%;
   color:white;
   text-decoration:none;
   }

    </style>
  </head>
  <body>
    <div class="w3-container w3-content" style="max-width:1000px;margin-top:80px">
      <div class="col-sm-12">
        <center><h2>Find New People</h2><br/></center>
        <div class="row">
          <div class="col-sm-4">

          </div>
          <div class="container h-100">
            <div class="d-flex justify-content-center h-100">
              <div class="searchbar">
                <input class="search_input" oninput="w3.filterHTML('#search_user', '.row', this.value)" type="text" name="" placeholder="Search...">
                <span class="search_icon"><i class="fas fa-search"></i></span>
              </div>
            </div>
          </div>
          <div class="col-sm-4">

          </div>
        </div><br/><br/>
        <div id="search_user">
          <?php
            $u_id = $_GET['u_id'];
            $sql = "SELECT * FROM followers WHERE follower_id = $u_id";
            $run = mysqli_query($con, $sql);
            if(mysqli_num_rows($run) != 0){
              $get_user = "SELECT * FROM users WHERE user_id IN (SELECT followed_id FROM followers WHERE follower_id = $u_id) AND user_id != $u_id";
              $run_user = mysqli_query($con, $get_user);
              while($row_user = mysqli_fetch_array($run_user)){
                $user_id = $row_user['user_id'];
                $f_name = $row_user['f_name'];
                $l_name = $row_user['l_name'];
                $username = $row_user['user_name'];
                $user_image = $row_user['user_image'];

                echo " <div class='row'>
                         <div class='col-sm-3' class='item'>
                           <div class='w3-card w3-round w3-white w3-center' style='border-radius: 12px; padding: 5px;'>
                            <img style='display: block; margin: auto;' height='100px' width='100px' src='users/$user_image' class='img-circle' height='55' width='55' alt='Avatar'>
                           </div><br/>
                         </div>
                         <div class='col-sm-9' style='border-radius: 12px;' class='item'>
                           <div class='well'>
                             <p style='color: #fff'><h4><a style='text-decoration: none; cursor: pointer; color: white;' href='user_profile.php?u_id=$user_id'>$f_name $l_name</a></h4> <a class='follow' style='float: right;' href='members.php?u_id=$u_id&follower_id=$user_id'>Unfollow</a></p>
                           </div>
                         </div>
                       </div>";
              }
            }


            $get_user = "SELECT * FROM users WHERE user_id NOT IN (SELECT followed_id FROM followers WHERE follower_id = $u_id) AND user_id != $u_id";
            $run_user = mysqli_query($con, $get_user);
            while($row_user = mysqli_fetch_array($run_user)){
              $user_id = $row_user['user_id'];
              $f_name = $row_user['f_name'];
              $l_name = $row_user['l_name'];
              $username = $row_user['user_name'];
              $user_image = $row_user['user_image'];

              echo "<div class='row'>
                     <div class='col-sm-3'>
                       <div class='w3-card w3-round w3-white w3-center' style='border-radius: 12px; padding: 5px;'>
                        <img style='display: block; margin: auto;' height='100px' width='100px' src='users/$user_image' class='img-circle' height='55' width='55' alt='Avatar'>
                       </div><br/>
                     </div>
                     <div class='col-sm-9' style='border-radius: 12px;'>
                       <div class='well'>
                         <p style='color: #fff'><h4><a style='text-decoration: none; cursor: pointer; color: white;' href='user_profile.php?u_id=$user_id'>$f_name $l_name</a></h4> <a class='follow' style='float: right;' href='members.php?u_id=$u_id&followed_id=$user_id'>Follow</a></p>
                       </div>
                     </div>
                   </div>";
            }
            if(isset($_GET['followed_id'])){
              $followed_id = $_GET['followed_id'];
              $query = "SELECT * FROM followers WHERE followed_id=$followed_id AND follower_id=$u_id";
              $run_query = mysqli_query($con, $query);
              $total_rows = mysqli_num_rows($run_query);
              if($total_rows == 0){
                $sql = "INSERT INTO followers (follower_id, followed_id) VALUES ($u_id, $followed_id)";
                $run = mysqli_query($con, $sql);
              }
            }

            if(isset($_GET['follower_id'])){
              $follower_id = $_GET['follower_id'];
              $query1 = "DELETE FROM followers WHERE follower_id = $u_id AND followed_id = $follower_id";
              $run1 = mysqli_query($con, $query1);
            }

          ?>
      </div>
      </div>
    </div>
  </body>
</html>
