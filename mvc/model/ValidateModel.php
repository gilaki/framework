<?php
class ValidateModel
{
  public static function checkUnique($column,$table,$value)
  {
    $database = DatabaseFactory::getFactory()->getConnection();
    $sql = "SELECT $column FROM $table WHERE $column = :valueunique LIMIT 1";
    $query = $database->prepare($sql);
    $query->execute(array(':valueunique'=>$value));
    if ($query->rowCount() >=1){
      return true;
    }
    return false;
  }
}