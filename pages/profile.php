<!-- ***************************************************************************************/
* Title: Bootstrap source code
* Author: Mark Otto, Jacob Thornton
* Date: 2021
* Code version: 4.6.0
* Availability: https://getbootstrap.com/
***************************************************************************************/ -->
<?php
require("../db/connectdb.php");
require("../sql/intropost_sql.php");
require("../sql/profile_sql.php");

$profile_info = getProfileInfo($_SESSION['email']);
$language_info = getMultiLanguageInfo($_SESSION['email']);
$post_info = getPostInfo($_SESSION['email']);

if (isset($_POST['action'])) {
  if (!empty($_POST['action']) && ($_POST['action'] == 'Post!')) {
    $error = createPost($_SESSION['email'], $_POST['introduction'], $_POST['lookingFor'], $_POST['whyYou']);
  }
}

if (isset($_POST['editPost'])) {
  if (!empty($_POST['editPost']) && ($_POST['editPost'] == 'Save changes')) {
    editPost($_SESSION['email'], $_POST['editedIntro'], $_POST['editedLookingFor'], $_POST['editedWhyYou']);
  }
}

if (isset($_POST['deletePost'])) {
  if (!empty($_POST['deletePost']) && ($_POST['deletePost'] == 'Delete Post')) {
    deletePost($_SESSION['email']);
  }
}

if (isset($_POST['addNative'])) {
  if (!empty($_POST['addNative']) && ($_POST['addNative'] == 'Add languages')) {
    addNative($_SESSION['email'], $_POST['native']);
  }
}

if (isset($_POST['addTarget'])) {
  if (!empty($_POST['addTarget']) && ($_POST['addTarget'] == 'Add languages')) {
    addTarget($_SESSION['email'], $_POST['target']);
  }
}

if (isset($_POST['deleteNative'])) {
  if (!empty($_POST['deleteNative']) && ($_POST['deleteNative'] == 'Delete Native')) {
    deleteNative($_SESSION['email'], $_POST['native']);
  }
}

if (isset($_POST['deleteTarget'])) {
  if (!empty($_POST['deleteTarget']) && ($_POST['deleteTarget'] == 'Delete Target')) {
    deleteTarget($_SESSION['email'], $_POST['target']);
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Profile">
  <meta name="author" content="Jasmin Li, Rebecca Zhou">

  <title>Profile</title>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel="stylesheet" href="../css/layout.css" />
  <link rel="stylesheet" href="../css/content.css" />
  <link rel="stylesheet" href="../css/theme.css" />
</head>

<body>
  <?php
  // if user has not logged in, then redirect
  // otherwise, display content 
  if (!isset($_SESSION['email'])) {
    header("Location: ../auth/welcome.php");
  } else
  ?>

  <div class="page-container">
    <div class="content-wrap">
      <div id="header"></div>

      <div class="position-relative overflow-hidden p-3 p-md-5 m-md-2">
        <div class="content">
          <h1 class="display-4">Profile</h1>
          <hr />
          <br />

          <div class="container">

            <div class="row">
              <div class="col">
                <?php include("relevant_profile/profile_info.php") ?>
                <hr />
                <?php include("relevant_profile/profile_lang.php"); ?>
                <hr />
              </div>

              <div class="col">
                <?php
                // if post doesn't exist, then display the create post form
                if (!postExists($_SESSION['email'])) {
                  include("relevant_profile/profile_create_post.php");
                } else {
                  include("relevant_profile/profile_post.php");
                } ?>
              </div>

            </div>
          </div>
        </div>
      </div>

      <br />
      <div id="footer"></div>

    </div>
  </div>

  <script src="../layout/layout.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</body>

</html>