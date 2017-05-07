<?php
  $db = new mysqli('127.0.0.1','root','','final');
   if($db->errno){
      die('sorry we are offline');
   }

?>
