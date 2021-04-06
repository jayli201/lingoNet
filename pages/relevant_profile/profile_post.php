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
  <h3>Your Introductory Post</h3>
  <br />
  <div class="card border border-purple">
    <div class="card-body">
      <h5 class="card-title">
        Introductory Post
        <button class="btn btn-purple btn-sm" data-toggle="modal" data-target="#postModal">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
          </svg>
        </button>
      </h5>

      <div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="postModalLabel">Edit Post</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
                <table class="table">
                  <tbody>
                    <tr>
                      <td>Introduction</td>
                      <td><textarea name="editedIntro" id="editedIntro" class="form-control" rows=5 required><?php echo $post_info['introduction']; ?></textarea>
                    </tr>
                    <tr>
                    <tr>
                      <td>What You're Looking For</td>
                      <td><textarea name="editedLookingFor" id="editedLookingFor" class="form-control" rows=5 required><?php echo $post_info['lookingFor']; ?></textarea></td>
                    </tr>
                    <tr>
                      <td>Why You?</td>
                      <td><textarea name="editedWhyYou" id="editedWhyYou" class="form-control" rows=5 required><?php echo $post_info['whyYou']; ?></textarea></td>
                    </tr>
                  </tbody>
                </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <input type="submit" name="editPost" id="editPost" class="btn btn-purple" value="Save changes" />
            </div>
          </div>
          </form>
        </div>
      </div>

      <table class="table">
        <tbody>
          <tr>
            <td>Introduction</td>
            <td><?php echo $post_info['introduction']; ?></td>
          </tr>
          <tr>
            <td>Looking For</td>
            <td><?php echo $post_info['lookingFor']; ?></td>
          </tr>
          <tr>
            <td>Why You?</td>
            <td><?php echo $post_info['whyYou']; ?></td>
          </tr>
        </tbody>
      </table>

      <div class="card-footer bg-transparent">
        <form action="" method="post">
          <button type="submit" name="deletePost" id="deletePost" class="btn btn-danger" value="Delete Post">Delete Post
            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
              </svg> -->
          </button>
        </form>
      </div>

    </div>
  </div>
</body>

</html>