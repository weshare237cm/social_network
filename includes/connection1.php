<?php
  $con = mysqli_connect("localhost", "root", "", "social_network");

  function mres($con, $data){
    return mysqli_real_escape_string($con, rtrim(ltrim($data)));
  }
?>
