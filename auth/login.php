<!-- ***************************************************************************************/
* Title: Bootstrap source code
* Author: Mark Otto, Jacob Thornton
* Date: 2021
* Code version: 4.6.0
* Availability: https://getbootstrap.com/
***************************************************************************************/ -->
<?php
require("../db/connectdb.php");
require("../sql/login_sql.php");

if (isset($_POST['action'])) {
  if (!empty($_POST['action']) && ($_POST['action'] == 'Login')) {
    $error = login($_POST['email'], $_POST['pwd']);
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Login">
  <meta name="author" content="Jasmin Li, Rebecca Zhou">

  <title>Login</title>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/layout.css" />
  <link rel="stylesheet" href="../css/content.css" />
  <link rel="stylesheet" href="../css/theme.css" />
</head>

<body>
  <div class="page-container">
    <div class="content-wrap">
      <div id="header"></div>
      <br />

      <div class="position-relative overflow-hidden p-3 p-md-5 m-md-2">
        <div class="form">
          <h1 class="display-4">Login</h1>
          <br />

          <div class="feedback">
            <?php echo $error; ?>
          </div>
          <br />

          <form id="fm-login" action="" method="post" onsubmit="return validateInput()">
            <div class="form-group">
              <label>Email: </label>
              <input type="text" name="email" id="email" class="form-control" autofocus required />
              <span class="feedback" id="email_msg"></span>
            </div>
            <br />

            <div class="form-group">
              <label>Password: </label>
              <input type="password" name="pwd" id="pwd" class="form-control" required />
              <br />
              <input type="checkbox" id="showPwd" /> Show password
            </div>
            <br />

            <input type="submit" name="action" id="action" value="Login" class="btn btn-lg btn-purple" />
          </form>
        </div>
      </div>
    </div>

    <br />
    <div id="footer"></div>

    <script src="../layout/welcome_layout.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <script>
      // runs as soon as this code is reached
      (function() {
        var pwd = document.getElementById("pwd");
        var showPwd = document.getElementById("showPwd");

        // when "show password" is checked
        showPwd.addEventListener("change", function() {
          try {
            // change to indicate user wants to see the password
            if (showPwd.checked)
              pwd.type = "text";
            // change to indicate user does not want to see the password
            else
              pwd.type = "password";
          } catch (error) {
            alert("Cannot switch type");
          }
        }, false);
      }());

      (function() {
        var pwd = document.getElementById("pwd");
        var submitBtn = document.getElementById("action");
        var submitted = false;
        submitBtn.disabled = true;
        submitBtn.className = "btn btn-lg btn-purple mt-2";

        // add an event listener to password - if password has been entered, enable the submit button 
        pwd.addEventListener("input", function() {
          try {
            submitBtn.disabled = false;
            submitBtn.className = "btn btn-lg btn-purple";
          } catch (error) {
            alert("Cannot switch type");
          }
        }, false);
      }());

      checkPattern = (str) => {
        // test if user input matches the standard email pattern		
        var pattern = new RegExp("^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$");
        var match_test = pattern.test(str);
        return match_test;
      }

      function validateInput() {
        var number_error = 0;

        // email validation
        var email = document.getElementById("email");
        if (!checkPattern(email.value)) {
          number_error++;
          document.getElementById("email").value = email.value;
          document.getElementById("email_msg").innerHTML = "Email must be valid.";
        } else
          document.getElementById("email_msg").innerHTML = "";

        // if there is an error, don't submit the form
        if (number_error > 0) {
          return false;
        } else {
          return true;
        }
      }
    </script>

</body>

</html>