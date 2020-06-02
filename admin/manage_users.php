<?php
  session_start();
  if(!isset($_SESSION['username'])){
    header("Location:login.php");
  }
  include "../includes/connection1.php";
  $msg = "";
  $query = "SELECT * FROM users";
  $run = mysqli_query($con, $query);
  $nombre = mysqli_num_rows($run);
  $msg = '<div id="login-alert" class="alert alert-success col-sm-12">Numbers Of Users: ' . $nombre . '</div>';
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
                <label>Search First Name:</label>
                <input type="text" id="search_text" class="form-control" name="search_text">
              </div>
              <button type="submit" class="btn btn-default" id="btn_search" name="btn_search">Search</button>
            </form>
          </div>
          <div class="panel panel-info">
            <div class="panel-heading">
              <div class="panel-title">Manage Users</div>
            </div>
            <div class="panel-body">
              <?php echo $msg; ?>
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Country</th>
                    <th>Gender</th>
                    <th>User Image</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $query = "";
                    if(isset($_POST["btn_search"])){
                      $query = mysqli_query($con, "SELECT * FROM users WHERE f_name LIKE
                                                   '%".mres($con, $_POST["search_text"])."%'
                                                   ORDER BY user_id ASC");
                    } else {
                      $query = mysqli_query($con, "SELECT * FROM users");
                    }
                    while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
                      echo "<tr>";
                      echo "<td>".$row['user_id']."</td><td>".$row['f_name']."</td>
                            <td>".$row['l_name']."</td>
                            <td>".$row['user_country']."</td>
                            <td>".$row['user_gender']."</td>
                            <td><img src='../users/".$row['user_image']."' style='height: 50px; display: block; margin: auto; border-radius: 50%;'/></td>";
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
