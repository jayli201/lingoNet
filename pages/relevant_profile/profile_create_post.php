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
  <h3>Introduce Yourself!</h3>
  <br />
  <form action="" method="post">
    <label>Personal Introduction: </label>
    <textarea name="introduction" id="introduction" class="form-control" rows="7" placeholder="Introduce yourself!" autofocus required></textarea>
    <br />

    <label>What You're Looking For: </label>
    <textarea name="lookingFor" id="lookingFor" class="form-control" rows="5" placeholder="What are you looking for in a language partner?" required></textarea>
    <br />

    <label>Why You?</label>
    <textarea name="whyYou" id="whyYou" class="form-control" rows="5" placeholder="How are you a great language partner?" required></textarea>
    <br />

    <input type="submit" name="action" id="action" value="Post!" class="btn btn-lg btn-purple" />
  </form>
</body>

</html>