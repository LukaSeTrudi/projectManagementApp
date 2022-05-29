<?php 
include_once 'DBInit.php';
include_once 'Card.php';
class CardList {

  public static function getAllByBoardId($board_id) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("SELECT * FROM lists WHERE board_id = :board_id");
    $statement->bindParam(":board_id", $board_id);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $result = array_map(function($item) {
      $ret = Card::getAllByListId($item["id"]);
      $item["cards"] = $ret; 
      return $item;
    }, $result);
    return $result;
  }

  public static function create($name, $order_num, $board_id) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("INSERT INTO lists(name, order_num, board_id) VALUES (:name, :order_num, :board_id);");
    $statement->bindParam(":name", $name, PDO::PARAM_STR);
    $statement->bindParam(":order_num", $order_num, PDO::PARAM_INT);
    $statement->bindParam(":board_id", $board_id, PDO::PARAM_INT);
    $statement->execute();
    return $db->lastInsertId();
  }

  public static function update($id, $name) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("UPDATE lists SET name = :name WHERE id = :id");
    $statement->bindParam(":name", $name, PDO::PARAM_STR);
    $statement->bindParam(":id", $id, PDO::PARAM_INT);
    $statement->execute();
  }

  public static function delete($id) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("DELETE FROM lists WHERE id = :id");
    $statement->bindParam(":id", $id, PDO::PARAM_INT);
    $statement->execute();
  }

  public static function updateOrderNum($listId, $orderNum) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("UPDATE lists SET order_num = :order_num WHERE id=:id");
    $statement->bindParam(":order_num", $orderNum, PDO::PARAM_INT);
    $statement->bindParam(":id", $listId, PDO::PARAM_INT);
    $statement->execute();
  }

  public static function deleteByWorkspaceId($workspaceId) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("DELETE FROM lists WHERE board_id IN (SELECT id FROM boards WHERE workspace_id = :workspace_id)");
    $statement->bindParam(":workspace_id", $workspaceId, PDO::PARAM_INT);
    $statement->execute();
  }

}

?>