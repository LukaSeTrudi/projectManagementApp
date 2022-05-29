<?php
include_once 'beforeRequest.php';
include_once 'models/JWT.php';

if (isset($_SERVER["HTTP_AUTHORIZATION"])) {
  $auth = $_SERVER["HTTP_AUTHORIZATION"];
  $token = explode(" ", $auth)[1];
  $user_id = JWT::is_jwt_valid($token);
  if($user_id == FALSE) {
    http_response_code(401);
    exit;  
  }
} else {
  http_response_code(401);
  exit;
}
