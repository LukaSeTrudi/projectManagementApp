<?php
require_once '../../beforeRequest.php';
require_once '../../models/Auth.php';

$method = $_SERVER['REQUEST_METHOD'];
if ($method === "POST") {
  if (
    isset($_POST['userMail']) && isset($_POST['password'])  &&
    !empty($_POST['userMail']) && !empty($_POST['password'])
  ) {
    $userMail = $_POST['userMail'];
    $pass = $_POST['password'];
    
    $response = Auth::login($userMail, $pass);
    echo json_encode($response);
  } else {
    http_response_code(400);
    exit;
  }
} else if ($method !== "OPTIONS") {
  http_response_code(400);
  exit;
}
