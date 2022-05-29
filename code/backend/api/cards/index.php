<?php
include_once '../../beforeRequest.php';
include_once '../../models/Card.php';
include_once '../../isAuthed.php';
include_once '../../models/Board.php';

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "POST" && isset($_POST['request_type'])) {
  $requestType = $_POST['request_type'];
  switch ($requestType) {
    case "create":
      if (
        isset($_POST['title']) && isset($_POST['order_num']) &&
        isset($_POST['list_id']) && isset($_POST['due_date']) &&
        isset($_POST['description'])
      ) {
        $title = $_POST['title'];
        $order_num = $_POST['order_num'];
        $list_id = $_POST['list_id'];
        $desc = $_POST['description'];
        $due_date = $_POST['due_date'];
        $id = Card::create($title, $desc, $due_date, $list_id, $order_num);
        echo ($id);
      } else {
        http_response_code(400);
        exit;
      }
      break;
    case "update":
      if (
        isset($_POST['title']) &&
        isset($_POST['list_id']) && isset($_POST['due_date']) &&
        isset($_POST['description']) && isset($_POST['card_id'])
      ) {
        $title = $_POST['title'];
        $list_id = $_POST['list_id'];
        $desc = $_POST['description'];
        $due_date = $_POST['due_date'];
        $card_id = $_POST['card_id'];
        $id = Card::update($card_id, $title, $desc, $due_date, $list_id);
        echo ($id);
      } else {
        http_response_code(400);
        exit;
      }
      break;
    case "delete":
      if (isset($_POST['id'])) {
        $id = $_POST['id'];
        Card::delete($id);
        echo ("OK");
      } else {
        http_response_code(400);
        exit;
      }
      break;
  }
} else {
  http_response_code(400);
  exit;
}
