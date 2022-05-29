<?php 
include_once 'DBInit.php';
include_once 'Board.php';
include_once 'Card.php';
class Workspace {

  public static function hasAccess($userId, $workspaceId) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("SELECT COUNT(*) FROM members WHERE user_id = :user_id AND workspace_id = :workspace_id");
    $statement->bindParam(":user_id", $userId);
    $statement->bindParam(":workspace_id", $workspaceId);
    $statement->execute();
    $count = $statement->fetchColumn();
    return $count > 0;
  }

  public static function getAll($userId) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("SELECT workspaces.id as id, workspaces.name as name, workspaces.owner_id as owner_id, workspaces.description as description, m.role_id as role_id FROM workspaces INNER JOIN members m ON m.workspace_id = workspaces.id WHERE m.user_id = :id");
    $statement->bindParam(":id", $userId, PDO::PARAM_INT);
    $statement->execute();
    $workspaces = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($workspaces as &$workspace) {
      $workspace['members'] = Workspace::getMembers($workspace['id']);
      $workspace['boards'] = Board::getByWorkspaceId($workspace['id'], $userId);
      $workspace['cards'] = Card::getAllByWorkspaceId($workspace['id']);
    }
    return $workspaces;
  }

  public static function get($workspaceId, $userId) {
    if(!Workspace::hasAccess($userId, $workspaceId)) {
      http_response_code(403);
      exit;
    }
    $db = DBInit::getInstance();
    $statement = $db->prepare("SELECT * FROM workspaces WHERE id = :id");
    $statement->bindParam(":id", $workspaceId, PDO::PARAM_INT);
    $statement->execute();
    $workspace = $statement->fetch(PDO::FETCH_ASSOC);
    if($workspace) {
      $workspace['members'] = Workspace::getMembers($workspace['id']);
      $workspace['boards'] = Board::getByWorkspaceId($workspace['id'], $userId);
      $workspace['cards'] = Card::getAllByWorkspaceId($workspace['id']);
    } else {
      $workspace = null;
    }
    return $workspace;
  }

  public static function create($userId, $name, $desc) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("INSERT INTO workspaces(owner_id, name, description) VALUES (:id, :name, :desc);");
    $statement->bindParam(":id", $userId, PDO::PARAM_INT);
    $statement->bindParam(":name", $name, PDO::PARAM_STR);
    $statement->bindParam(":desc", $desc, PDO::PARAM_STR);
    $statement->execute();

    $workspaceId = $db->lastInsertId();
    //Add user as a admin
    Workspace::addMember($workspaceId, $userId, 0);
    Board::create($userId, "First Board!", $workspaceId, "#33FF33");
    return $workspaceId;
  }

  public static function addMember($workspaceId, $userId, $role) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("INSERT INTO members(user_id, workspace_id, role_id) VALUES (:user_id, :workspace_id, :role)");
    $statement->bindParam(":user_id", $userId, PDO::PARAM_INT);
    $statement->bindParam(":workspace_id", $workspaceId, PDO::PARAM_INT);
    $statement->bindParam(":role", $role, PDO::PARAM_INT);
    $statement->execute();
  }

  public static function removeMember($workspaceId, $userId) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("DELETE FROM members WHERE user_id = :user_id AND workspace_id = :workspace_id");
    $statement->bindParam(":user_id", $userId, PDO::PARAM_INT);
    $statement->bindParam(":workspace_id", $workspaceId, PDO::PARAM_INT);
    $statement->execute();
  }

  public static function updateMemberRole($memberId, $role_id) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("UPDATE members SET role_id = :role_id WHERE id = :id");
    $statement->bindParam(":id", $memberId, PDO::PARAM_INT);
    $statement->bindParam(":role_id", $role_id, PDO::PARAM_INT);
    $statement->execute();
  }

  public static function getAvailableUsers($workspaceId) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("SELECT * FROM users WHERE NOT EXISTS (SELECT * FROM members WHERE members.workspace_id = :workspace_id AND members.user_id = users.id)");
    $statement->bindParam(":workspace_id", $workspaceId, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getMembers($workspaceId) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("SELECT users.id as id, users.username as username, users.display_name as display_name, m.role_id as role_id, m.id as member_id FROM users INNER JOIN members m ON m.user_id = users.id WHERE m.workspace_id = :workspace_id");
    $statement->bindParam(":workspace_id", $workspaceId, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function deleteMembersByWorkspaceId() {
    $db = DBInit::getInstance();
    $statement = $db->prepare("DELETE FROM members WHERE workspace_id = :workspace_id");
    $statement->bindParam(":workspace_id", $workspaceId, PDO::PARAM_INT);
    $statement->execute();
  }

  public static function delete($workspaceId) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("DELETE FROM workspaces WHERE id = :id");
    $statement->bindParam(":id", $workspaceId, PDO::PARAM_INT);
    $statement->execute();
  }
  
}
