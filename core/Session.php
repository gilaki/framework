<?php
class Session
{
  public static function init()
  {
    if (session_id()==''){
      session_start();
    }
  }
  public static function set($key,$value)
  {
    $_SESSION[$key] = $value;
  }

  public static function get($key) {
    if (isset($_SESSION[$key])) {
      $value = $_SESSION[$key];
      return Filter::XSSFilter($value);
    }
  }
  public static function destroy()
  {
    session_destroy();
  }
  public static function userIsLoggedIn()
  {
    return self::get('user_logged_in') ? true: false;
  }
  public static function add($key,$value)
  {
    $_SESSION[$key][] = $value;
  }
  public static function sessionIdUpdate($userId,$sessionId=null)
  {
    $database = DatabaseFactory::getFactory()->getConnection();
    $sql = "UPDATE users SET session_id = :session_id WHERE id = :user_id";
    $query = $database->prepare($sql);
    $query->execute([':session_id'=>$sessionId,':user_id'=>$userId]);
  }
  public static function isConCurrentSessionExists()
  {
    $sessionId = session_id();
    $user_id = Auth::user_id();
    if (isset($user_id)&&isset($sessionId)){
      $database = DatabaseFactory::getFactory()->getConnection();
      $sql = "SELECT session_id FROM users WHERE id = :user_id";
      $query = $database->prepare($sql);
      $query->execute([':user_id'=>$user_id]);
      $result = $query->fetch();
      $session_id_table  = !empty($result) ? $result->session_id : null;
      return $sessionId !== $session_id_table;
    }
    return false;
  }
}
