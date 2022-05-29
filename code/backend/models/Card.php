<?php 
include_once 'DBInit.php';
class Card {
  public static function get($cardId) {
    $db = DBInit::getInstance();
    $stmt = $db->prepare("SELECT * FROM cards WHERE id = :cardId");
    $stmt->bindParam(":cardId", $cardId);
    $stmt->execute();
    $card = $stmt->fetch(PDO::FETCH_ASSOC);
    return $card;
  }

  public static function create($title, $desc, $due_date, $list_id, $order_num) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("INSERT INTO cards(title, description, due_date, list_id, order_num) VALUES (:title, :desc, :due_date, :list_id, :order_num);");
    $statement->bindParam(":title", $title, PDO::PARAM_STR);
    $statement->bindParam(":desc", $desc, PDO::PARAM_STR);
    $statement->bindParam(":due_date", $due_date, PDO::PARAM_STR);
    $statement->bindParam(":list_id", $list_id, PDO::PARAM_STR);
    $statement->bindParam(":order_num", $order_num, PDO::PARAM_INT);
    $statement->execute();
    return $db->lastInsertId();
  }
  
  public static function update($cardId, $title, $desc, $due_date, $list_id) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("UPDATE cards SET title = :title, description = :desc, due_date = :due_date, list_id = :list_id, modified = now() WHERE id = :cardId");
    $statement->bindParam(":cardId", $cardId, PDO::PARAM_INT);
    $statement->bindParam(":title", $title, PDO::PARAM_STR);
    $statement->bindParam(":desc", $desc, PDO::PARAM_STR);
    $statement->bindParam(":due_date", $due_date, PDO::PARAM_STR);
    $statement->bindParam(":list_id", $list_id, PDO::PARAM_STR);
    $statement->execute();
    return $cardId;
  }

  public static function getAllByBoardId($boardId) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("SELECT cards.id as id, cards.title as title, cards.description as description, cards.created as created, cards.modified as modified, cards.due_date as due_date, cards.list_id as list_id FROM cards INNER JOIN lists ON lists.id = cards.list_id WHERE lists.board_id = :boardId");
    $statement->bindParam(":boardId", $boardId);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getAllByWorkspaceId($workspaceId) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("SELECT cards.id as id, cards.title as title, cards.description as description, cards.created as created, cards.modified as modified, cards.due_date as due_date, cards.list_id as list_id, lists.name as list_name, boards.id as board_id, boards.name as board_name FROM cards INNER JOIN lists ON lists.id = cards.list_id INNER JOIN boards ON boards.id = lists.board_id WHERE boards.workspace_id = :workspaceId");
    $statement->bindParam(":workspaceId", $workspaceId);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getAllByListId($listId) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("SELECT cards.id as id, cards.title as title, cards.description as description, cards.created as created, cards.modified as modified, cards.due_date as due_date, cards.list_id as list_id FROM cards INNER JOIN lists ON lists.id = cards.list_id WHERE lists.id = :listId");
    $statement->bindParam(":listId", $listId);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function delete($cardId) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("DELETE FROM cards WHERE id = :cardId");
    $statement->bindParam(":cardId", $cardId, PDO::PARAM_INT);
    $statement->execute();
  }

  public static function deleteByWorkspaceId($workspaceId) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("DELETE FROM cards WHERE list_id IN (SELECT id from lists WHERE board_id IN (SELECT id from boards WHERE workspace_id = :workspaceId))");
    $statement->bindParam(":workspaceId", $workspaceId, PDO::PARAM_INT);
    $statement->execute();
  }
}
