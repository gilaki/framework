<?php
class Hash
{
  public static function hashedPassword($password){
    $options = [
      'cost'  =>  12,
    ];

    return password_hash($password,PASSWORD_BCRYPT,$options);
  }
  public static function validPassword($password,$email)
  {
    $database = DatabaseFactory::getFactory()->getConnection();
    $sql = "SELECT password FROM users WHERE email = :email LIMIT 1";
    $query = $database->prepare($sql);
    $query->execute(array(':email' => $email));
    $passDataBase = $query->fetch()->password;
    if (password_verify($password,$passDataBase)){
      return true;
    }
    return false;
  }

}