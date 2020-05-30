<?php
class DatabaseFactory
{
  private static $factory;
  private $Database;

  public static function getFactory()
  {
    if (!self::$factory){
      self::$factory = new DatabaseFactory();
    }
    return self::$factory;
  }

  public function getConnection()
  {
    if (!$this->Database){

      try {
        $option = array(PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ,PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING);

        //new PDO("mysql:host=$dbhost;dbname=$dbname;port=$dbport;charset=$dbchar",$dbuser,$dbpass);
        $this->Database = new PDO(
          Config::get('DB_TYPE').':host='.Config::get('DB_HOST').';dbname='.Config::get('DB_NAME').
          ';port='.Config::get('DB_PORT').';charset='.Config::get('DB_CHAR'),
          Config::get('DB_USER'),Config::get('DB_PASS'),$option
        );

      }catch (PDOException $e){

        echo "اتصال به پایگاه داده با خطا روبه رو شد لطفا تنضیمات را بررسی کنید" . '</br>';

        echo "Error code " . $e->getCode();

        echo 'Error Message '. $e->getMessage();

        exit();
      }
    }
    return $this->Database;
  }
}