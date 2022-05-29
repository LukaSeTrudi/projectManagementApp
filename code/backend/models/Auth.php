<?php
include_once 'DBInit.php';
include_once 'JWT.php';
include_once '../../models/Workspace.php';

class Auth
{
  static $salt = "randomSalt";

  public static function userExists($user, $email)
  {
    $db = DBInit::getInstance();
    $statement = $db->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
    $statement->bindParam(":username", $user, PDO::PARAM_STR);
    $statement->bindParam(":email", $email, PDO::PARAM_STR);
    $statement->execute();
    return $statement->rowCount() > 0;
  }

  public static function register($username, $email, $pass, $displayName)
  {
    if (self::userExists($username, $email)) {
      return false;
    }

    $db = DBInit::getInstance();
    $statement = $db->prepare("INSERT INTO users(username, email, password, display_name) VALUES (:username, :email, :password, :display_name)");
    $statement->bindParam(":username", $username, PDO::PARAM_STR);
    $statement->bindParam(":email", $email, PDO::PARAM_STR);
    $salted = sha1(self::$salt . $username . $pass);
    $statement->bindParam(":password", $salted, PDO::PARAM_STR);
    $statement->bindParam(":display_name", $displayName, PDO::PARAM_STR);
    $statement->execute();

    // generate workspaces

    $userId = $db->lastInsertId();
    Workspace::create($userId, "My Workspace", "This is your first workspace");

    return true;
  }

  public static function login($userOrEmail, $pass)
  {
    $db = DBInit::getInstance();
    $statement = $db->prepare("SELECT * FROM users WHERE (username = :userMail OR email = :userMail)");
    $statement->bindParam(":userMail", $userOrEmail, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ($user && $user['password'] == sha1(self::$salt . $user['username'] . $pass)) {
      $tokenPayload = array('sub' => 'JwtForSpletne', 'user_id' => $user['id'], 'exp' => time() + 3600);
      return array(
        "user" => $user,
        "token" => JWT::generate_jwt($tokenPayload)
      );
    }
    return false;
  }

  public static function tokenLogin($token) {
    return JWT::is_jwt_valid($token);
  }
}
