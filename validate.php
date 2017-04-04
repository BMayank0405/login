<?php
  session_start();
  header('Content-Type:text/html');
  require_once './functions/init.php';
  require_once './functions/function.php';
  require_once './functions/landing.php';
  $test_captcha = $_SESSION['captcha'];
  $one = '1';
  $zero = '0';
  if (key($_POST) == 'password'){
    $password = $_POST['password'];
    if(password_verify($password ,$db_pass)){
        echo $one;
    }
    else {
        echo $zero;
    }
  }

  if (key($_POST) == 'username'){
    $username = sanitize($_POST['username']);
    if($username == $db_user){
        echo $one;
    }
    else {
        echo $zero;
    }
  }

  if (key($_POST) == 'captcha'){
    $captcha = sanitize($_POST['captcha']);
    if($captcha == $test_captcha){
        echo $one;
    }
    else {
        echo $zero;
    }
  }

?>
