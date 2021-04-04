<?php
require("../db/connectdb.php");

// get pendingFriends information for current user 
function getPendingFriends($email)
{
  global $db;
  $user_info_array = array();
  $query = "SELECT * FROM users, native, target, pending WHERE pending.email = '" . $email . "'
  AND users.email = native.email AND users.email = target.email AND users.email = pending.friendEmail";

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


// get incomingFriends information for current user 
function getIncomingFriends($email)
{
  global $db;
  $user_info_array = array();
  $query = "SELECT * FROM users, native, target, pending WHERE pending.friendEmail = '" . $email . "'
  AND users.email = native.email AND users.email = target.email AND users.email = pending.email";

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

function acceptFriendRequest($email, $friendEmail, $friendStatus)
{
  global $db;
  $user_info_array = array();
  // $query = "SELECT * FROM users, native, target, friend WHERE friend.friendEmail = '" . $email . "' AND friend.friendStatus = 'pending'
  // AND users.email = native.email AND users.email = target.email AND users.email = friend.email";

  // $query = "SELECT * FROM friend WHERE (friend.email = '" . $email . "' OR friend.friendEmail = '" . $email . "') AND friend.friendStatus = 'pending'";
  $query = "SELECT * FROM friend WHERE friend.email = '" . $email . "' AND friend.friendEmail = $friendEmail'";

  echo $email;
  echo $friendEmail;

  // $query = "UPDATE friend SET friend.friendStatus = 'accepted' 
  // WHERE (friend.email = '" . $email . "' OR friend.friendEmail = '" . $email . "') AND friend.friendStatus = 'pending'";

  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
      $user = array(
        'email' => $row['email'],
        'friendEmail' => $row['friendEmail'],
        'friendStatus' => $row['friendStatus']
      );

      $user_json = json_encode($user);
      array_push($user_info_array, $user_json);
    }
    // foreach ($user_info_array as $a) {
    //   echo $a;
    // }
    var_dump($user_info_array);
  }
  mysqli_free_result($query);
  return $user_info_array;
}
