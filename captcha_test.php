<?php
  session_start();
  header('Content-Type:text/html');
  $captcha = $_SESSION['captcha'];
  echo $captcha."\r\n";
  /*if($captcha == $_POST['captcha_text']){
    echo 'success';
 }
 else {
   $errors[] = 'incorrect captcha';
 }

   echo password_hash("rasmuslerdorf", PASSWORD_DEFAULT)."\n";
*/  ?>
