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
    <?php
      $user = $_SESSION['user_email'];
      $get_user = "SELECT * FROM users WHERE user_email = '$user'";
      $run_user = mysqli_query($con, $get_user);
      $row = mysqli_fetch_array($run_user);
      $f_name = $row['f_name'];
      $l_name = $row['l_name'];
      $user_name = $row['user_name'];
      $Relationship_status = $row['Relationship'];
    ?>
    <title><?php echo "$user_name"; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style/w3.css">
    <link rel="stylesheet" href="style/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/home_style2.css">
    <link rel="stylesheet" href="style/style.css">
    <style media="screen">
      html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
    </style>
  </head>
  <body class="w3-theme-15" onload="typeWriter();">
    <!-- Page Container -->
    <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
      <!-- The Grid -->
      <div class="w3-row">
        <!-- Left Column -->
        <div class="w3-col m3">
          <!-- Profile -->
          <div class="w3-card w3-round w3-white">
            <div class="w3-container">
              <h4 class="w3-center">My Profile</h4>
              <p class="w3-center"><img src='users/<?php echo $user_image; ?>' class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
              <hr>
              <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> <?php echo $Relationship_status; ?></p>
              <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> <?php echo $user_country; ?></p>
              <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> <?php echo $user_birthday; ?></p>
            </div>
          </div>

          <!-- Accordion -->
          <div class="w3-card w3-round">
            <div class="w3-white">
              <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Groups</button>
              <div id="Demo1" class="w3-hide w3-container">
                <p>Some text..</p>
              </div>
              <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> My Events</button>
              <div id="Demo2" class="w3-hide w3-container">
                <p>Some other text..</p>
              </div>
              <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> My Photos</button>
              <div id="Demo3" class="w3-hide w3-container">
             <div class="w3-row-padding">
             <br>
               <div class="w3-half">
                 <img src="/w3images/lights.jpg" style="width:100%" class="w3-margin-bottom">
               </div>
               <div class="w3-half">
                 <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
               </div>
               <div class="w3-half">
                 <img src="/w3images/mountains.jpg" style="width:100%" class="w3-margin-bottom">
               </div>
               <div class="w3-half">
                 <img src="/w3images/forest.jpg" style="width:100%" class="w3-margin-bottom">
               </div>
               <div class="w3-half">
                 <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
               </div>
               <div class="w3-half">
                 <img src="/w3images/snow.jpg" style="width:100%" class="w3-margin-bottom">
               </div>
             </div>
              </div>
            </div>
          </div>
          <br>

          <!-- Interests -->
          <div class="w3-card w3-round w3-white w3-hide-small">
            <div class="w3-container">
              <p>Interests</p>
              <p>
                <span class="w3-tag w3-small w3-theme-d5">News</span>
                <span class="w3-tag w3-small w3-theme-d4">W3Schools</span>
                <span class="w3-tag w3-small w3-theme-d3">Labels</span>
                <span class="w3-tag w3-small w3-theme-d2">Games</span>
                <span class="w3-tag w3-small w3-theme-d1">Friends</span>
                <span class="w3-tag w3-small w3-theme">Games</span>
                <span class="w3-tag w3-small w3-theme-l1">Friends</span>
                <span class="w3-tag w3-small w3-theme-l2">Food</span>
                <span class="w3-tag w3-small w3-theme-l3">Design</span>
                <span class="w3-tag w3-small w3-theme-l4">Art</span>
                <span class="w3-tag w3-small w3-theme-l5">Photos</span>
              </p>
            </div>
          </div>
          <br>

          <!-- Alert Box -->
          <div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
            <span onclick="this.parentElement.style.display='none'" class="w3-button w3-theme-l3 w3-display-topright">
              <i class="fa fa-remove"></i>
            </span>
            <p><strong>Hey!</strong></p>
            <p>People are looking at your profile. Find out who.</p>
          </div>

        </div>
        <!-- Middle Column -->
        <div class="w3-col m7">

          <div class="w3-row-padding">
            <div class="w3-col m12">
              <div class="w3-card w3-round w3-white">
                <div class="w3-container w3-padding">
                  <h6 class="w3-opacity">WeShare</h6>
                  <div id="player"></div>
                  <form id="f" enctype="multipart/form-data" action="home.php?id=<?php echo $user_id; ?>" method="post">
                    <textarea  style="width: 100%; resize: none;" name="content" class="form-control" id="content" rows="4" placeholder="<?php echo $first_name; ?> What's in your mind?"></textarea><br/>
                    <button id="btn-post" class="w3-button w3-theme" name="sub"><i class="fa fa-pencil"></i>  Post</button>
                    <input type="hidden" value="<?php echo $f_name . ' ' . $l_name; ?>" id='myName'/>
                    <label class="btn btn-warning">Select Image
                      <input type="file" name="upload_image" size="30">
                    </label>
                    <input type="button" class="w3-button w3-theme" name="submit" value="Speech" onclick="getAudio()">
                  </form>
                  <?php insertPost(); ?>
                </div>
              </div>
            </div>
          </div>
          <?php echo get_posts(); ?>
        </div>
        <!-- Right Column -->
        <div class="w3-col m2">
          <div class="w3-card w3-round w3-white w3-center">
            <div class="w3-container">
              <img src="images/logo.jpg" alt="Forest" style="width:100%;">
            </div>
          </div>
          <br>

          <div class="w3-card w3-round w3-white w3-padding-16 w3-center">
            <p>ADS</p>
          </div>
          <br>

          <div class="w3-card w3-round w3-white w3-padding-32 w3-center">
            <p><i class="fa fa-bug w3-xxlarge"></i></p>
          </div>

        <!-- End Right Column -->
        </div>
      </div>
    </div><br/>

    <script>
        $(document).ready(function(){
          $(".myBtn").click(function(){
            $(this).prev().toggle();
            $(this).siblings(".dots").toggle();

            if($(this).text() == "Read More"){
              $(this).text("Read Less");
            }
            else {
              $(this).text("Read More");
            }
          });
        });

        var i = 0;
        var speed = 50;
        var name = document.getElementById("myName").value;
        var txt = name + " Welcome To WeShare Community. To Follow People Click On The Button Below";

        function typeWriter(){
          if(i < txt.length){
            document.getElementById("demo").innerHTML += txt.charAt(i);
            i++;
            setTimeout(typeWriter, speed);
          }
        }

        /*var btnsContainer = document.getElementById("pagination");
        var btns = btnsContainer.getElementsByClassName("w3-button");

        for(var i = 0; i < btns.length; i++){
          btns[i].addEventListener("click", function(){
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
          });
        }*/
        var already = false;

        function like_update(id){
            if(already == false){
              var cur_count = $("#like_loop_"+id).html();
              cur_count++;
              $("#like_loop_"+id).html(cur_count);
              already = true;
            }
            else {
              var cur_count = $("#like_loop_"+id).html();
              cur_count--;
              already = false;
              $("#like_loop_"+id).html(cur_count);
            }
            $.ajax({
              url:'update_count.php',
              type:'post',
              data:'type=like&id='+id + '&current_count='+cur_count,
              success:function(result){

              }
            });
        }


        function dislike_update(id){
          $.ajax({
            url:'update_count.php',
            type:'post',
            data:'type=dislike&id='+id,
            success:function(result){
              var cur_count = $("#dislike_loop_"+id).html();
              cur_count++;
              $("#dislike_loop_"+id).html(cur_count);
            }
          });
        }

        function getAudio(){
        	var txt=jQuery('#content').val()
        	jQuery.ajax({
        		url:'get.php',
        		type:'post',
        		data:'txt='+txt,
        		success:function(result){
        			jQuery('#player').html(result);
        		}
        	});
        }
    </script>
    <?php include 'includes/footer.php'; ?>
  </body>
</html>
