<?php
require_once '../../beforeRequest.php';
require_once '../../models/Auth.php';

$method = $_SERVER['REQUEST_METHOD'];
if ($method === "POST") {
  if (
    isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['display_name']) &&
    !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['display_name'])
  ) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $displayName = $_POST['display_name'];
    
    if (Auth::register($username, $email, $pass, $displayName)) {
      echo json_encode(array("success" => true));
    } else {
      echo json_encode(array("success" => false));
    }
  } else {
    http_response_code(400);
    exit;
  }
} else if ($method !== "OPTIONS") {
  http_response_code(400);
  exit;
}
