<!-- ***************************************************************************************/
* Title: Bootstrap source code
* Author: Mark Otto, Jacob Thornton
* Date: 2021
* Code version: 4.6.0
* Availability: https://getbootstrap.com/
***************************************************************************************/ -->

<!DOCTYPE html>
<html>

<body>
  <?php
  // if user has not logged in, then redirect
  // otherwise, display content 
  if (!isset($_SESSION['email'])) {
    header("Location: ../../auth/welcome.php");
  } else
  ?>

  <div class="card border border-purple">
    <div class="card-header">
      <div class="row">
        <div class="col-9">
          <h4>
            Native Languages
          </h4>
        </div>
        <div class="col-3 text-right">
          <button class="btn btn-purple btn-sm" data-toggle="modal" data-target="#nativeModal">+</button>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="modal fade" id="nativeModal" tabindex="-1" role="dialog" aria-labelledby="nativeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <div class="col-9">
                <h5>
                  Add Native Languages
                </h5>
              </div>
              <div class="col-3" style="text-align: right;">
                <input type="button" class="btn btn-purple btn-sm" id="addNativeRow" value="+" />
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
            <div class="modal-body">
              <form action="" method="post">
                <table id="natives" class="table list-native">
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
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <input type="submit" name="addNative" id="addNative" class="btn btn-purple" value="Add languages" />
            </div>
          </div>
          </form>
        </div>
      </div>

      <table class="table">
        <tbody>
          <?php
        foreach ($language_info['native'] as $native) { ?>
            <tr>
              <td><?php echo $native ?></td>
              <td style="text-align: right">
                <form action="" method="post">
                  <input type="hidden" name="native" id="native" value="<?= $native ?>" />
                  <button type="submit" name="deleteNative" id="deleteNative" class="btn btn-danger btn-sm" value="Delete Native">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                      <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                    </svg>
                  </button>
                </form>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <hr />

  <div class="card border border-purple">
    <div class="card-header">
      <div class="row">
        <div class="col-9">
          <h4>
            Target Languages
          </h4>
        </div>
        <div class="col-3 text-right">
          <button class="btn btn-purple btn-sm" data-toggle="modal" data-target="#targetModal">+</button>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="targetModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <div class="col-9">
                <h5>
                  Add Target Languages
                </h5>
              </div>
              <div class="col-3" style="text-align: right;">
                <input type="button" class="btn btn-purple btn-sm" id="addTargetRow" value="+" />
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
            <div class="modal-body">
              <form action="" method="post">
                <table id="targets" class="table list-target">
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
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <input type="submit" name="addTarget" id="addTarget" class="btn btn-purple" value="Add languages" />
            </div>
          </div>
          </form>
        </div>
      </div>

      <table class="table">
        <tbody>
          <?php
          foreach ($language_info['target'] as $target) { ?>
            <tr>
              <td><?php echo $target ?></td>
              <td style="text-align: right">
                <form action="" method="post">
                  <input type="hidden" name="target" id="target" value="<?= $target ?>" />
                  <button type="submit" name="deleteTarget" id="deleteTarget" class="btn btn-danger btn-sm" value="Delete Target">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                      <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                    </svg>
                  </button>
                </form>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>

    </div>
  </div>

  <script>
    $(document).ready(function() {
      $("#addNativeRow").on("click", function() {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="text" name="native[]" id="native" class="form-control" placeholder="Enter a language of profiency"/></td>';
        cols += '<td><button type="submit" class="ibtnDel btn btn-sm btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"> <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" /></svg></td>';

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
        cols += '<td><button type="submit" class="ibtnDel btn btn-sm btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"> <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" /></svg></td>';

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