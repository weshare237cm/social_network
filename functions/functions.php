<?php
  include 'includes/connection.php';

  //function for inserting post
  function insertPost(){
      if(isset($_POST['sub'])){
        global $con;
        global $user_id;

        $content = htmlentities($_POST['content']);
        $upload_image = $_FILES['upload_image']['name'];
        $image_tmp = $_FILES['upload_image']['tmp_name'];
        $random_number = rand(1, 100);

        if(strlen($content) > 1000){
          echo "<script>alert('Please Use 1000 or less than 1000 words!')</script>";
          echo "<script>window.open('home.php', '_self')</script>";
        }
        else {
          if(strlen($upload_image) >= 1 && strlen($content) >= 1){
            move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
            $insert = "INSERT INTO posts(user_id, post_content, upload_image, post_date) VALUES($user_id, '$content', '$upload_image.$random_number', NOW())";
            $run = mysqli_query($con, $insert);

            if($run){
              echo "<script>alert('Your Post updated a moment ago')</script>";
              echo "<script>window.open('home.php', '_self')</script>";

              $update = "UPDATE users SET posts='yes' WHERE user_id=$user_id";
              $run_update = mysqli_query($con, $update);
            }
            exit();
          }
          else {
            if($content == '' && $upload_image == ''){
              echo "<script>alert('Erro Occured while uploading!')</script>";
              echo "<script>window.open('home.php', '_self')</script>";
            }
            else {
              if($content == ''){
                move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
                $insert = "INSERT INTO posts(user_id, post_content, upload_image, post_date) VALUES($user_id, 'No', '$upload_image.$random_number', NOW())";
                $run = mysqli_query($con, $insert);
                if($run){
                  echo "<script>alert('Your Post updated a moment ago')</script>";
                  echo "<script>window.open('home.php', '_self')</script>";

                  $update = "UPDATE users SET posts='yes' WHERE user_id=$user_id";
                  $run_update = mysqli_query($con, $update);
                }
                exit();
              }
              else {
                $insert = "INSERT INTO posts(user_id, post_content, post_date) VALUES($user_id, '$content', NOW())";
                $run = mysqli_query($con, $insert);
                if($run){
                  echo "<script>alert('Your Post updated a moment ago')</script>";
                  echo "<script>window.open('home.php', '_self')</script>";

                  $update = "UPDATE users SET posts='yes' WHERE user_id=$user_id";
                  $run_update = mysqli_query($con, $update);
                }
              }
            }
          }
        }
      }
  }

  function get_posts(){
    global $con;
    $per_page = 4;

    if(isset($_GET['page'])){
      $page = $_GET['page'];
    }
    else {
      $page = 1;
    }
    $start_from = ($page - 1) * $per_page;
    $user_id = $_SESSION['user_id'];
    $get_followers = "SELECT * FROM followers WHERE follower_id=$user_id";
    $run_followers = mysqli_query($con, $get_followers);
    $date = date('Y');
    if(mysqli_num_rows($run_followers) == 0){
      echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
              <img src='users/head_turquoise.jpg' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
              <span class='w3-right w3-opacity'>$date</span>
              <h4>WeShare</h4><br>
              <hr class='w3-clear'>
              <p id='demo'></p>
              <a style='text-decoration: none;' href='members.php?u_id=$user_id'><button type='button' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-share'></i> Follow People</button></a>
            </div>";

            $get_posts = "SELECT * FROM posts WHERE user_id = $user_id ORDER BY 1 DESC LIMIT $start_from, $per_page";
            $run_posts = mysqli_query($con, $get_posts);

            while($row_posts = mysqli_fetch_array($run_posts)){
              $post_id = $row_posts['post_id'];
              $user_id = $row_posts['user_id'];
              $content = $row_posts['post_content'];
              $like_count = $row_posts['like_count'];
              $dislike_count = $row_posts['dislike_count'];

              $upload_image = $row_posts['upload_image'];
              $post_date = $row_posts['post_date'];

              $user = "SELECT * FROM users WHERE user_id=$user_id AND posts='yes'";
              $run_user = mysqli_query($con, $user);
              $row_user = mysqli_fetch_array($run_user);

            //  $query_com = "SELECT p.*, COUNT('c.com_id') AS num FROM posts AS p INNER JOIN comments AS c ON c.post_id = p.post_id WHERE p.user_id = 4 GROUP BY p.post_id ORDER BY 1 DESC LIMIT 0,5";

              $user_name = $row_user['user_name'];
              $user_image = $row_user['user_image'];
              //now displaying post from database

              if(strlen($content) > 200){
                $content1 = substr($content, 0, 200);
                for($i = 200; $i < strlen($content) && $content[$i] != ' '; $i++){
                  $content1 .= $content[$i];
                }
                $content2 = substr($content, $i + 1);
              }

              if($content == "No" && strlen($upload_image) >= 1){
                echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
                        <img src='users/$user_image' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
                        <span class='w3-right w3-opacity'>$post_date</span>
                        <h4><a style='text-decoration: none; cursor: pointer; color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h4><br>
                        <hr class='w3-clear'>
                        <img id='post-img' src='imagepost/$upload_image' style='margin-bottom: 5px;'/>
                        <a href='javascript:void(0)' style='text-decoration: none;'><button onclick='like_update($post_id)' type='button' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='fa fa-thumbs-up' style='color: #4CAF50;'></i> (<span id='like_loop_$post_id'>$like_count</span>)</button></a>
                        <a href='javascript:void(0)' style='text-decoration: none;'><button onclick='dislike_update($post_id)' type='button' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='fa fa-heart' style='color: red; border-radius: 50%;'></i> (<span id='dislike_loop_$post_id'>$dislike_count</span>)</button></a>
                        <a style='text-decoration: none;' href='single.php?post_id=$post_id'><button type='button' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-comment'></i> Comment</button></a>
                      </div>";
              }
              else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
                if(strlen($content) > 200){
                echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
                        <img src='users/$user_image' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
                        <span class='w3-right w3-opacity'>$post_date</span>
                        <h4><a style='text-decoration: none; cursor: pointer; color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h4><br>
                        <hr class='w3-clear'>
                        <p>$content1 <span class='dots'>...</span><span class='more' style='display: none;'>$content2</span> <button style='display: block;' class='myBtn w3-button w3-theme-d2 w3-margin-bottom' >Read More</button></p>
                        <img id='post-img' src='imagepost/$upload_image' style='margin-bottom: 5px;'/>
                        <a href='javascript:void(0)' style='text-decoration: none;'><button onclick='like_update($post_id)' type='button' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='fa fa-thumbs-up' style='color: #4CAF50;'></i> (<span id='like_loop_$post_id'>$like_count</span>)</button></a>
                        <a href='javascript:void(0)' style='text-decoration: none;'><button onclick='dislike_update($post_id)' type='button' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='fa fa-heart' style='color: red; border-radius: 50%;'></i> (<span id='dislike_loop_$post_id'>$dislike_count</span>)</button></a>
                        <a style='text-decoration: none;' href='single.php?post_id=$post_id'><button type='button' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-comment'></i>  Comment</button></a>
                      </div>";
                }
                else {
                  echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
                          <img src='users/$user_image' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
                          <span class='w3-right w3-opacity'>$post_date</span>
                          <h4><a style='text-decoration: none; cursor: pointer; color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h4><br>
                          <hr class='w3-clear'>
                          <p>$content</p>
                          <img id='post-img' src='imagepost/$upload_image' style='margin-bottom: 5px;'/>
                          <a href='javascript:void(0)' style='text-decoration: none;'><button onclick='like_update($post_id)' type='button' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='fa fa-thumbs-up' style='color: #4CAF50;'></i> (<span id='like_loop_$post_id'>$like_count</span>)</button></a>
                          <a href='javascript:void(0)' style='text-decoration: none;'><button onclick='dislike_update($post_id)' type='button' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='fa fa-heart' style='color: red; border-radius: 50%;'></i> (<span id='dislike_loop_$post_id'>$dislike_count</span>)</button></a>
                          <a style='text-decoration: none;' href='single.php?post_id=$post_id'><button type='button' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-comment'></i>  Comment</button></a>
                        </div>";
                }
              }
              else {
                if(strlen($content) > 299){
                  echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
                          <img src='users/$user_image' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
                          <span class='w3-right w3-opacity'>$post_date</span>
                          <h4><a style='text-decoration: none; cursor: pointer; color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h4><br>
                          <hr class='w3-clear'>
                          <p>$content1 <span class='dots'>...</span><span class='more' style='display: none;'>$content2 </span><button style='display: block;' class='myBtn w3-button w3-theme-d2 w3-margin-bottom'>Read More</button></p>
                          <a href='javascript:void(0)' style='text-decoration: none;'><button onclick='like_update($post_id)' type='button' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='fa fa-thumbs-up' style='color: #4CAF50;'></i> (<span id='like_loop_$post_id'>$like_count</span>)</button></a>
                          <a href='javascript:void(0)' style='text-decoration: none;'><button onclick='dislike_update($post_id)' type='button' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='fa fa-heart' style='color: red; border-radius: 50%;'></i> (<span id='dislike_loop_$post_id'>$dislike_count</span>)</button></a>
                          <a style='text-decoration: none;' href='single.php?post_id=$post_id'><button type='button' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-comment'></i>  Comment</button></a>
                        </div>";
                }
                else {
                  echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
                          <img src='users/$user_image' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
                          <span class='w3-right w3-opacity'>$post_date</span>
                          <h4><a style='text-decoration: none; cursor: pointer; color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h4><br>
                          <hr class='w3-clear'>
                          <p>$content</p>
                          <a href='javascript:void(0)' style='text-decoration: none;'><button onclick='like_update($post_id)' type='button' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='fa fa-thumbs-up' style='color: #4CAF50;'></i> (<span id='like_loop_$post_id'>$like_count</span>)</button></a>
                          <a href='javascript:void(0)' style='text-decoration: none;'><button onclick='like_update($post_id)'  type='button' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='fa fa-heart' style='color: red;'></i>  (<span id='like_loop_$post_id'>$dislike_count</span>)</button></a>
                          <a style='text-decoration: none;' href='single.php?post_id=$post_id'><button type='button' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-comment'></i>  Comment</button></a>
                        </div>";
                }
              }
            }

    }
    else {
      $get_posts = "SELECT * FROM `posts` WHERE user_id IN (SELECT followed_id FROM followers WHERE follower_id = $user_id) OR user_id = $user_id ORDER BY 1 DESC LIMIT $start_from, $per_page";
      $run_posts = mysqli_query($con, $get_posts);
      while($row_posts = mysqli_fetch_array($run_posts)){
        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
        $content = $row_posts['post_content'];
        $like_count = $row_posts['like_count'];
        $dislike_count = $row_posts['dislike_count'];

        $upload_image = $row_posts['upload_image'];
        $post_date = $row_posts['post_date'];

        $user = "SELECT * FROM users WHERE user_id=$user_id AND posts='yes'";
        $run_user = mysqli_query($con, $user);
        $row_user = mysqli_fetch_array($run_user);

      //  $query_com = "SELECT p.*, COUNT('c.com_id') AS num FROM posts AS p INNER JOIN comments AS c ON c.post_id = p.post_id WHERE p.user_id = 4 GROUP BY p.post_id ORDER BY 1 DESC LIMIT 0,5";

        $user_name = $row_user['user_name'];
        $user_image = $row_user['user_image'];
        //now displaying post from database

        if(strlen($content) > 200){
          $content1 = substr($content, 0, 200);
          for($i = 200; $i < strlen($content) && $content[$i] != ' '; $i++){
            $content1 .= $content[$i];
          }
          $content2 = substr($content, $i + 1);
        }

        if($content == "No" && strlen($upload_image) >= 1){
          echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
                  <img src='users/$user_image' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
                  <span class='w3-right w3-opacity'>$post_date</span>
                  <h4><a style='text-decoration: none; cursor: pointer; color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h4><br>
                  <hr class='w3-clear'>
                  <img id='post-img' src='imagepost/$upload_image' style='margin-bottom: 5px;'/>
                  <a href='javascript:void(0)' style='text-decoration: none;'><button onclick='like_update($post_id)' type='button' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='fa fa-thumbs-up' style='color: #4CAF50;'></i> (<span id='like_loop_$post_id'>$like_count</span>)</button></a>
                  <a href='javascript:void(0)' style='text-decoration: none;'><button onclick='dislike_update($post_id)' type='button' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='fa fa-heart' style='color: red; border-radius: 50%;'></i> (<span id='dislike_loop_$post_id'>$dislike_count</span>)</button></a>
                  <a style='text-decoration: none;' href='single.php?post_id=$post_id'><button type='button' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-comment'></i> Comment</button></a>
                </div>";
        }
        else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
          if(strlen($content) > 200){
          echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
                  <img src='users/$user_image' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
                  <span class='w3-right w3-opacity'>$post_date</span>
                  <h4><a style='text-decoration: none; cursor: pointer; color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h4><br>
                  <p>$content1 <span class='dots'>...</span><span class='more' style='display: none;'>$content2</span> <button style='display: block;' class='myBtn w3-button w3-theme-d2 w3-margin-bottom' >Read More</button></p>
                  <hr class='w3-clear'>
                  <img id='post-img' src='imagepost/$upload_image' style='margin-bottom: 5px;'/>
                  <a href='javascript:void(0)' style='text-decoration: none;'><button onclick='like_update($post_id)' type='button' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='fa fa-thumbs-up' style='color: #4CAF50;'></i> (<span id='like_loop_$post_id'>$like_count</span>)</button></a>
                  <a href='javascript:void(0)' style='text-decoration: none;'><button onclick='dislike_update($post_id)' type='button' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='fa fa-heart' style='color: red; border-radius: 50%;'></i> (<span id='dislike_loop_$post_id'>$dislike_count</span>)</button></a>
                  <a style='text-decoration: none;' href='single.php?post_id=$post_id'><button type='button' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-comment'></i>  Comment</button></a>
                </div>";
          }
          else {
            echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
                    <img src='users/$user_image' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
                    <span class='w3-right w3-opacity'>$post_date</span>
                    <h4><a style='text-decoration: none; cursor: pointer; color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h4><br>
                    <hr class='w3-clear'>
                    <p>$content</p>
                    <img id='post-img' src='imagepost/$upload_image' style='margin-bottom: 5px;'/>
                    <a href='javascript:void(0)' style='text-decoration: none;'><button onclick='like_update($post_id)' type='button' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='fa fa-thumbs-up' style='color: #4CAF50;'></i> (<span id='like_loop_$post_id'>$like_count</span>)</button></a>
                    <a href='javascript:void(0)' style='text-decoration: none;'><button onclick='dislike_update($post_id)' type='button' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='fa fa-heart' style='color: red; border-radius: 50%;'></i> (<span id='dislike_loop_$post_id'>$dislike_count</span>)</button></a>
                    <a style='text-decoration: none;' href='single.php?post_id=$post_id'><button type='button' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-comment'></i>  Comment</button></a>
                  </div>";
          }
        }
        else {
          if(strlen($content) > 299){
            echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
                    <img src='users/$user_image' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
                    <span class='w3-right w3-opacity'>$post_date</span>
                    <h4><a style='text-decoration: none; cursor: pointer; color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h4><br>
                    <hr class='w3-clear'>
                    <p>$content1 <span class='dots'>...</span><span class='more' style='display: none;'>$content2 </span><button style='display: block;' class='myBtn w3-button w3-theme-d2 w3-margin-bottom'>Read More</button></p>
                    <a href='javascript:void(0)' style='text-decoration: none;'><button onclick='like_update($post_id)' type='button' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='fa fa-thumbs-up' style='color: #4CAF50;'></i> (<span id='like_loop_$post_id'>$like_count</span>)</button></a>
                    <a href='javascript:void(0)' style='text-decoration: none;'><button onclick='dislike_update($post_id)' type='button' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='fa fa-heart' style='color: red; border-radius: 50%;'></i> (<span id='dislike_loop_$post_id'>$dislike_count</span>)</button></a>
                    <a style='text-decoration: none;' href='single.php?post_id=$post_id'><button type='button' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-comment'></i>  Comment</button></a>
                  </div>";
          }
          else {
            echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
                    <img src='users/$user_image' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
                    <span class='w3-right w3-opacity'>$post_date</span>
                    <h4><a style='text-decoration: none; cursor: pointer; color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h4><br>
                    <hr class='w3-clear'>
                    <p>$content</p>
                    <a href='javascript:void(0)' style='text-decoration: none;'><button onclick='like_update($post_id)' type='button' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='fa fa-thumbs-up' style='color: #4CAF50;'></i> (<span id='like_loop_$post_id'>$like_count</span>)</button></a>
                    <a href='javascript:void(0)' style='text-decoration: none;'><button onclick='dislike_update($post_id)' type='button' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='fa fa-heart' style='color: red; border-radius: 50%;'></i> (<span id='dislike_loop_$post_id'>$dislike_count</span>)</button></a>
                    <a style='text-decoration: none;' href='single.php?post_id=$post_id'><button type='button' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-comment'></i>  Comment</button></a>
                  </div>";
          }
        }
      }
        include 'pagination.php';
    }
  }

  function single_post(){
    if(isset($_GET['post_id'])){
      global $con;

      $get_id = $_GET['post_id'];
      $get_posts = "SELECT * FROM posts WHERE post_id=$get_id";

      $run_posts = mysqli_query($con, $get_posts);
      $row_posts = mysqli_fetch_array($run_posts);

      $post_id = $row_posts['post_id'];
      $user_id = $row_posts['user_id'];
      $content = $row_posts['post_content'];
      $upload_image = $row_posts['upload_image'];
      $post_date = $row_posts['post_date'];

      $user = "SELECT * FROM users WHERE user_id=$user_id AND posts='yes'";
      $run_user = mysqli_query($con, $user);
      $row_user = mysqli_fetch_array($run_user);

      $user_name = $row_user['user_name'];
      $user_image = $row_user['user_image'];

      $user_com = $_SESSION['user_email'];
      $get_com = "SELECT * FROM users WHERE user_email='$user_com'";
      $run_com = mysqli_query($con, $get_com);
      $row_com = mysqli_fetch_array($run_com);

      $user_com_id = $row_com['user_id'];
      $user_com_name = $row_com['user_name'];

      if(isset($_GET['post_id'])){
        $post_id = $_GET['post_id'];
      }

      $get_posts = "SELECT post_id FROM users WHERE post_id=$post_id";
      $run_user = mysqli_query($con, $get_posts);

      $post_id = $_GET['post_id'];

      $post = $_GET['post_id'];
      $get_user = "SELECT * FROM posts WHERE post_id=$post";
      $run_user = mysqli_query($con, $get_user);
      $row = mysqli_fetch_array($run_user);

      $p_id = $row['post_id'];

      if($p_id != $post_id){
        echo "<script>alert('ERROR')</script>";
        echo "<script>window.open('home.php', '_self')</script>";
      }
      else {
        if($content == "No" && strlen($upload_image) >= 1){
          echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
                  <img src='users/$user_image' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
                  <span class='w3-right w3-opacity'>$post_date</span>
                  <h4><a style='text-decoration: none; cursor: pointer; color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h4><br>
                  <hr class='w3-clear'>
                  <img id='post-img' src='imagepost/$upload_image' style='margin-bottom: 5px;'/>
                </div>";
        }
        else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
          echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
                  <img src='users/$user_image' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
                  <span class='w3-right w3-opacity'>$post_date</span>
                  <h4><a style='text-decoration: none; cursor: pointer; color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h4><br>
                  <hr class='w3-clear'>
                  <p>$content</p>
                  <img id='post-img' src='imagepost/$upload_image' style='margin-bottom: 5px;'/>
                </div>";
        }
        else {
          echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
                  <img src='users/$user_image' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
                  <span class='w3-right w3-opacity'>$post_date</span>
                  <h4><a style='text-decoration: none; cursor: pointer; color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h4><br>
                  <hr class='w3-clear'>
                  <p>$content</p>
                </div>";
        } // else condition ending
        include 'comments.php';

        echo "

              <div class='w3-row-padding'>
                <div class='w3-col m12'>
                  <div class='w3-card w3-round w3-white'>
                    <div class='w3-container w3-padding'>
                      <h6 class='w3-opacity'>Comment</h6>
                      <form id='f' method='post'>
                        <textarea style='width: 100%; resize: none;' name='comment' class='form-control' id='content' rows='4' placeholder='Write your comment here!'></textarea><br/>
                        <button class='w3-button w3-theme' name='reply'><i class='fa fa-comment'></i>$nombre_com  Comment</button>
                      </form>
                    </div>
                  </div>
                </div>";

        if(isset($_POST['reply'])){
          $comment = htmlentities($_POST['comment']);

          if($comment == ""){
            echo "<script>alert('Enter your comment!')</script>";
            echo "<script>window.open('single.php?post_id=$post_id', '_self')</script>";
          }
          else {
            $insert = "INSERT INTO comments (post_id, user_id, comment, comment_author, date) VALUES ($post_id, $user_id, '$comment', '$user_com_name', NOW())";

            $run = mysqli_query($con, $insert);

            echo "<script>window.open('single.php?post_id=$post_id', '_self')</script>";
          }
        }
      }
    }
  }

  function user_posts(){
    global $con;

    if(isset($_GET['u_id'])){
      $u_id = $_GET['u_id'];
    }

    $get_posts = "SELECT * FROM posts WHERE user_id='$u_id' ORDER BY 1 DESC LIMIT 5";
    $run_posts = mysqli_query($con, $get_posts);

    while($row_posts = mysqli_fetch_array($run_posts)){
      $post_id = $row_posts['post_id'];
      $user_id = $row_posts['user_id'];
      $content = $row_posts['post_content'];
      $upload_image = $row_posts['upload_image'];
      $post_date = $row_posts['post_date'];

      $user = "SELECT * FROM users WHERE user_id=$user_id AND posts='yes'";
      $run_user = mysqli_query($con, $user);
      $row_user = mysqli_fetch_array($run_user);

      $user_name = $row_user['user_name'];
      $user_image = $row_user['user_image'];

      if(isset($_GET['u_id'])){
        $u_id = $_GET['u_id'];
      }
      $getuser = "SELECT user_email FROM users WHERE user_id='$u_id'";
      $run_user = mysqli_query($con, $getuser);
      $row = mysqli_fetch_array($run_user);

      $user_email = $row['user_email'];
      $user = $_SESSION['user_email'];
      $get_user = "SELECT * FROM users WHERE user_email='$user'";
      $run_user = mysqli_query($con, $get_user);
      $row = mysqli_fetch_array($run_user);

      $user_id = $row['user_id'];
      $u_email = $row['user_email'];

      if($u_email != $user_email){
        echo "<script>window.open('my_post.php?u_id=$user_id', '_self')</script>";
      }
      else {
        if($content == "No" && strlen($upload_image) >= 1){
          echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
                  <img src='users/$user_image' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
                  <span class='w3-right w3-opacity'>$post_date</span>
                  <h4><a style='text-decoration: none; cursor: pointer; color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h4><br>
                  <hr class='w3-clear'>
                  <img id='post-img' src='imagepost/$upload_image' style='margin-bottom: 5px;'/>
                </div>";
        }
        else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
          echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
                  <img src='users/$user_image' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
                  <span class='w3-right w3-opacity'>$post_date</span>
                  <h4><a style='text-decoration: none; cursor: pointer; color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h4><br>
                  <hr class='w3-clear'>
                  <p>$content</p>
                  <img id='post-img' src='imagepost/$upload_image' style='margin-bottom: 5px;'/>
                </div>";
        }
        else {
          echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
                  <img src='users/$user_image' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
                  <span class='w3-right w3-opacity'>$post_date</span>
                  <h4><a style='text-decoration: none; cursor: pointer; color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h4><br>
                  <hr class='w3-clear'>
                  <p>$content</p>
                </div>";
        }
      }
    }
  }

  function results(){
    global $con;

    if(isset($_GET['search'])){
      $search_query = htmlentities($_GET['user_query']);
    }

    $get_posts = "SELECT * FROM posts WHERE post_content LIKE '%$search_query%' OR upload_image LIKE '%$search_query%'";

    $run_posts = mysqli_query($con, $get_posts);

    while($row_posts = mysqli_fetch_array($run_posts)){
      $post_id = $row_posts['post_id'];
      $user_id = $row_posts['user_id'];
      $content = $row_posts['post_content'];
      $upload_image = $row_posts['upload_image'];
      $post_date = $row_posts['post_date'];

      $user = "SELECT * FROM users WHERE user_id=$user_id AND posts='yes'";
      $run_user = mysqli_query($con, $user);
      $row_user = mysqli_fetch_array($run_user);

      $user_name = $row_user['user_name'];
      $first_name = $row_user['f_name'];
      $last_name = $row_user['l_name'];
      $user_image = $row_user['user_image'];

      // displayin Posts

      if($content == "No" && strlen($upload_image) >= 1){
        echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
                <img src='users/$user_image' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
                <span class='w3-right w3-opacity'>$post_date</span>
                <h4><a style='text-decoration: none; cursor: pointer; color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h4><br>
                <hr class='w3-clear'>
                <img id='post-img' src='imagepost/$upload_image' style='margin-bottom: 5px;'/>
              </div>";
      }
      else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
        echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
                <img src='users/$user_image' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
                <span class='w3-right w3-opacity'>$post_date</span>
                <h4><a style='text-decoration: none; cursor: pointer; color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h4><br>
                <hr class='w3-clear'>
                <p>$content</p>
                <img id='post-img' src='imagepost/$upload_image' style='margin-bottom: 5px;'/>
              </div>";
      }
      else {
        echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
                <img src='users/$user_image' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
                <span class='w3-right w3-opacity'>$post_date</span>
                <h4><a style='text-decoration: none; cursor: pointer; color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h4><br>
                <hr class='w3-clear'>
                <p>$content</p>
              </div>";
      }
    }
  }
?>
