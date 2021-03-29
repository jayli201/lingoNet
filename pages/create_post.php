<!-- ***************************************************************************************/
* Title: Bootstrap source code
* Author: Mark Otto, Jacob Thornton
* Date: 2021
* Code version: 4.6.0
* Availability: https://getbootstrap.com/
***************************************************************************************/ -->
<?php
require("../db/connectdb.php");
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Create Post">
  <meta name="author" content="Jasmin Li, Rebecca Zhou">

  <title>Create a Post</title>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/layout.css" />
  <link rel="stylesheet" href="../css/content.css" />
  <link rel="stylesheet" href="../css/theme.css" />
</head>

<body>
  <?php
  // if user has logged in, then display 
  if (isset($_SESSION['email'])) {
  ?>
    <div class="page-container">
      <div class="content-wrap">
        <div id="header"></div>
        <br />

        <div class="form">
          <h1 class="display-4">Your Introductory Post</h1>

          <form id="fm-login" name="Post" action="profile.php" method="post" onsubmit="return validateInput()">
            <div class="form-group">
              <label>Personal Introduction: </label>
              <textarea id="introduction" class="form-control" rows="7" placeholder="Introduce yourself!" autofocus required></textarea>
            </div>
            <br />

            <div class="form-group">
              <label>What You're Looking For: </label>
              <textarea id="introduction" class="form-control" rows="5" placeholder="What are you looking for in a language partner?" required></textarea>
            </div>
            <br />

            <div class="form-group">
              <label>Why You?</label>
              <textarea id="introduction" class="form-control" rows="5" placeholder="How are you a great language partner?" required></textarea>
            </div>
            <br />

            <input type="submit" value="Post!" class="btn btn-purple" />
          </form>
        </div>

        <br />
        <div id="footer"></div>
      </div>
    </div>
  <?php
    // if user has not logged in, redirect to welcome page
  } else {
    header("Location: ../auth/welcome.html");
  }
  ?>

  <script src="../layout/layout.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</body>

</html>