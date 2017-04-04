<?php

  function sanitize(string $data ){
     global $db;
     $data = htmlentities(strip_tags(trim($data)),ENT_QUOTES);
     return $db->real_escape_string($data);
  }

  function logged_in() {
     return (isset($_SESSION['user_id']))?true:false;
  }


?>
