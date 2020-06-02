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
    <title>Edit Post</title>
  </head>
  <body>
    <div class="w3-container w3-content" style="max-width:1600px;margin-top:80px">
      <div class="col-sm-3">

      </div>
      <div class="w3-col m7">
        <?php
          if(isset($_GET['post_id'])){
            $get_id = $_GET['post_id'];

            $get_post = "SELECT * FROM posts WHERE post_id=$get_id";
            $run_post = mysqli_query($con, $get_post);
            $row = mysqli_fetch_array($run_post);

            $post_con = $row['post_content'];
          }
        ?>
        <h1><center>Edit Your Post</center></h3><br/><br/>
        <div class="w3-row-padding">
          <div class="w3-col m12">
            <div class="w3-card w3-round w3-white">
              <div class="w3-container w3-padding">
                <h6 class="w3-opacity">Edit Your Post</h6>
                <form id="f" action="" method="post">
                  <textarea style="width: 100%; resize: none;" name="content" class="form-control" rows="4"> <?php echo $post_con; ?></textarea><br/>
                  <button type="submit" class="w3-button w3-theme" name="update"><i class="fa fa-edit"></i>  Edit</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <?php
          if(isset($_POST['update'])){
            $content = $_POST['content'];

            $update_post = "UPDATE posts SET post_content='$content' WHERE post_id=$get_id";
            $run_update = mysqli_query($con, $update_post);

            if($run_update){
              echo "<script>alert('A Post have been Updated!')</script>";
              echo "<script>window.open('home.php', '_self')</script>";
            }
          }
        ?>
      </div>
      <div class="col-sm-3">

      </div>
    </div>
  </body>
</html>
