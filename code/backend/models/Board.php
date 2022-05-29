<?php 
include_once 'DBInit.php';
include_once 'List.php';
include_once 'Workspace.php';

class Board {
  
  public static function hasAccess($userId, $boardId) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("SELECT COUNT(*) FROM members WHERE user_id = :user_id AND workspace_id IN (SELECT workspace_id FROM boards WHERE id = :board_id)");
    $statement->bindParam(":user_id", $userId);
    $statement->bindParam(":board_id", $boardId);
    $statement->execute();
    $count = $statement->fetchColumn();
    return $count > 0;
  }

  public static function get($boardId, $user_id) {
    if(!Board::hasAccess($user_id, $boardId)) {
      http_response_code(403);
      exit;
    }
    $db = DBInit::getInstance();
    $stmt = $db->prepare("SELECT * FROM boards WHERE id = :boardId");
    $stmt->bindParam(":boardId", $boardId);
    $stmt->execute();
    $board = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$board) {
      return null;
    }
    $board['starred'] = Board::isStarred($user_id, $boardId);
    return $board;
  }

  public static function getByWorkspaceId($workspaceId, $user_id) {
    if(!Workspace::hasAccess($user_id, $workspaceId)) {
      http_response_code(403);
      exit;
    }
    $db = DBInit::getInstance();
    $stmt = $db->prepare("SELECT * FROM boards WHERE workspace_id = :workspaceId");
    $stmt->bindParam(":workspaceId", $workspaceId);
    $stmt->execute();
    $boards = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($boards as &$board) {
      $board['starred'] = Board::isStarred($user_id, $board['id']);
    }
    return $boards;
  }

  public static function getAll($userId) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("SELECT boards.id as id, boards.name as name, boards.workspace_id as workspace_id, boards.creator_id as creator_id, boards.color as color FROM boards INNER JOIN workspaces ON workspaces.id = boards.workspace_id INNER JOIN members ON members.workspace_id = workspaces.id WHERE members.user_id = :id");
    $statement->bindParam(":id", $userId, PDO::PARAM_INT);
    $statement->execute();
    $boards = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($boards as &$board) {
      $board['starred'] = Board::isStarred($userId, $board['id']);
    }
    return $boards;
  }

  public static function isStarred($user_id, $board_id) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("SELECT COUNT(*) FROM starred WHERE board_id = :board_id AND user_id = :user_id");
    $statement->bindParam(":board_id", $board_id, PDO::PARAM_INT);
    $statement->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $statement->execute();
    $count = $statement->fetchColumn();
    return $count > 0;
  }
  
  public static function create($userId, $name, $workspaceId, $color) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("INSERT INTO boards(name, workspace_id, creator_id, color) VALUES (:name, :workId, :id, :color);");
    $statement->bindParam(":id", $userId, PDO::PARAM_INT);
    $statement->bindParam(":name", $name, PDO::PARAM_STR);
    $statement->bindParam(":workId", $workspaceId, PDO::PARAM_STR);
    $statement->bindParam(":color", $color, PDO::PARAM_STR);
    $statement->execute();

    $boardId = $db->lastInsertId();

    return $boardId;
  }

  public static function delete($boardId) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("DELETE FROM boards WHERE id = :id");
    $statement->bindParam(":id", $boardId, PDO::PARAM_INT);
    $statement->execute();
  }

  public static function deleteByWorkspaceId($workspaceId) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("DELETE FROM boards WHERE workspace_id = :id");
    $statement->bindParam(":id", $workspaceId, PDO::PARAM_INT);
    $statement->execute();
  }

  public static function star($boardId, $user_id, $star) {
    $db = DBInit::getInstance();
    $str = "";
    if($star == "true") {
      $str = "REPLACE INTO starred(board_id, user_id) VALUES (:boardId, :userId)";
    } else {
      $str = "DELETE FROM starred WHERE board_id = :boardId AND user_id = :userId;";  
    }
    $statement = $db->prepare($str);  
    $statement->bindParam(":boardId", $boardId, PDO::PARAM_INT);
    $statement->bindParam(":userId", $user_id, PDO::PARAM_INT);
    $statement->execute();
  }

}

?>