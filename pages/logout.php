<!DOCTYPE html>
<html>

<body>

  <?php
  require("../db/connectdb.php");

  if (count($_SESSION) > 0) {
    foreach ($_SESSION as $k => $v) {
      unset($_SESSION[$k]);
    }
    session_destroy();

    // remove everything from cookies
    setcookie("PHPSESSID", "", time() - 3600, "/");

    // redirect to home page
    header('Location: ../auth/welcome.html');
  }
  ?>

</body>

</html>