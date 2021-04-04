<!-- ***************************************************************************************/
* Title: Bootstrap source code
* Author: Mark Otto, Jacob Thornton
* Date: 2021
* Code version: 4.6.0
* Availability: https://getbootstrap.com/
***************************************************************************************/ -->
<?php
require("../sql/friends_sql.php");
require("../sql/postfeed_sql.php");

$pendingFriends = getPendingFriends($_SESSION['email']);
$incomingFriends = getIncomingFriends($_SESSION['email']);

if (isset($_POST['acceptFriend'])) {
  acceptFriendRequest($_SESSION['email'], $_POST['friendEmail'], "accepted");
}

?>

<!DOCTYPE html>
<html>

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
          <h1 class="display-4">Friends</h1>
          <br />

          <div class="row ">
            <div class="col-sm-4 ">
              Pending Friend Requests

              <?php if (count($pendingFriends) == 0) : ?>
                <i> No pending friend requests </i>
              <?php endif ?>

              <?php foreach ($pendingFriends as $key => $value) : ?>

                <div class="card border border-purple">
                  <div class="card-body">
                    <h5 class="card-title">
                      <?= json_decode($value)->firstName ?>
                      <?= json_decode($value)->lastName ?>
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                      </svg>
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
                </br>

              <?php endforeach; ?>
            </div>

            <div class="col-sm-4">
              Incoming Friend Requests

              <?php if (count($incomingFriends) == 0) : ?>
                <i> No incoming friend requests </i>
              <?php endif ?>

              <?php foreach ($incomingFriends as $key => $value) : ?>

                <div class="card border border-purple">
                  <div class="card-body">
                    <h5 class="card-title">
                      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

                        <?= json_decode($value)->firstName ?>
                        <?= json_decode($value)->lastName ?>
                        <input type="hidden" name="friendEmail" id="friendEmail" value="<?= json_decode($value)->email ?>" />
                        <!-- Add friend button -->
                        <button type="submit" name="acceptFriend" class="btn btn-purple btn-sm">
                          <!-- https://icons.getbootstrap.com/icons/person-plus-fill/ -->
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                          </svg>
                        </button>
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
                </br>

              <?php endforeach; ?>

            </div>

            <div class="col-sm-4">
              Friends
              <div class="card border border-purple">
                <div class="card-body">
                  <h5 class="card-title">
                    Friend 1
                    <button type="button" class="btn btn-purple btn-sm">
                      <!-- Remove friend button -->
                      <!-- https://icons.getbootstrap.com/icons/person-dash-fill/ -->
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-dash-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11 7.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z" />
                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
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

              </br>

              <div class="card border border-purple">
                <div class="card-body">
                  <h5 class="card-title">
                    Friend 2
                    <button type="button" class="btn btn-purple btn-sm">
                      <!-- Remove friend button -->
                      <!-- https://icons.getbootstrap.com/icons/person-dash-fill/ -->
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-dash-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11 7.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z" />
                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
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
      </div>

      <br />
      <div id="footer"></div>
    </div>
  </div>

  <script src="../layout/layout.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  <script>
    const incomingFriends = [];
    const friends = [];

    // populate pendingFriends
    const person1 = {
      firstName: "Pending F1",
      lastName: "Pending L1",
      canSpeak: ["English", "Chinese"],
      wantToSpeak: ["Korean"]
    };

    const person2 = {
      firstName: 'Pending F2',
      lastName: 'Pending L2',
      canSpeak: ["English", "Chinese"],
      wantToSpeak: ["Korean"]
    };


    const pendingFriends = [person1, person2];


    pendingFriends.forEach((friend) => {
      var firstName = friend.firstName;
      var lastName = friend.lastName;
      console.log(friend);
      return friend;
    })


    function acceptFriendRequest() {
      console.log("accepted")
    }

    function deleteFriendRequest() {
      console.log("deleted")
    }
  </script>

</body>

</html>