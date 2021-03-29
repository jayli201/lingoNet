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

function login($email, $pwd)
{
  global $db;

  // escape special characters for the username and password
  $email = mysqli_real_escape_string($db, $email);
  $password = mysqli_real_escape_string($db, $pwd);

  if (!userExists($email)) {
    return "Email does not exist in system. Please login with a valid email.";
  } else {
    $query = "SELECT phone FROM users WHERE BINARY email = ? AND BINARY password = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $stmt->bind_result($phone);
    $stmt->store_result();

    // found an email and password match
    if ($stmt->num_rows() == 1) {
      // fill in session details
      $_SESSION['email'] = $email;
      $_SESSION['phone'] = $phone;
      // go to mainpage afterwards
      header('Location: ../pages/postfeed.php');
    } else {
      return "Wrong password. Please reenter your correct password.";
    }
    $stmt->close();
  }
}
