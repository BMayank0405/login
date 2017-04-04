<?php

//for making sure that we allow access to only signed in users on the page on which this function is called
 function protect_page() {
   if( !logged_in()){
     header('Location: index.html');
     exit();
   }
 }
  function login(string $username , $password){
    global $errors,$db;
    if(!user_id ($username)){
       $errors[]= 'you have entered incorrect user name or password';
       die();
    }
    else {
       $user_id = user_id($username);
       $password = md5($password);
       $result = $db->query("SELECT `user_id` FROM `users` WHERE `username`= '$username' AND `password` = '$password'");
       $row = $result->fetch_row();
       if ($result->num_rows)
          return $user_id;
       else return false;
    }
 }

 //if user is logged in different page will be shown to the user



  function user_exists(string $username):bool
     {
        $user_id = user_id($username);
        if($user_id)
           return true;
        else
           return false;
   }

   function user_id (string $username):int{
      global $db;
      $result = $db->query("SELECT `user_id` FROM `users` WHERE `username`= '$username'");
      $row = $result->fetch_row();
      if ($result->num_rows ) //this check whether any row is returned from the query
         return $row[0];
      else return 0;
   }

?>
