<?php 
include_once 'DBInit.php';
class User {

  public static function getUser($userId) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("SELECT id, username, email, display_name, bio from users WHERE id = :id");
    $statement->bindParam(":id", $userId, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }
  
  public static function getAllUsers() {
    $db = DBInit::getInstance();
    $statement = $db->prepare("SELECT id, username, email, display_name, bio from users");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function updateUser($userId, $username, $email, $display_name, $bio) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("UPDATE users SET username = :username, email = :email, display_name = :display_name, bio = :bio WHERE id = :id");
    $statement->bindParam(":id", $userId, PDO::PARAM_INT);
    $statement->bindParam(":username", $username, PDO::PARAM_STR);
    $statement->bindParam(":email", $email, PDO::PARAM_STR);
    $statement->bindParam(":display_name", $display_name, PDO::PARAM_STR);
    $statement->bindParam(":bio", $bio, PDO::PARAM_STR);
    $statement->execute();
  }

  public static function deleteUser($userId) {
    $db = DBInit::getInstance();
    $statement = $db->prepare("DELETE FROM users WHERE id = :id");
    $statement->bindParam(":id", $userId, PDO::PARAM_INT);
    $statement->execute();
  }
}

?>