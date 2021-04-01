<?php
require("../db/connectdb.php");

function getPostfeedInfo()
{
  global $db;
  $user_info_array = array();
  $query = "SELECT * FROM users, native, target WHERE users.email = native.email AND users.email = target.email";
  $result = mysqli_query($db, $query);

  if (mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
      $user = array(
        'firstName' => $row['firstName'],
        'lastName' => $row['lastName'],
        'email' => $row['email'],
        'target' => $row['target'],
        'native' => $row['native']
      );
      $user_json = json_encode($user);
      array_push($user_info_array, $user_json);
    }
  }
  mysqli_free_result($query);
  return $user_info_array;
}
