<?php
class Model
{
  public static function InitModel($fileName)
  {
    $filePath = BASE_DIR . '/mvc/model/'.$fileName . 'Model.php';
    if (file_exists($filePath)){
      require $filePath;
    }
    return false;
  }
}