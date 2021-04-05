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

// get acceptedFriends information for current user 
function getAcceptedFriends($email)
{
  global $db;
  $user_info_array = array();

  // check if (email, friendEmail) pair is in friend table
  $query1 = "SELECT * FROM users, native, target, friend 
  WHERE friend.friendEmail = '" . $email . "'  
  AND users.email = native.email AND users.email = target.email 
  AND users.email = friend.friendEmail";

  $result1 = mysqli_query($db, $query1);
  if (mysqli_num_rows($result1) > 0) {
    while ($row = $result1->fetch_assoc()) {
      $user = array(
        'email' => $row['email'],
        'friendEmail' => $row['friendEmail'],
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
  mysqli_free_result($query1);

  // check if (friendEmail, email) pair is in friend table
  $query2 = "SELECT * FROM users, native, target, friend 
  WHERE friend.email = '" . $email . "'  
  AND users.email = native.email AND users.email = target.email 
  AND users.email = friend.email";

  $result2 = mysqli_query($db, $query2);
  if (mysqli_num_rows($result2) > 0) {
    while ($row = $result2->fetch_assoc()) {
      $user = array(
        'email' => $row['email'],
        'friendEmail' => $row['friendEmail'],
        'firstName' => $row['firstName'],
        'lastName' => $row['lastName'],
        'email' => $row['email'],
        'target' => $row['target'],
        'native' => $row['native']
      );

      // do not display info for current user
      if ($user['email'] != $_SESSION['email']) {
        $user_json = json_encode($user);
        array_push($user_info_array, $user_json);
      }
    }
  }
  mysqli_free_result($query2);

  return $user_info_array;
}


function acceptFriendRequest($email, $friendEmail)
{
  global $db;

  // Add pair into friend table
  $stmt1 = $db->prepare("INSERT INTO friend(email, friendEmail) VALUES (?, ?)");
  $stmt1->bind_param("ss", $friendEmail, $email);

  // Remove friend from pending table
  $stmt2 = $db->prepare("DELETE FROM pending WHERE email = ? AND friendEmail = ?");
  $stmt2->bind_param("ss", $friendEmail, $email);

  $stmt1->execute();
  $stmt2->execute();

  $stmt1->close();
  $stmt2->close();

  // go back to friends page
  header("Location: ../pages/friends.php");
}

function removeFriend($email, $friendEmail)
{
  global $db;

  // Remove friend from friend table
  $stmt1 = $db->prepare("DELETE FROM friend WHERE email = ? AND friendEmail = ?");
  $stmt1->bind_param("ss", $email, $friendEmail);

  // Remove friend from friend table
  $stmt2 = $db->prepare("DELETE FROM friend WHERE email = ? AND friendEmail = ?");
  $stmt2->bind_param("ss", $friendEmail, $email);

  $stmt1->execute();
  $stmt2->execute();

  $stmt1->close();
  $stmt2->close();

  // go back to friends page
  header("Location: ../pages/friends.php");
}
