<?php
require("../db/connectdb.php");

function postExists($email)
{
  global $db;

  // first check if user has already created a post
  $query = "SELECT email FROM post WHERE email = ?";
  $check_stmt = $db->prepare($query);
  $check_stmt->bind_param("s", $email);
  $check_stmt->execute();
  $check_stmt->store_result();

  if ($check_stmt->num_rows() == 1) {
    return true;
  } else {
    return false;
  }
}

function createPost($email, $introduction, $lookingFor, $whyYou)
{
  global $db;

  if (postExists($email)) {
    return "You can only have 1 introduction post!";
  } else {
    // add post into db
    $stmt = $db->prepare("INSERT INTO post(email, introduction, lookingFor, whyYou) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $introduction, $lookingFor, $whyYou);
    if (!$stmt->execute()) {
      return "Error creating post.";
    } else {
      header("Location: ../pages/profile.php");
    }
    $stmt->close();
  }
}
