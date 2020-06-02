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
              <button type="submit" class="btn btn-default" id="btn_search" name="btn_search">Search</button>
            </form>
          </div>
          <div class="panel panel-info">
            <div class="panel-heading">
              <div class="panel-title">Manage Messages</div>
            </div>
            <div class="panel-body">
              <?php echo $msg; ?>
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>User To</th>
                    <th>User From</th>
                    <th style="width: 40%;">Message</th>
                    <th>Date</th>
                    <th>Seen</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $query = "";
                    if(isset($_POST["btn_search"])){
                      $query = mysqli_query($con, "select * from table_sub_category
                                                   inner join table_category
                                                   on table_sub_category.category_id = table_category.category_id
                                                   where sub_category_name like
                                                   '%".mres($con, $_POST["search_text"])."%'
                                                   order by sub_category_order asc");
                    } else {
                      $query = mysqli_query($con, "SELECT * FROM user_messages");
                    }
                    while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
                      echo "<tr>";
                      echo "<td>".$row['id']."</td><td>".$row['user_to']."</td>
                            <td>".$row['user_from']."</td>
                            <td>".$row['msg_body']."</td><td>".$row['date']."</td>
                            <td>".$row['msg_seen']."</td>";
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
