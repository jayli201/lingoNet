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

// check if the hashed password in database matches user input
function checkPass($email, $password)
{
  global $db;

  $query = "SELECT * FROM users WHERE BINARY EMAIL = '" . $email . "'";
  $result = mysqli_query($db, $query);

  if (mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
      if (md5($password) == $row['password']) {
        return $row['password'];
      } else {
        return false;
      }
    }
  }
}

function login($email, $pwd)
{
  global $db;

  // escape special characters for the username and password
  $email = mysqli_real_escape_string($db, $email);
  $password = mysqli_real_escape_string($db, $pwd);
  $hashed_pwd = checkPass($email, $password);

  if (!userExists($email)) {
    return "Email does not exist in system. Please login with a valid email.";
  } else if ($hashed_pwd == false) {
    return "Wrong password. Please reenter your correct password.";
  } else {
    $query = "SELECT * FROM users WHERE BINARY email = ? AND password = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $email, $hashed_pwd);
    $stmt->execute();
    $stmt->store_result();

    // found an email and password match
    if ($stmt->num_rows() == 1) {
      // fill in session details
      $_SESSION['email'] = $email;
      // go to mainpage afterwards
      header('Location: ../pages/postfeed.php');
    }
    $stmt->close();
  }
}
