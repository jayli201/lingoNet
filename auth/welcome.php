<!-- ***************************************************************************************/
* Title: Bootstrap source code
* Author: Mark Otto, Jacob Thornton
* Date: 2021
* Code version: 4.6.0
* Availability: https://getbootstrap.com/
***************************************************************************************/ -->

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Welcome to LingoNet">
  <meta name="author" content="Jasmin Li, Rebecca Zhou">

  <title>Welcome to LingoNet</title>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/welcome.css" />
  <link rel="stylesheet" href="../css/theme.css" />
  <link rel="stylesheet" href="../css/content.css" />
  <link rel="stylesheet" href="../css/layout.css" />
</head>

<body>

  <div class="page-container">
    <div class="content-wrap">
      <div id="header"></div>
      <br />

      <div class="welcome-content text-center">
        <div>
          <h1 class="display-2">LingoNet</h1>
          <hr />
          <p class=" lead font-weight-normal">Find a language partner, practice with native speakers and make
            friends!
          </p>
          <br />
          <a class="btn btn-purple btn-lg" href="signup.php" role="button">Sign Up Now</a>
        </div>

        <div class="box-1-welcome box"></div>
        <div class="box-2-welcome box"></div>
        <div class="box-3-welcome box"></div>
      </div>

      <br />
      <div id="footer"></div>
    </div>
  </div>

  <script src="../layout/welcome_layout.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>