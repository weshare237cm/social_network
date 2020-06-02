<?php
  $get_id = $_GET['post_id'];

  $get_com = "SELECT * FROM comments WHERE post_id=$get_id ORDER BY 1 DESC";

  $run_com = mysqli_query($con, $get_com);
  $nombre_com = mysqli_num_rows($run_com);
  while($row = mysqli_fetch_array($run_com)){
    $com = $row['comment'];
    $com_name = $row['comment_author'];
    $date = $row['date'];

    echo "<div class='w3-row-padding'>
            <div class='w3-col m12'>
              <div class='w3-card w3-round w3-white'>
                <div class='w3-container w3-padding'>
                  <div>
                    <h4><strong>$com_name</strong><i> commented</i> on $date</h4>
                    <p class='text-primary' style='margin-left: 5px; font-size: 20px;'>$com</p>
                  </div>
                </div>
              </div>
            </div>
          </div><br/>";
  }
?>
