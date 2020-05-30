<?php
class Filter
{

  public static function XSSFilter(&$value)
  {
    if (is_string($value)) {
      $value = htmlspecialchars($value,ENT_QUOTES,'UTF-8');
    }elseif (is_array($value)||is_object($value)){
      foreach($value as &$valueInValue) {

        self::XSSFilter($valueInValue);
      }
    }
    return $value;
  }
}