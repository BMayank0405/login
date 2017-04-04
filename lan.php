<?php
  session_start();
  require_once './functions/init.php';
  $username = sanitize($_POST['username']);
  $result = $db->query("SELECT `id` FROM `user` WHERE `username`='$username'");
  try{
  if($result){
    while($row = $result->fetch_row()){
      $_SESSION['user_id'] = $row[0];
    }
  }
  else{
    throw new Exception('Internal error Occured');
  }
  }
  catch(Exception $ex){
    echo $ex->getMessage();
    echo "\r\n";
  }
?>
