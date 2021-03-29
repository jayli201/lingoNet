<?php
require("../db/connectdb.php");

function signUp($email, $pwd, $firstName, $lastName, $age, $phone)
{
  global $db;

  // add user into db
  $stmt = $db->prepare("INSERT INTO users(email, password, firstName, lastName, age, phone) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssii", $email, $pwd, $firstName, $lastName, $age, $phone);
  if (!$stmt->execute()) {
    return "Email already taken. Please try again with a new email.";
  } else {
    $_SESSION['email'] = $email;
    header("Location: ../pages/postfeed.php");
  }
  $stmt->close();
}
