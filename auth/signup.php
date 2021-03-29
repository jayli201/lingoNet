<!-- ***************************************************************************************/
* Title: Bootstrap source code
* Author: Mark Otto, Jacob Thornton
* Date: 2021
* Code version: 4.6.0
* Availability: https://getbootstrap.com/
***************************************************************************************/ -->
<?php
require("../db/connectdb.php");
require("../sql/signup_sql.php");

if (isset($_POST['action'])) {
  if (!empty($_POST['action']) && ($_POST['action'] == 'Sign Up')) {
    $error = signUp($_POST['email'], $_POST['pwd'], $_POST['firstName'], $_POST['lastName'], $_POST['age'], $_POST['phone']);
  }
}
?>

<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Sign Up">
  <meta name="author" content="Jasmin Li, Rebecca Zhou">

  <title>Sign Up</title>
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

      <div class="form">
        <h1 class="display-4">Sign Up</h1>
        <form id="fm-login" name="SignUpForm" action="" method="post" onsubmit="return validateInput()">
          <div class="form-group">
            <label>Email: </label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Enter your email" autofocus required />
            <span class="feedback" id="email_msg"></span>
          </div>
          <br />

          <div class="form-group">
            <label>Password: </label>
            <div id="pwd-msg" class="feedback"></div>
            <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Enter your password" required />
          </div>
          <div class="form-group">
            <input type="checkbox" id="showPwd" /> Show password
          </div>
          <br />

          <div class="form-group">
            <label>Confirm Password: </label>
            <div id="pwd-confirm-msg" class="feedback"></div>
            <input type="password" name="confirm_pwd" id="confirm_pwd" class="form-control" placeholder="Re-enter your password" required />
          </div>
          <div class="form-group">
            <input type="checkbox" id="showConfirmPwd" /> Show password
            <div>
              <span class="feedback" id="pwd_msg"></span>
            </div>
          </div>
          <br />

          <div class="form-group">
            <label>First Name: </label>
            <input type="text" name="firstName" id="firstName" class="form-control" placeholder="Enter your first name" required />
          </div>
          <br />

          <div class="form-group">
            <label>Last Name: </label>
            <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Enter your last name" required />
          </div>
          <br />

          <div class="form-group">
            <label>Phone Number: </label>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter your phone number" required />
            <span class="feedback" id="phone_msg"></span>
          </div>
          <br />

          <div class="form-group">
            <label>Age: </label>
            <input type="text" name="age" id="age" class="form-control" placeholder="Enter your age" required />
            <span class="feedback" id="age_msg"></span>
          </div>
          <br />

          <div class="form-group">
            <label>Language of Profiency: </label>
            <input type="text" name="native" id="native" class="form-control" placeholder="Enter your language of profiency" required />
          </div>
          <br />

          <div class="form-group">
            <label>Target Language: </label>
            <input type="text" name="target" id="target" class="form-control" placeholder="Enter your target language" required />
          </div>

          <div class="feedback"><?php echo $error; ?></div>
          <br />

          <input type="submit" name="action" id="action" value="Sign Up" class="btn btn-purple" />
        </form>
      </div>

      <br />
      <div id="footer"></div>
    </div>
  </div>

  <script src="../layout/welcome_layout.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  <script>
    // runs as soon as this code is reached
    (function() {
      var pwd = document.getElementById("pwd");
      var showPwd = document.getElementById("showPwd");

      var confirmPwd = document.getElementById("confirm_pwd");
      var showConfirmPwd = document.getElementById("showConfirmPwd");

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

      // when "show password" is checked
      showConfirmPwd.addEventListener("change", function() {
        try {
          // change to indicate user wants to see the password
          if (showConfirmPwd.checked)
            confirm_pwd.type = "text";
          // change to indicate user does not want to see the password
          else
            confirm_pwd.type = "password";
        } catch (error) {
          alert("Cannot switch type");
        }
      }, false);
    }());

    isInt = (str) => {
      var val = parseInt(str);
      return (val > 0);
    }

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

      // password validation - both passwords have to match
      var pwd1 = document.getElementById("pwd").value.trim();
      var pwd2 = document.getElementById("confirm_pwd").value.trim();

      if (pwd1 !== pwd2) {
        number_error++;
        document.getElementById("pwd_msg").innerHTML = "Passwords do not match.";
      } else
        document.getElementById("pwd_msg").innerHTML = "";

      // phone validation - integer
      var phone = document.getElementById("phone");
      if (!isInt(phone.value)) {
        number_error++;
        document.getElementById("phone").value = phone.value;
        document.getElementById("phone_msg").innerHTML = "Phone must be an integer.";
      } else
        document.getElementById("phone_msg").innerHTML = "";

      // age validation - integer and at least 13 years old
      var age = document.getElementById("age");
      if (!isInt(age.value)) {
        number_error++;
        document.getElementById("age").value = age.value;
        document.getElementById("age_msg").innerHTML = "Age must be an integer.";
      } else if (age.value < 13) {
        number_error++;
        document.getElementById("age").value = age.value;
        document.getElementById("age_msg").innerHTML = "You must be at least 13 years old.";
      } else
        document.getElementById("age_msg").innerHTML = "";

      // if there is an error, don't submit the form
      if (number_error > 0) {
        return false;
      } else
        return true;
    }
  </script>

</body>

</html>