<?php
require("../db/connectdb.php");

function login($email, $pwd)
{
  global $db;

  // escape special characters for the username and password
  $email = mysqli_real_escape_string($db, $email);
  $password = mysqli_real_escape_string($db, $pwd);

  $query = "SELECT phone FROM users WHERE BINARY email = ? AND BINARY password = ?";
  $stmt = $db->prepare($query);
  $stmt->bind_param("ss", $email, $password);
  $stmt->execute();
  $stmt->bind_result($phone);
  $stmt->store_result();

  if ($stmt->num_rows() == 1) {
    // fill in session details
    $_SESSION['email'] = $email;
    $_SESSION['phone'] = $phone;
    // go to mainpage afterwards
    header('Location: ../pages/postfeed.php');
  } else {
    return "Invalid username or password";
  }
  $stmt->close();
}