<?php
class AppModel
{
  public $user_id = 1;
  public static function index($user_id)
  {

    $database = DatabaseFactory::getFactory()->getConnection();
    $sql = "SELECT title,sku FROM products where user_id = $user_id ";
    $query = $database->prepare($sql);
    $query->execute();
    $res = $query->fetchAll(PDO::FETCH_ASSOC);

  }
}