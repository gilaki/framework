<?php
class IncludeFile
{
  public static function SendContent($pathFile,$content=array())
  {
    $PathFile = BASE_DIR . '/mvc/view/'.$pathFile . '.php';
    $layout = file_get_contents($PathFile);
    foreach ($content as $key => $value){
      $layout = str_replace('{{'.strtoupper($key).'}}',$value,$layout);
    }
    $layout = preg_replace('/\{\{\w+\}\}/','',$layout);
    $fileName = BASE_DIR . '/tmp/'.time().'.php';
    $fileOpen = fopen($fileName,'a');
    fwrite($fileOpen,$layout);
    fclose($fileOpen);
    include $fileName;
    unlink($fileName);
  }
}

