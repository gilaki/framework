<?php
class Config
{
  public static $config;
  public static $init;
  public static function get($key)
  {
    if (!self::$config){
      $config_file = BASE_DIR . '/config/config.'.Environment::get('development').'.php';
      if (!file_exists($config_file)){
        return false;
      }
      self::$config = require $config_file;
    }
    return self::$config[$key];
  }
  public static function init($file)
  {
    $init_file = BASE_DIR . '/config/config.'.Environment::get('init').'.php';
    self::$init = require_once $init_file;
    foreach (self::$init[$file] as $key => $value){
      require_once $value;
    }
  }
}