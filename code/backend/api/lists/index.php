<?php
include_once '../../beforeRequest.php';
include_once '../../models/List.php';
include_once '../../isAuthed.php';

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "POST" && isset($_POST['request_type'])) {
  $requestType = $_POST['request_type'];
  switch($requestType) {
    case "create":
      if(isset($_POST['name']) && isset($_POST['order_num']) && isset($_POST['board_id'])) {
        $name = $_POST['name'];
        $order_num = $_POST['order_num'];
        $board_id = $_POST['board_id'];
        $id = CardList::create($name, $order_num, $board_id);
        echo ($id);
      } else {
        http_response_code(400);
        exit;
      }
      break;
    case "update":
      if(isset($_POST['id']) && isset($_POST['name'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        CardList::update($id, $name);
      } else {
        http_response_code(400);
        exit;
      }
      break;
    case "delete":
      if(isset($_POST['id'])) {
        $id = $_POST['id'];
        CardList::delete($id);
      } else {
        http_response_code(400);
        exit;
      }
      break;
    case "getAll":
      if(isset($_POST['board_id'])) {
        $board_id = $_POST['board_id'];
        echo (json_encode(CardList::getAllByBoardId($board_id)));
      } else {
        http_response_code(400);
        exit;
      }
      break;
    case "updateOrder":
      if(isset($_POST['listOrders'])) {
        $listOrders = explode(",", $_POST['listOrders']);
        $num = 1;
        foreach($listOrders as $listOrder) {
          $id = $listOrder;
          CardList::updateOrderNum($id, $num);
          $num += 1;
        }
      } else {
        http_response_code(400);
        exit;
      }
  }
} else {
  http_response_code(400);
}