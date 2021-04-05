<!-- ***************************************************************************************/
* Title: Bootstrap source code
* Author: Mark Otto, Jacob Thornton
* Date: 2021
* Code version: 4.6.0
* Availability: https://getbootstrap.com/
***************************************************************************************/ -->
<?php
if (isset($_POST['editProfile'])) {
  if (!empty($_POST['editProfile']) && ($_POST['editProfile'] == 'Save changes')) {
    editProfileInfo($_SESSION['email'], $_POST['editedFirstName'], $_POST['editedLastName'], $_POST['editedAge'], $_POST['editedPhone']);
  }
}
?>

<!DOCTYPE html>
<html>

<body>

  <div class="card border border-purple">
    <div class="card-body">
      <h5 class="card-title">
        <?php echo $profile_info['firstName'] . " " . $profile_info['lastName']; ?>
        <button class="btn btn-purple btn-sm" data-toggle="modal" data-target="#profileModal">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
          </svg>
        </button>
      </h5>

      <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="profileModalLabel">Edit Profile</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post" onsubmit="return validateEditProfile()">
                <table class="table">
                  <tbody>
                    <tr>
                      <td>First Name</td>
                      <td><input type="text" name="editedFirstName" id="editedFirstName" class="form-control" value=<?php echo $profile_info['firstName']; ?> required /></td>
                    </tr>
                    <tr>
                    <tr>
                      <td>Last Name</td>
                      <td><input type="text" name="editedLastName" id="editedLastName" class="form-control" value=<?php echo $profile_info['lastName']; ?> required /></td>
                    </tr>
                    <tr>
                      <td>Age</td>
                      <td><input type="text" name="editedAge" id="editedAge" class="form-control" value=<?php echo $profile_info['age']; ?> required /></td>
                    </tr>
                    <tr>
                      <td>Phone Number</td>
                      <td><input type="text" name="editedPhone" id="editedPhone" class="form-control" value=<?php echo $profile_info['phone']; ?> required /></td>
                    </tr>
                  </tbody>
                </table>
                <span class="feedback" id="edit_age_msg"></span>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <input type="submit" name="editProfile" id="editProfile" class="btn btn-purple" value="Save changes" />
            </div>
          </div>
          </form>
        </div>
      </div>

      <table class="table">
        <tbody>
          <tr>
            <td>Email</td>
            <td><?php echo $profile_info['email']; ?></td>
          </tr>
          <tr>
            <td>Age</td>
            <td><?php echo $profile_info['age']; ?></td>
          </tr>
          <tr>
            <td>Phone Number</td>
            <td><?php echo $profile_info['phone']; ?></td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>
</body>

<script>
  // Phone validation code from:
  // https://stackoverflow.com/questions/30058927/format-a-phone-number-as-a-user-types-using-pure-javascript
  $('#editedPhone').keyup(function(e) {
    var formattedPhone = this.value.replace(/\D/g, '').substring(0, 10);
    var deleteKey = (e.keyCode == 8 || e.keyCode == 46);
    var len = formattedPhone.length;
    if (len == 0) {
      formattedPhone = formattedPhone;
    } else if (len < 3) {
      formattedPhone = '(' + formattedPhone;
    } else if (len == 3) {
      formattedPhone = '(' + formattedPhone + (deleteKey ? '' : ') ');
    } else if (len < 6) {
      formattedPhone = '(' + formattedPhone.substring(0, 3) + ') ' + formattedPhone.substring(3, 6);
    } else if (len == 6) {
      formattedPhone = '(' + formattedPhone.substring(0, 3) + ') ' + formattedPhone.substring(3, 6) + (deleteKey ? '' : '-');
    } else {
      formattedPhone = '(' + formattedPhone.substring(0, 3) + ') ' + formattedPhone.substring(3, 6) + '-' + formattedPhone.substring(6, 10);
    }
    this.value = formattedPhone;
  });

  isInt = (str) => {
    var val = parseInt(str);
    return (val > 0);
  }

  function validateEditProfile() {
    var number_error = 0;

    // age validation - integer and at least 13 years old
    var age = document.getElementById("editedAge");
    if (!isInt(age.value)) {
      number_error++;
      document.getElementById("editedAge").value = age.value;
      document.getElementById("edit_age_msg").innerHTML = "Age must be an integer.";
    } else if (age.value < 13) {
      number_error++;
      document.getElementById("editedAge").value = age.value;
      document.getElementById("edit_age_msg").innerHTML = "You must be at least 13 years old.";
    } else
      document.getElementById("edit_age_msg").innerHTML = "";

    // if there is an error, don't submit the form
    if (number_error > 0) {
      return false;
    } else
      return true;
  }
</script>

</html>