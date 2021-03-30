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
    $error = signUpCont($_SESSION['email'], $_SESSION['pwd'], $_SESSION['firstName'], $_SESSION['lastName'], $_SESSION['age'], $_SESSION['phone'], $_POST['native'], $_POST['target']);
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

      <div class="position-relative overflow-hidden p-3 p-md-5 m-md-2">
        <div class="form">
          <h1 class="display-4">Sign Up</h1>
          <br />
          <br />

          <form action="" method="post">
            <table id="natives" class="table list-native">
              <thead>
                <tr>
                  <td>
                    <h4>Native Language</h4>
                  </td>
                  <td style="text-align: left;">
                    <input type="button" class="btn btn-purple " id="addNativeRow" value="+" />
                  </td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="col-sm-4">
                    <input type="text" name="native[]" id="native" class="form-control" placeholder="Enter a language of profiency" autofocus required />
                  </td>
                  <td class="col-sm-2"><a class="deleteNativeRow"></a>
                  </td>
                </tr>
              </tbody>
            </table>

            <br />
            <hr />
            <br />

            <table id="targets" class="table list-target">
              <thead>
                <td>
                  <h4>Target Language</h4>
                </td>
                <td style="text-align: left;">
                  <input type="button" class="btn btn-purple " id="addTargetRow" value="+" required />
                </td>
              </thead>
              <tbody>
                <tr>
                  <td class="col-sm-4">
                    <input type="text" name="target[]" id="target" class="form-control" placeholder="Enter a language of interest" />
                  </td>
                  <td class="col-sm-2"><a class="deleteTargetRow"></a>
                  </td>
                </tr>
              </tbody>
            </table>
            <br />

            <div class="row">
              <div class="col-9">
                <input type="submit" name="action" id="action" value="Sign Up" class="btn btn-lg btn-purple" />
              </div>
              <div class="col">
                <button type="button" class="btn btn-outline-purple" onclick="goBack()">Go Back</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <br />
      <div id="footer"></div>
    </div>
  </div>

  <script src="../layout/welcome_layout.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  <!-- following script inspired by https://bootsnipp.com/snippets/402bQ -->
  <script>
    function goBack() {
      window.history.back();
    }

    $(document).ready(function() {
      $("#addNativeRow").on("click", function() {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="text" name="native[]" id="native" class="form-control" placeholder="Enter a language of profiency"/></td>';
        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger" value="X"></td>';

        newRow.append(cols);
        $("table.list-native").append(newRow);
      });

      $("table.list-native").on("click", ".ibtnDel", function(event) {
        $(this).closest("tr").remove();
      });
    });

    $(document).ready(function() {
      $("#addTargetRow").on("click", function() {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="text" name="target[]" id="target" class="form-control" placeholder="Enter a language of interest"/></td>';
        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger" value=X></td>';

        newRow.append(cols);
        $("table.list-target").append(newRow);
      });

      $("table.list-target").on("click", ".ibtnDel", function(event) {
        $(this).closest("tr").remove();
      });
    });
  </script>

</body>

</html>