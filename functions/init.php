<?php
   //error_reporting(0);
   session_start();
   require 'database/connect.php';
   require 'function/sanitize.php';
   require 'function/users.php';


   if (logged_in()){
      $session_user_id = $_SESSION['user_id'];
      $user_data = user_data($session_user_id,'username','password');
      if (!user_active($user_data['username'])){
         session_destroy();
         header('Location:index.php');
         exit();
      }
   }

   $errors = array();

?>
