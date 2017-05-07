<?php
session_start();
require_once './functions/init.php';
require_once './functions/function.php';
logged_in_redirect();

?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Elastic Login Form</title>
  <link rel="stylesheet"  href="css/base.css">
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"
          integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
          crossorigin="anonymous">
  </script>
</head>
<body>
  <div id="bg-img">
    <header>
    <h1>EvenCargo</h1>
    </header>
    <div class="container ">
      <div class="profile">
        <button class="profile__avatar fixtop" id="toggleProfile">
          <img src="./images/even.png" alt="Avatar" />
        </button>

        <form method="POST" action="lan.php" autocomplete="off" id="form">
          <div class="profile__form">
            <div class="profile__fields">
              <div class="field username">
                <input type="text" id="fieldUser" class="input" required pattern=.*\S.* name="username"/>
                <label for="fieldUser" class="label"><img src="./images/usrname.png" style="width:25px;height:25px"/>Username </label>

              </div>

              <div class="field pass">
                <input type="password" id="fieldPassword" class="input" required pattern=.*\S.* minlength="6" name="password"/>
                <label for="fieldPassword" class="label"><img src="./images/pass.png" style="width:25px;height:25px"/>Password </label>
                <div></div>
              </div>

              <img src="captcha.php" width="120" height="32" id="captcha">

              <div class="field pass reload ">
                <input type="button"  onclick="getcaptcha();" class="btn" value="Reload Captcha"/>
              </div>
              <div class="field  captcha">
                <input type="text" id="fieldCaptcha" class="input" required pattern=.*\S.* maxlength="6" name="captcha"/>
                <label for="fieldCaptcha" class="label">Captcha </label>
                <div class="errors"></div>
              </div>

              <div class="profile__footer">
                <input type="submit" name="submit_form" value="Login" class="btn fade" hidden/>
              </div>
          </div>
        </form>
      </div>

    </div>
  </div>

</div>

<!--Google Font -->
<link href="https://fonts.googleapis.com/css?family=Droid+Serif:700|Sorts+Mill+Goudy:400i" rel="stylesheet" />

<script src="index.js"></script>
</body>
</html>
