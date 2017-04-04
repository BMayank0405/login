<?php

  $result = $db->query("SELECT `id`,`username`,`password` FROM `user` WHERE `id` = 1");
  try{
    if($result){
      while($row = $result->fetch_row()){
        $db_id = $row[0];
        $db_user = $row[1];
        $db_pass = $row[2];
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
