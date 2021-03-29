<?php
require("../db/connectdb.php");

function signUp($email, $pwd, $firstName, $lastName, $age, $phone, $native, $target)
{
  global $db;

  // add user into db
  $stmt = $db->prepare("INSERT INTO users(email, password, firstName, lastName, age, phone) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssii", $email, $pwd, $firstName, $lastName, $age, $phone);
  if (!$stmt->execute()) {
    return "Email already taken. Please try again with a new email.";
  } else {
    // add native languages into db
    $natives = explode(",", $native);
    $native_array = array_map('trim', $natives);
    foreach ($native_array as $item) {
      $native_stmt = $db->prepare("INSERT INTO native(email, native) VALUES (?, ?)");
      $native_stmt->bind_param("ss", $email, $item);
      $native_stmt->execute();
      $native_stmt->close();
    }

    // add target languages into db
    $targets = explode(",", $target);
    $target_array = array_map('trim', $targets);
    foreach ($target_array as $item) {
      $target_stmt = $db->prepare("INSERT INTO target(email, target) VALUES (?, ?)");
      $target_stmt->bind_param("ss", $email, $item);
      $target_stmt->execute();
      $target_stmt->close();
    }

    $_SESSION['email'] = $email;
    header("Location: ../pages/postfeed.php");
  }
  $stmt->close();
}