<?php

class ApiModel {

  public static function user()
  {
    $connect = DatabaseFactory::getFactory()->getConnection();
    $sql = "SELECT * FROM api ORDER BY id";
    $query = $connect->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }
}