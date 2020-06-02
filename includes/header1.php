<?php
  include 'includes/connection.php';
  include 'functions/functions.php';
?>

<?php
  /*$user = $_SESSION['user_id'];
  $user_to_msg = $row_user['user_id'];
  $res_message = mysqli_query($con, "SELECT user_from, msg_body FROM user_messages WHERE status = 0 AND user_to = $user_to_msg");
  $unread_count = mysqli_num_rows($res_message);*/
?>

<!-- Navbar -->
<div class="w3-top">
  <?php
  	$user = $_SESSION['user_email'];
  	$get_user = "select * from users where user_email='$user'";
  	$run_user = mysqli_query($con,$get_user);
  	$row = mysqli_fetch_array($run_user);

  	$user_id = $row['user_id'];
  	$user_name = $row['user_name'];
  	$first_name = $row['f_name'];
  	$last_name = $row['l_name'];
  	$describe_user = $row['describe_user'];
  	$Relationship_status = $row['Relationship'];
  	$user_pass = $row['user_pass'];
  	$user_email = $row['user_email'];
  	$user_country = $row['user_country'];
  	$user_gender = $row['user_gender'];
  	$user_birthday = $row['user_birthday'];
  	$user_image = $row['user_image'];
  	$user_cover = $row['user_cover'];
  	$recovery_account = $row['recovery_account'];
  	$register_date = $row['user_reg_date'];

  	$user_posts = "select * from posts where user_id='$user_id'";
  	$run_posts = mysqli_query($con, $user_posts);
  	$posts = mysqli_num_rows($run_posts);
  ?>

  <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
    <a href="home.php" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Home</a>
    <a href='members.php?<?php echo "u_id=$user_id"?>' class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="News"><i class="fa fa-globe"></i></a>
    <a href='profile.php?<?php echo "u_id=$user_id"?>' class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Account Settings"><i class="fa fa-user"></i></a>
    <a href='messages.php?u_id=<?php echo $user_id; ?>' class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Messages"><i class="fa fa-envelope"></i></a>
    <div class="w3-dropdown-hover w3-hide-small">
      <button class="w3-button w3-padding-large" title="Notifications"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">3</span></button>
      <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
        <a href="#" class="w3-bar-item w3-button">One new friend request</a>
        <a href="#" class="w3-bar-item w3-button">John Doe posted on your wall</a>
        <a href="#" class="w3-bar-item w3-button">Jane likes your post</a>
      </div>
    </div>
    <div class="w3-dropdown-hover w3-hide-small">
      <button class="w3-button w3-padding-large" title="Notifications"><i class="fa fa-chevron-down"></i></button>
      <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
        <a href='my_post.php?u_id=<?php echo $user_id; ?>' class="w3-bar-item w3-button">My Posts<span class="w3-badge w3-right w3-small w3-green"><?php echo $posts; ?></span></a>
        <a href='edit_profile.php?u_id=<?php echo $user_id; ?>' class="w3-bar-item w3-button">Edit Account</a>
        <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
      </div>
    </div>
    <a style="text-decoration: none;" href='profile.php?<?php echo "u_id=$user_id"?>' class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
        <img id='from_image' src="users/<?php echo $user_image; ?>" class="w3-circle" style="height:30px;width:30px" alt="Avatar">
    </a>
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href='members.php?<?php echo "u_id=$user_id"?>' class="w3-bar-item w3-button w3-padding-large">News</a>
    <a href='profile.php?<?php echo "u_id=$user_id"?>' class="w3-bar-item w3-button w3-padding-large">Account Settings</a>
    <a href='messages.php?u_id=<?php echo $user_id; ?>' class="w3-bar-item w3-button w3-padding-large">Messages</a>
    <a href='my_post.php?u_id=<?php echo $user_id; ?>' class="w3-bar-item w3-button w3-padding-large">My Posts</a>
    <a href='edit_profile.php?u_id=<?php echo $user_id; ?>' class="w3-bar-item w3-button w3-padding-large">Edit Account</a>
    <a href="logout.php" class="w3-bar-item w3-button w3-padding-large">Logout</a>
  </div>
  <script type="text/javascript">
    // Used to toggle the menu on smaller screens when clicking on the menu button
    function openNav() {
      var x = document.getElementById("navDemo");
      if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
      } else {
        x.className = x.className.replace(" w3-show", "");
      }
    }

    // Accordion
    function myFunction(id) {
      var x = document.getElementById(id);
      if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
      } else {
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className =
        x.previousElementSibling.className.replace(" w3-theme-d1", "");
      }
    }
  </script>
</div>
