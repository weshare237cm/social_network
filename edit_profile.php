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
    <title>Edit Account Settings</title>
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
  </head>
  <body>
    <div class="w3-container w3-content" style="max-width:1600px;margin-top:80px">
      <div class="col-sm-2">

      </div>
      <div class="col-sm-8">
        <form class="" action="" method="post" enctype="multipart/form-data">
          <table class="table table-bordered table-hover">
            <tr align="center">
              <td colspan="6" class="active"><h2>Edit Your Profile</h2></td>
            </tr>
            <tr>
              <td style="font-weight: bold;">Change Your First Name</td>
              <td>
                <input class="form-control" type="text" name="f_name" required value="<?php echo $first_name; ?>">
              </td>
            </tr>
            <tr>
              <td style="font-weight: bold;">Change Your Last Name</td>
              <td>
                <input class="form-control" type="text" name="l_name" required value="<?php echo $last_name; ?>">
              </td>
            </tr>
            <tr>
              <td style="font-weight: bold;">Change Your Username</td>
              <td>
                <input class="form-control" type="text" name="u_name" required value="<?php echo $user_name; ?>">
              </td>
            </tr>
            <tr>
              <td style="font-weight: bold;">Description</td>
              <td>
                <input class="form-control" type="text" name="describe_user" required value="<?php echo $describe_user; ?>">
              </td>
            </tr>
            <tr>
              <td style="font-weight: bold;">Relationship Status</td>
              <td>
                <select class="form-control" name="Relationship">
                  <option><?php echo $Relationship_status; ?></option>
                  <option>Engaged</option>
                  <option>Married</option>
                  <option>Single</option>
                  <option>In an Relationship</option>
                  <option>It's Complicated</option>
                  <option>Separated</option>
                  <option>Divorced</option>
                  <option>Widowed</option>
                </select>
              </td>
            </tr>
            <tr>
              <td style="font-weight: bold;">Password</td>
              <td>
                <input class="form-control" type="password" name="u_pass" id="mypass" value="<?php echo $user_pass; ?>" required>
                <input type="checkbox" onclick="show_password()"><strong> Show Password</strong>
              </td>
            </tr>
            <tr>
              <td style="font-weight: bold;">Email</td>
              <td>
                <input class="form-control" type="email" name="u_email" required value="<?php echo $user_email; ?>">
              </td>
            </tr>
            <tr>
              <td style="font-weight: bold;">Country</td>
              <td>
                <select class="form-control" name="u_country">
                  <option><?php echo $user_country; ?></option>
                  <option>Cameroun</option>
                  <option>India</option>
                  <option>Japan</option>
                  <option>Rwanda</option>
                  <option>Angola</option>
                </select>
              </td>
            </tr>
            <tr>
              <td style="font-weight: bold;">Gender</td>
              <td>
                <select class="form-control" name="u_gender">
                  <option><?php echo $user_gender; ?></option>
                  <option>Male</option>
                  <option>Female</option>
                  <option>Other</option>
                </select>
              </td>
            </tr>
            <tr>
              <td style="font-weight: bold;">Birth Date</td>
              <td>
                <input class="form-control input-md" type="date" name="u_birthday" required value="<?php echo $user_birthday; ?>">
              </td>
            </tr>

            <!-- recovery password option -->
            <tr>
              <td style="font-weight: bold;">Forgotten Password</td>
              <td>
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Turn On</button>
                <div id="myModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal Header</h4>
                      </div>
                      <div class="modal-body">
                        <form class="" action="recovery.php?id=<?php echo $user_id; ?>" method="post" id="f">
                          <strong>What is your School Best Friend Name?</strong>
                          <textarea class="form-control" name="content" placeholder="Someone" rows="4" cols="83"></textarea><br/>
                          <input class="btn btn-default" type="submit" name="sub" value="Submit" style="width: 100px;"><br/><br/>
                          <pre>Answer the above question we will ask this if you forgot your <br/>password.</pre><br/><br/>
                        </form>
                        <?php
                          if(isset($_POST['sub'])){
                            $bfn = htmlentities($_POST['content']);

                            if($bfn == ''){
                              echo "<script>alert('Please enter something')</script>";
                              echo "<script>window.open('edit_profile.php?u_id=$user_id', '_self')</script>";
                              exit();
                            }
                            else {
                              $update = "UPDATE users SET recovery_account='$bfn' WHERE user_id=$user_id";
                              $run = mysqli_query($con, $update);

                              if($run){
                                echo "<script>alert('Working...')</script>";
                                echo "<script>window.open('edit_profile.php?u_id=$user_id', '_self')</script>";
                              }
                              else {
                                echo "<script>alert('Error while Updating information')</script>";
                                echo "<script>window.open('edit_profile.php?u_id=$user_id', '_self')</script>";
                              }
                            }
                          }
                        ?>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <tr align="center">
              <td colspan="6">
                <input class="btn btn-info" type="submit" name="update" style="width: 250px;" value="Update">
              </td>
            </tr>
          </table>
        </form>
      </div>
      <div class="col-sm-2">
      </div>
    </div>
    <script type="text/javascript">
      function show_password(){
        var x = document.getElementById('mypass');

        if(x.type === "password"){
          x.type = "text";
        }
        else{
          x.type = "password";
        }
      }
    </script>
  </body>
</html>
<?php
  if(isset($_POST['update'])){
    $f_name = htmlentities($_POST['f_name']);
    $l_name = htmlentities($_POST['l_name']);
    $u_name = htmlentities($_POST['u_name']);
    $describe_user = htmlentities($_POST['describe_user']);
    $Relationship_status = htmlentities($_POST['Relationship']);
    $u_pass = htmlentities($_POST['u_pass']);
    $u_email = htmlentities($_POST['u_email']);
    $u_country = htmlentities($_POST['u_country']);
    $u_gender = htmlentities($_POST['u_gender']);
    $user_birthday = htmlentities($_POST['u_birthday']);

    $update = "UPDATE users SET f_name='$f_name', l_name='$l_name', user_name='$u_name', describe_user='$describe_user',
              Relationship='$Relationship_status', user_pass='$u_pass', user_email='$u_email', user_country='$u_country',
              user_gender='$u_gender', user_birthday='$user_birthday' WHERE user_id=$user_id";

    $run = mysqli_query($con, $update);

    if($run){
      echo "<script>alert('Your Profile Updated')</script>";
      echo "<script>window.open('edit_profile.php?u_id=$user_id', '_self')</script>";
    }
  }
?>
