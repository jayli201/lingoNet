<?php
require("../db/connectdb.php");

// gets profile info for current user
function getProfileInfo($email)
{
  global $db;
  $user = array();
  $query = "SELECT * FROM users WHERE email = '" . $email . "'";

  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
      $user = array(
        'firstName' => $row['firstName'],
        'lastName' => $row['lastName'],
        'age' => $row['age'],
        'email' => $row['email'],
        'phone' => $row['phone']
      );
    }
  }
  mysqli_free_result($query);
  return $user;
}

// gets native and target language info for current user
function getLanguageInfo($email)
{
  global $db;
  $languages = array();
  $query = "SELECT * FROM users, native, target WHERE users.email = native.email AND users.email = target.email AND users.email = '" . $email . "'";

  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
      $languages = array(
        'native' => $row['native'],
        'target' => $row['target'],
      );
    }
  }
  mysqli_free_result($query);
  return $languages;
}

// gets post info for current user
function getPostInfo($email)
{
  global $db;
  $post_info = array();
  $query = "SELECT * FROM users, post WHERE users.email = post.email AND users.email = '" . $email . "'";

  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
      $post_info = array(
        'introduction' => $row['introduction'],
        'lookingFor' => $row['lookingFor'],
        'whyYou' => $row['whyYou']
      );
    }
  }
  mysqli_free_result($query);
  return $post_info;
}
