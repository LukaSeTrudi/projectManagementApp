<?php
include_once '../../beforeRequest.php';
include_once '../../models/Workspace.php';
include_once '../../isAuthed.php';

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "GET") {
  echo (json_encode(Workspace::getAll($user_id)));
} else if ($method == "POST" && isset($_POST['request_type'])) {
  $requestType = $_POST['request_type'];
  switch ($requestType) {
    case "create":
      if (isset($_POST['name']) && isset($_POST['desc'])) {
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $id = Workspace::create($user_id, $name, $desc);
        echo ($id);
      } else {
        http_response_code(400);
        exit;
      }
      break;
    case "delete":
      if (isset($_POST['workspace_id'])) {
        $id = $_POST['workspace_id'];
        Workspace::delete($id);
        echo ("OK");
      } else {
        http_response_code(400);
        exit;
      }
      break;
    case "availableUsers":
      if (isset($_POST['workspace_id'])) {
        $workspace_id = $_POST['workspace_id'];
        echo (json_encode(Workspace::getAvailableUsers($workspace_id)));
      } else {
        http_response_code(400);
        exit;
      }
      break;
    case "addMember":
      if ( isset($_POST['workspace_id']) && isset($_POST['member_id']) ) {
        $workspace_id = $_POST['workspace_id'];
        $member_id = $_POST['member_id'];
        Workspace::addMember($workspace_id, $member_id, '1');
        echo ("OK");
      } else {
        http_response_code(400);
        exit;
      }
      break;
    case "removeMember":
      if ( isset($_POST['workspace_id']) && isset($_POST['member_id']) ) {
        $workspace_id = $_POST['workspace_id'];
        $member_id = $_POST['member_id'];
        Workspace::removeMember($workspace_id, $member_id);
        echo ("OK");
      } else {
        http_response_code(400);
        exit;
      }
      break;
    case "updateMemberRole":
      if ( isset($_POST['member_id']) && isset($_POST['role']) ) {
        $member_id = $_POST['member_id'];
        $role = $_POST['role'];
        Workspace::updateMemberRole($member_id, $role);
        echo ("OK");
      } else {
        http_response_code(400);
        exit;
      }
      break;
    case "getSingle":
      if (isset($_POST['workspace_id'])) {
        $workspace_id = $_POST['workspace_id'];
        echo (json_encode(Workspace::get($workspace_id, $user_id)));
      } else {
        http_response_code(400);
        exit;
      }
      break;
  }
}
