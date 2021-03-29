<?php
require("../db/connectdb.php");

// does this email exist in db?
function userExists($email)
{
  global $db;

  $exists_query = "SELECT email FROM users WHERE BINARY email = ?";
  $exists_stmt = $db->prepare($exists_query);
  $exists_stmt->bind_param("s", $email);
  $exists_stmt->execute();
  $exists_stmt->store_result();

  if ($exists_stmt->num_rows() == 1) {
    return true;
  } else {
    return false;
  }
}

function signUp($email, $pwd, $firstName, $lastName, $age, $phone)
{
  if (userExists($email)) {
    return "Email already exists in system. Please sign up with a different email.";
  } else {
    $_SESSION['email'] = $email;
    $_SESSION['pwd'] = $pwd;
    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    $_SESSION['age'] = $age;
    $_SESSION['phone'] = $phone;
    header("Location: signup_cont.php");
  }
}

function signUpCont($email, $pwd, $firstName, $lastName, $age, $phone, $native, $target)
{
  global $db;

  // add user into db
  $stmt = $db->prepare("INSERT INTO users(email, password, firstName, lastName, age, phone) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssii", $email, $pwd, $firstName, $lastName, $age, $phone);
  $stmt->execute();
  $stmt->close();

  // add native languages into db
  foreach ($native as $item) {
    $native_stmt = $db->prepare("INSERT INTO native(email, native) VALUES (?, ?)");
    $native_stmt->bind_param("ss", $email, $item);
    $native_stmt->execute();
    $native_stmt->close();
  }

  // add target languages into db
  foreach ($target as $item) {
    $target_stmt = $db->prepare("INSERT INTO target(email, target) VALUES (?, ?)");
    $target_stmt->bind_param("ss", $email, $item);
    $target_stmt->execute();
    $target_stmt->close();
  }

  header("Location: ../pages/postfeed.php");
}
