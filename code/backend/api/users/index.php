<?php 
  include_once '../../beforeRequest.php';
  include_once '../../models/User.php';
  include_once '../../isAuthed.php';

  $method = $_SERVER['REQUEST_METHOD'];
  if($method == "GET") {
    echo(json_encode(User::getUser($user_id)));
  } else if ($method == "POST") {
    
  }
?>