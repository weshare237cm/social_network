<!DOCTYPE html>
<?php
  session_start();
  include 'includes/header1.php';

  if(!isset($_SESSION['user_email'])){
    header("location: index.php");
  }

  error_reporting(0);
?>



<!DOCTYPE html>
<html>
	<head>
		<title>Chat</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style/w3.css">
    <script type="text/javascript" src="js/w3.js"></script>
    <link rel="stylesheet" href="style/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
    <link rel="stylesheet" href="style/style_msg.css">
	</head>
	<!--Coded With Love By Demo Fkd-->
	<body>
		<div class="container-fluid h-100" style="margin-top:50px">
			<div class="row justify-content-center h-100">
				<div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
					<div class="card-header">
						<div class="input-group">
							<input type="text" oninput="w3.filterHTML('#myUsers', '.active', this.value)" placeholder="Search..." name="" class="form-control search">
							<div class="input-group-prepend">
								<span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
							</div>
						</div>
					</div>
          <?php
            if(isset($_GET['u_id'])){
                global $con;

                $get_id = $_GET['u_id'];

                $get_user = "SELECT * FROM users WHERE user_id='$get_id'";
                $run_user = mysqli_query($con, $get_user);
                $row_user = mysqli_fetch_array($run_user);

                $user_to_msg = $row_user['user_id'];
                $user_to_name = $row_user['user_name'];
                $user_to_image = $row_user['user_image'];
              }

              $user = $_SESSION['user_email'];
              $get_user = "SELECT * FROM users WHERE user_email='$user'";
              $run_user = mysqli_query($con, $get_user);
              $row = mysqli_fetch_array($run_user);

              $user_from_msg = $row['user_id'];
              $user_from_name = $row['user_name'];
              $user_from_image = $row['user_image'];
            ?>
					<div class="card-body contacts_body" id='myUsers'>
            	<ui class="contacts">
            <?php
              $user = "SELECT * FROM users WHERE user_id != $user_from_msg";

              $run_user = mysqli_query($con, $user);
              while($row_user = mysqli_fetch_array($run_user)){
                $user_id = $row_user['user_id'];
                $user_name = $row_user['user_name'];
                $first_name = $row_user['f_name'];
                $last_name = $row_user['l_name'];
                $user_image = $row_user['user_image'];

  						echo "<li class='active'>
        							<div class='d-flex bd-highlight'>
        								<div class='img_cont'>
        									<a href='messages.php?u_id=$user_id' style='text-decoration: none; cursor: pointer;'><img src='users/$user_image' class='rounded-circle user_img'></a>
        									<span class='online_icon'></span>
        								</div>
        								<div class='user_info'>
        									<span>$first_name $last_name</span>
        									<p class='demo'></p>
        								</div>
        							</div>
        						</li>";
            }?>
						</ui>
					</div>
					<div class="card-footer"></div>
				</div></div>
				<div class="col-md-8 col-xl-6 chat">
					<div class="card">
            <?php
                $sql = "SELECT f_name, l_name FROM users WHERE user_id = $user_to_msg";
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($result);
                $user_to_f_name = $row['f_name'];
                $user_to_l_name = $row['l_name'];
                $sql1 = "SELECT * FROM user_messages WHERE user_from = $user_from_msg AND user_to = $user_to_msg";
                $run1 = mysqli_query($con, $sql1);
                $number_messages = mysqli_num_rows($run1);
                if($_GET['u_id'] != $user_from_msg){

    				echo "<div class='card-header msg_head'>
    							<div class='d-flex bd-highlight'>
    								<div class='img_cont'>
    									<img src='users/$user_to_image' id='to-image' class='rounded-circle user_img'>
    									<span class='online_icon'></span>
    								</div>
    								<div class='user_info'>
    									<span>Chat With $user_to_f_name $user_to_l_name</span>
    									<p>$number_messages Messages</p>
    								</div>
    								<div class='video_cam'>
    									<span><i class='fas fa-video'></i></span>
    									<span><i class='fas fa-phone'></i></span>
    								</div>
    							</div>
    							<span id='action_menu_btn'><i class='fas fa-ellipsis-v'></i></span>
    							<div class='action_menu'>
    								<ul>
    									<li><a href='profile.php?u_id=$user_to_msg'><i class='fas fa-user-circle'></i> View profile</a></li>
    								</ul>
    							</div>

    						</div>";
              }
              else {
                echo "<div class='card-header msg_head'>
                          <h3 style='color: #fff; font-weight: normal;'>Select a Friend to chat with</h3>
                      </div>";
              }
            ?>

						<div class="card-body msg_card_body" id="scroll_messages">
              <?php
                $sel_msg = "SELECT * FROM user_messages WHERE (user_to='$user_to_msg' AND user_from='$user_from_msg') OR (user_from='$user_to_msg' AND user_to='$user_from_msg') ORDER BY 1 ASC";

                $run_msg = mysqli_query($con, $sel_msg);

                while($row_msg = mysqli_fetch_array($run_msg)){
                  $user_to = $row_msg['user_to'];
                  $user_from = $row_msg['user_from'];
                  $msg_body = $row_msg['msg_body'];
                  $msg_date = $row_msg['date'];

                if($user_to == $user_to_msg AND $user_from == $user_from_msg){
    							echo "<div class='d-flex justify-content-start mb-4'>
          								<div class='img_cont_msg'>
          									<img src='users/$user_from_image' class='rounded-circle user_img_msg'>
          								</div>
          								<div class='msg_cotainer'>
          									$msg_body
          								</div>
          							</div>";
                }
                 else if($user_from == $user_to_msg AND $user_to == $user_from_msg){
      							echo "<div class='d-flex justify-content-end mb-4'>
            								<div class='msg_cotainer_send'>
            								  $msg_body
            								</div>
            								<div class='img_cont_msg'>
            							    <img src='users/$user_to_image' class='rounded-circle user_img_msg'>
            							 </div>
  							          </div>";
                  }
                }
                ?>
						</div>
						<div class="card-footer">
              <?php
               if(isset($_GET['u_id'])){
                 $u_id = $_GET['u_id'];

                 if($u_id == $user_from_msg){
                   echo "<form id='myForm' action='' method='post'>
                            <div class='input-group'>
                              <input type='hidden' value='$user_to_msg' name='user1' id='hide2'>
                              <input type='hidden' value='$user_from_msg' id='hide1' name='user2'>
               								<textarea disabled name='msg_box' class='form-control type_msg' id='myMsg' placeholder='Type your message...''></textarea>
               								<div class='input-group-append'>
               									<button disabled name='send_msg' style='background: #3f5267; border: none;'><span class='input-group-text send_btn'><i class='fas fa-location-arrow'></i></span></button>
               								</div>
               							</div>
                          </form>";
                 }
                 else {
                   echo "<form id='myForm' action='' method='post'>
                            <div class='input-group'>
               								<div class='input-group-append'>
               									<span class='input-group-text attach_btn'><i class='fas fa-paperclip'></i></span>
               								</div>
                              <input type='hidden' value='$user_to_msg' name='user1' id='hide2'>
                              <input type='hidden' value='$user_from_msg' id='hide1' name='user2'>
               								<textarea name='msg_box' class='form-control type_msg' id='myMsg' placeholder='Type your message...''></textarea>
               								<div class='input-group-append'>
               									<button name='send_msg' style='background: #3f5267; border: none;'><span class='input-group-text send_btn'><i class='fas fa-location-arrow'></i></span></button>
               								</div>
               							</div>
                          </form>";
                 }
               }
              ?>
						</div>
					</div>
				</div>
			</div>
		</div>
    <script src='script_ajax.js'></script>
    <script type="text/javascript">
     var div = document.getElementById("scroll_messages");
     div.scrollTop = div.scrollHeight;
   </script>
   <script type="text/javascript">
     $(document).ready(function(){
       $('#action_menu_btn').click(function(){
         $('.action_menu').toggle();
       });
     });
   </script>
	</body>
</html>
