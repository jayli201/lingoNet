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
  // mysqli_free_result($query);
  return $user;
}

// gets all native and target language info for current user
function getMultiLanguageInfo($email)
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

  $targets = array();
  $target_query = "SELECT * FROM target WHERE email = '" . $email . "'";

  $result = mysqli_query($db, $target_query);
  if (mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
      array_push($targets, $row['target']);
    }
  }
  // mysqli_free_result($target_query);

  $languages = array();
  $languages = array(
    'native' => $natives,
    'target' => $targets
  );
  return $languages;
}

// gets native and target language info for current user
// function getLanguageInfo($email)
// {
//   global $db;
//   $languages = array();
//   $query = "SELECT * FROM users, native, target WHERE users.email = native.email AND users.email = target.email AND users.email = '" . $email . "'";

//   $result = mysqli_query($db, $query);
//   if (mysqli_num_rows($result) > 0) {
//     while ($row = $result->fetch_assoc()) {
//       $languages = array(
//         'native' => $row['native'],
//         'target' => $row['target'],
//       );
//     }
//   }
//   mysqli_free_result($query);
//   return $languages;
// }

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
  // mysqli_free_result($query);
  return $post_info;
}

function editProfileInfo($email, $firstName, $lastName, $age, $phone)
{
  global $db;

  $stmt = $db->prepare("UPDATE users SET firstName = ?, lastName = ?, age = ?, phone = ? WHERE email = ?");
  $stmt->bind_param("sssss", $firstName, $lastName, $age, $phone, $email);
  $stmt->execute();
  $stmt->close();

  header("Location: ../pages/profile.php");
}

function editPost($email, $introduction, $lookingFor, $whyYou)
{
  global $db;

  $stmt = $db->prepare("UPDATE post SET introduction = ?, lookingFor = ?, whyYou = ? WHERE email = ?");
  $stmt->bind_param("ssss", $introduction, $lookingFor, $whyYou, $email);
  $stmt->execute();
  $stmt->close();

  header("Location: ../pages/profile.php");
}

function deletePost($email)
{
  global $db;

  $stmt = $db->prepare("DELETE FROM post WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->close();

  header("Location: ../pages/profile.php");
}

function addNative($email, $native)
{
  global $db;

  // add native languages into db
  foreach ($native as $item) {
    if (!empty($item)) {
      $native_stmt = $db->prepare("INSERT INTO native(email, native) VALUES (?, ?)");
      $native_stmt->bind_param("ss", $email, $item);
      $native_stmt->execute();
      $native_stmt->close();
    }
  }

  header("Location: ../pages/profile.php");
}

function addTarget($email, $target)
{
  global $db;

  // add target languages into db
  foreach ($target as $item) {
    if (!empty($item)) {
      $target_stmt = $db->prepare("INSERT INTO target(email, target) VALUES (?, ?)");
      $target_stmt->bind_param("ss", $email, $item);
      $target_stmt->execute();
      $target_stmt->close();
    }
  }

  header("Location: ../pages/profile.php");
}

function deleteNative($email, $native)
{
  global $db;

  $stmt = $db->prepare("DELETE FROM native WHERE email = ? AND native = ?");
  $stmt->bind_param("ss", $email, $native);
  $stmt->execute();
  $stmt->close();

  header("Location: ../pages/profile.php");
}

function deleteTarget($email, $target)
{
  global $db;

  $stmt = $db->prepare("DELETE FROM target WHERE email = ? AND target = ?");
  $stmt->bind_param("ss", $email, $target);
  $stmt->execute();
  $stmt->close();

  header("Location: ../pages/profile.php");
}
