<?php
class Text
{
  private static $texts;

  public static function add($alert)
  {
     return $alert;
  }
  public static function get($key)
  {
    if (!$key){
      return null;
    }
    if (!self::$texts){
      $path = BASE_DIR .'/config/texts.php';
        self::$texts = require $path;
    }

    return self::$texts[$key];
  }
  public static function set($var1,$var2)
  {
    return $var1 !== $var2;
  }
}