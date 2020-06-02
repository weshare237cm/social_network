<?php
  session_start();
  if(!isset($_SESSION['username'])){
    header("Location:login.php");
  }
  include "../includes/connection1.php";
  $msg = "";
?>
<?php include "header.php"; ?>

      <div class="row" style="padding-left: 0px; padding-right: 0px;">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="padding-right: 0px; padding-left: 0px;">
          <?php include "left_menu.php"; ?>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
          <div class="well">
            <form id="form_search" class="form-inline" action='<?php echo $_SERVER["PHP_SELF"]; ?>' method="post">
              <div class="form-group">
                <label>Search By Name:</label>
                <input type="text" id="search_text" class="form-control" name="search_text">
              </div>
              <button type="submit" class="btn btn-default" id="btn_search" name="btn_search">Search By Post ID</button>
            </form>
          </div>
          <div class="panel panel-info">
            <div class="panel-heading">
              <div class="panel-title">Manage Posts</div>
            </div>
            <div class="panel-body">
              <?php echo $msg; ?>
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>User ID</th>
                    <th style="width: 60%;">Post Content</th>
                    <th>Post Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $query = "";
                    if(isset($_POST["btn_search"])){
                      $query = mysqli_query($con, "select * from posts where user_id like '%".mres($con, $_POST["search_text"])."%' order by post_id desc");
                    } else {
                      $query = mysqli_query($con, "select * from posts");
                    }
                    while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
                      echo "<tr>";
                      echo "<td>".$row['post_id']."</td><td>".$row['user_id']."</td>
                            <td>".$row['post_content']."</td>
                            <td>".$row['post_date']."</td>";
                      echo "</tr>";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    <script type="text/javascript">
      $(document).ready(function(){

        $("#btn_search").click(function(e){
          if($("#search_text").val() == ''){
            $('#search_text').css("border-color", "#DA190B");
            $('#search_text').css("background", "#F2DEDE");
            e.preventDefault();
          }
          else {
            $('form_search').unbind('submit').submit();
          }
        });
      });
    </script>
<?php include "footer.php"; ?>
