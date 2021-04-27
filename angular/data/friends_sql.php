<?php
require("../../../lingoNet/db/connectdb.php");

// gets all native languages for current user
function getNativeLanguages($email)
{
  global $db;
  $natives = array();
  $native_query = "SELECT * FROM native WHERE email = '" . $email . "'";

  $result = mysqli_query($db, $native_query);
  if (mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
      array_push($natives, $row['native']);
    }
  }
  // mysqli_free_result($native_query);

  return $natives;
}

// gets all target languages for current user
function getTargetLanguages($email)
{
  global $db;
  $targets = array();
  $target_query = "SELECT * FROM target WHERE email = '" . $email . "'";

  $result = mysqli_query($db, $target_query);
  if (mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
      array_push($targets, $row['target']);
    }
  }
  // mysqli_free_result($target_query);

  return $targets;
}

// get pendingFriends information for current user 
function getPendingFriends($email)
{
  global $db;
  $user_info_array = array();
  $current_pending_friends = array();
  $query = "SELECT * FROM users, pending WHERE pending.email = '" . $email . "' 
  AND users.email = pending.friendEmail";

  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
      if (!in_array($row['friendEmail'], $current_pending_friends)) {
        $row["natives"] = getNativeLanguages($row['friendEmail']);
        $row["targets"] = getTargetLanguages($row['friendEmail']);
        $user_info_array[] = $row;
      }
      $current_pending_friends[] = $row['friendEmail'];
    }
  }
  // mysqli_free_result($query);
  echo json_encode($user_info_array);
  // var_dump($user_info_array);
  // return $user_info_array;
}


// get incomingFriends information for current user 
function getIncomingFriends($email)
{
  global $db;
  $user_info_array = array();
  $current_incoming_friends = array();
  $query = "SELECT * FROM users, pending WHERE pending.friendEmail = '" . $email . "'
  AND users.email = pending.email";

  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
      if (!in_array($row['email'], $current_incoming_friends)) {
        $row["natives"] = getNativeLanguages($row['friendEmail']);
        $row["targets"] = getTargetLanguages($row['friendEmail']);
        $user_info_array[] = $row;
      }
      $current_incoming_friends[] = $row['email'];
    }
  }
  // mysqli_free_result($query);
  echo json_encode($user_info_array);
  // var_dump($user_info_array);
  // return $user_info_array;
}

// get acceptedFriends information for current user 
function getAcceptedFriends($email)
{
  global $db;
  $user_info_array = array();
  $current_friends_1 = array();

  // check if (email, friendEmail) pair is in friend table
  $query1 = "SELECT * FROM users, friend 
  WHERE friend.friendEmail = '" . $email . "'  
  AND users.email = friend.email";

  $result1 = mysqli_query($db, $query1);
  if (mysqli_num_rows($result1) > 0) {
    while ($row = $result1->fetch_assoc()) {
      if (!in_array($row['email'], $current_friends_1)) {
        $row["natives"] = getNativeLanguages($row['friendEmail']);
        $row["targets"] = getTargetLanguages($row['friendEmail']);
        $user_info_array[] = $row;
      }
      $current_friends_1[] = $row['email'];
    }
  }
  // mysqli_free_result($query);

  // check if (friendEmail, email) pair is in friend table
  $current_friends_2 = array();
  $query2 = "SELECT * FROM users, friend 
  WHERE friend.email = '" . $email . "'  
  AND users.email = friend.friendEmail";

  $result2 = mysqli_query($db, $query2);
  if (mysqli_num_rows($result2) > 0) {
    while ($row = $result2->fetch_assoc()) {
      if (!in_array($row['friendEmail'], $current_friends_2)) {
        $row["natives"] = getNativeLanguages($row['friendEmail']);
        $row["targets"] = getTargetLanguages($row['friendEmail']);
        $user_info_array[] = $row;
      }
      $current_friends_2[] = $row['friendEmail'];
    }
  }
  // mysqli_free_result($query);
  echo json_encode($user_info_array);

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
