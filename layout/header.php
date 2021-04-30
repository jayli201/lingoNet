<!-- ***************************************************************************************/
* Title: Bootstrap source code
* Author: Mark Otto, Jacob Thornton
* Date: 2021
* Code version: 4.6.0
* Availability: https://getbootstrap.com/
***************************************************************************************/ -->
<?php
// start a session
if (!isset($_SESSION)) {
  session_start();
}
?>

<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Friends">
  <meta name="author" content="Jasmin Li, Rebecca Zhou">

  <title>Friend Requests</title>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/layout.css" />
  <link rel="stylesheet" href="../css/content.css" />
  <link rel="stylesheet" href="../css/theme.css" />
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-md bg-light navbar-light">
      <a class="navbar-brand" href="postfeed.php">
        <img src="../layout/logo_transparent.png" width="200" alt="" class="d-inline-block align-middle mr-2">
      </a>
      <button class=" navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="postfeed.php" style="color: #6b359d;">Postfeed</a>
          </li>
          <li class="nav-item">
            <!-- <a class="nav-link" href="friends.php" style="color: #6b359d;">Friends</a> -->
            <a class="nav-link" href="http://localhost:4200" style="color: #6b359d;">Friends</a>
            <input type="hidden" ng-init="email='<?php echo $_SESSION['email']; ?>'">
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profile.php" style="color: #6b359d;">Profile</a>
          </li>
          <li class="nav-item">
            <form action="logout.php" method="post">
              <input type="submit" value="Log out" class="btn btn-purple" />
            </form>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</body>

</html>