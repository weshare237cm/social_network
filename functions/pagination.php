<style media="screen">
  .active{
    background: #666;
    color: white;
  }
</style>

<?php
  $u_id = $_SESSION["user_id"];
  $query = "SELECT * FROM posts INNER JOIN followers ON user_id = follower_id WHERE user_id = $u_id";

  $result = mysqli_query($con, $query);
  $total_posts = mysqli_num_rows($result);

  $total_pages = ceil($total_posts / $per_page);

  echo "<center>
          <div class='w3-bar' id='pagination'>
            <a href='home.php?page=1' class='w3-button'>&laquo; First Page</a>
        ";
  echo "<a href='home.php?page=1' class='w3-button active'>1</a>";
  for($i = 2; $i <= $total_pages; $i++){
    echo "<a href='home.php?page=$i' class='w3-button'>$i</a>";
  }

  echo "    <a href='home.php?page=$total_pages' class='w3-button'>Last Page &raquo;</a>
          </div>
        </center>";
?>
