<?php
require("../db/connectdb.php");


global $db;
$query = "SELECT * FROM friend WHERE email = ? AND friendEmail = ?";
$check_stmt = $db->prepare($query);
$check_stmt->bind_param("ss", $email, $friendEmail);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows() == 1) {
  return true;
} else {
  return false;
}

// get pendingFriends information for current user 
function getPendingFriends($email)
{
  global $db;
  $user_info_array = array();
  $query = "SELECT * FROM users, native, target, friend WHERE friend.email = '" . $email . "' AND friend.friendStatus = 'pending'
  AND users.email = native.email AND users.email = target.email AND users.email = friend.friendEmail";

  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
      $user = array(
        'email' => $row['email'],
        'friendEmail' => $row['friendEmail'],
        'friendStatus' => $row['friendStatus'],
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
