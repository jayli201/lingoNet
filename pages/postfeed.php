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
  <meta name="description" content="Postfeed">
  <meta name="author" content="Jasmin Li, Rebecca Zhou">

  <title>Postfeed</title>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
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
          <h1 class="display-4">Postfeed</h1>

          <div class="form">
            <form id="search_form" method="post" onsubmit="getSearchResults()">
              <!-- <input type="text" id="search_input" class="form-control" autofocus /> -->

              <div class="input-group">
                <input style="margin-right: 1em;" type="text" id="search_input" class="form-control" autofocus />
                <span class="input-group-btn">
                  <input type="submit" value="Search" class="btn btn-purple" />
                </span>
              </div>

            </form>
          </div>
          <br />

          <div class="card-deck">
            <div class="card border border-purple">

              <div class="card-body">
                <h5 class="card-title">
                  Rebecca Zhou
                  <button type="button" class="btn btn-purple btn-sm">
                    <!-- Add friend button -->
                    <!-- https://icons.getbootstrap.com/icons/person-plus-fill/ -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                      <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                      <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                    </svg>
                  </button>
                </h5>
                <h6 class="card-subtitle mb-2">Can speak: </h6>
                <p> English, Chinese </p>
                <h6 class="card-subtitle mb-2 ">Want to practice: </h6>
                <p> Korean </p>
              </div>
              <div class="card-footer">
                <a href="#" class="card-link">More info</a>
              </div>
            </div>

            <div class="card border border-purple">
              <div class="card-body">
                <h5 class="card-title">
                  Jasmin Li
                  <button type="button" class="btn btn-purple btn-sm">
                    <!-- Add friend button -->
                    <!-- https://icons.getbootstrap.com/icons/person-plus-fill/ -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                      <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                      <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                    </svg>
                  </button>
                </h5>
                <h6 class="card-subtitle mb-2">Can speak: </h6>
                <p> English, Chinese </p>
                <h6 class="card-subtitle mb-2 ">Want to practice: </h6>
                <p> Korean </p>
              </div>
              <div class="card-footer">
                <a href="#" class="card-link">More info</a>
              </div>
            </div>

            <div class="card border border-purple">
              <div class="card-body">
                <h5 class="card-title">
                  User 1
                  <button type="button" class="btn btn-purple btn-sm">
                    <!-- Add friend button -->
                    <!-- https://icons.getbootstrap.com/icons/person-plus-fill/ -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                      <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                      <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                    </svg>
                  </button>
                </h5>
                <h6 class="card-subtitle mb-2">Can speak: </h6>
                <p> English, Chinese </p>
                <h6 class="card-subtitle mb-2 ">Want to practice: </h6>
                <p> Korean </p>
              </div>
              <div class="card-footer">
                <a href="#" class="card-link">More info</a>
              </div>
            </div>
          </div>

          <br />

          <div class="card-deck">
            <div class="card border border-purple">

              <div class="card-body">
                <h5 class="card-title">
                  User 2
                  <button type="button" class="btn btn-purple btn-sm">
                    <!-- Add friend button -->
                    <!-- https://icons.getbootstrap.com/icons/person-plus-fill/ -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                      <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                      <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                    </svg>
                  </button>
                </h5>
                <h6 class="card-subtitle mb-2">Can speak: </h6>
                <p> English, Chinese </p>
                <h6 class="card-subtitle mb-2 ">Want to practice: </h6>
                <p> Korean </p>
              </div>
              <div class="card-footer">
                <a href="#" class="card-link">More info</a>
              </div>
            </div>

            <div class="card border border-purple">
              <div class="card-body">
                <h5 class="card-title">
                  User 3
                  <button type="button" class="btn btn-purple btn-sm">
                    <!-- Add friend button -->
                    <!-- https://icons.getbootstrap.com/icons/person-plus-fill/ -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                      <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                      <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                    </svg>
                  </button>
                </h5>
                <h6 class="card-subtitle mb-2">Can speak: </h6>
                <p> English, Chinese </p>
                <h6 class="card-subtitle mb-2 ">Want to practice: </h6>
                <p> Korean </p>
              </div>
              <div class="card-footer">
                <a href="#" class="card-link">More info</a>
              </div>
            </div>

            <div class="card border border-purple">
              <div class="card-body">
                <h5 class="card-title">
                  User 4
                  <button type="button" class="btn btn-purple btn-sm">
                    <!-- Add friend button -->
                    <!-- https://icons.getbootstrap.com/icons/person-plus-fill/ -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                      <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                      <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                    </svg>
                  </button>
                </h5>
                <h6 class="card-subtitle mb-2">Can speak: </h6>
                <p> English, Chinese </p>
                <h6 class="card-subtitle mb-2 ">Want to practice: </h6>
                <p> Korean </p>
              </div>
              <div class="card-footer">
                <a href="#" class="card-link">More info</a>
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
  <!-- <script src="postfeed.js"></script> -->

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  <script>
    function getSearchResults() {
      search_input = document.getElementById("search_input").value;
      alert("You entered: " + search_input);
      console.log(search_input);
    }
  </script>

</body>

</html>