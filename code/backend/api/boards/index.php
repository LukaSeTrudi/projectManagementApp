<?php
include_once '../../beforeRequest.php';
include_once '../../models/Board.php';
include_once '../../isAuthed.php';

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "GET") {
  echo (json_encode(Board::getAll($user_id)));
} else if ($method == "POST") {
  if (isset($_POST['name']) && isset($_POST['workspaceId']) && isset($_POST['color'])) {
    $name = $_POST['name'];
    $workspaceId = $_POST['workspaceId'];
    $color = $_POST['color'];
    $id = Board::create($user_id, $name, $workspaceId, $color);
    echo ($id);
  } else if (isset($_POST["boardId"])) {
    $boardId = $_POST["boardId"];
    if(isset($_POST["star"])) {
      $star = $_POST["star"];
      Board::star($boardId, $user_id, $star);
      echo("OK");
    } else if(isset($_POST["delete"])) {
      Board::delete($boardId);
      echo("OK");
    }
     else {
      include_once '../../models/List.php';
      $board = Board::get($boardId, $user_id);
      $lists = CardList::getAllByBoardId($boardId);
      $board["lists"] = $lists;
      echo(json_encode($board));
    }
  } else {
    http_response_code(400);
    exit;
  }
}
