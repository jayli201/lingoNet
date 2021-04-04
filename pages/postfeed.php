<!-- ***************************************************************************************/
* Title: Bootstrap source code
* Author: Mark Otto, Jacob Thornton
* Date: 2021
* Code version: 4.6.0
* Availability: https://getbootstrap.com/
***************************************************************************************/ -->
<?php
require("../sql/postfeed_sql.php");
$user_info_array = getPostfeedInfo();
$arr_len = count($user_info_array);

if (isset($_POST['addFriend'])) {
  addFriendtoPending($_SESSION['email'], $_POST['friendEmail']);
}
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
              <div class="input-group">
                <input style="margin-right: 1em;" type="text" id="search_input" class="form-control" autofocus />
                <span class="input-group-btn">
                  <input type="submit" value="Search" class="btn btn-purple" />
                </span>
              </div>
            </form>
          </div>
          <br />

          <?php $count = 0; ?>
          <?php foreach ($user_info_array as $key => $value) : ?>

            <?php if ($count % 3 == 0) : ?>
              <div class="card-deck">
              <?php endif; ?>

              <div class="card border border-purple">
                <div class="card-body">
                  <h5 class="card-title">

                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                      <?= json_decode($value)->firstName ?>
                      <?= json_decode($value)->lastName ?>
                      <input type="hidden" name="firstName" id="firstName" value="<?= json_decode($value)->firstName ?>" />
                      <input type="hidden" name="lastName" id="lastName" value="<?= json_decode($value)->lastName ?>" />
                      <input type="hidden" name="friendEmail" id="friendEmail" value="<?= json_decode($value)->email ?>" />

                      <!-- if in pending pending, display pending icon -->
                      <?php if (isPendingFriend($_SESSION['email'], json_decode($value)->email)) : ?>
                        <!-- https://icons.getbootstrap.com/icons/person-lines-fill/ -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                          <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                        </svg>

                        <!-- if in friend table, display accepted icon  -->
                      <?php elseif (isAcceptedFriend($_SESSION['email'], json_decode($value)->email)) : ?>
                        <!-- https://icons.getbootstrap.com/icons/person-check-fill/ -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check-fill" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                          <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                        </svg>

                        <!-- else if not in pending or friend table, then display addFriend button -->
                      <?php else : ?>
                        <!-- Add friend button -->
                        <button type="submit" name="addFriend" class="btn btn-purple btn-sm">
                          <!-- https://icons.getbootstrap.com/icons/person-plus-fill/ -->
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                          </svg>
                        </button>
                      <?php endif; ?>

                    </form>
                  </h5>
                  <h6 class="card-subtitle mb-2">Can speak: </h6>
                  <p><?= json_decode($value)->native ?>

                  <h6 class="card-subtitle mb-2 ">Want to practice: </h6>
                  <p><?= json_decode($value)->target ?>
                </div>
                <div class="card-footer">
                  <a href="#" class="card-link">More info</a>
                </div>
              </div>

              <?php if (($count % 3 == 2) || $count == $arr_len - 1) : ?>
              </div>
              </br>
            <?php endif; ?>
            <?php $count++ ?>
          <?php endforeach; ?>

        </div>
      </div>

      <br />
      <div id="footer"></div>
    </div>
  </div>

  <script src="../layout/layout.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  <script>
    function getSearchResults() {
      search_input = document.getElementById("search_input").value;
      alert("You entered: " + search_input);
      console.log(search_input);
    }

    // if want to use jQuery:
    // https://stackoverflow.com/questions/20543722/ajax-post-within-jquery-onclick
  </script>

</body>

</html>