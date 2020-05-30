<?php
class Captcha
{
  public $length;
  public $charset;


  public function __construct($length = 5,$charset = '1234567890')
  {
    $this->length = $length;
    $this->charset = $charset;
  }

  public function build($length = null,$charset=null)
  {
    if ($length !== null){
      $this->length = $length;
    }
    if ($charset !== null){
      $this->charset = $charset;
    }
    $image = imagecreatetruecolor(150,40);

//    for ($x=0; $x < 130; $x++)
//    {
//      for ($y=0; $y < 40; $y++)
//      {
//        $random = mt_rand(0 , 9);
//        $temp_color = imagecolorallocate($image,
//          $this -> Colors["$random"],
//          $this -> Colors["$random"], $this -> Colors["$random"]);
//        //imagesetpixel( $image, $x, $y , $temp_color );
//      }
//    }
    imagefilledrectangle($image,0,0,170,50,imagecolorallocate($image,130,140,150));
    $phrase = '';
    $chars = str_split($this->charset);

    for($i=0;$i<10;$i++){
      $color = imagecolorallocate($image, rand(160,230), rand(160,240), rand(160,250));
      imageline($image, rand(11,140), rand(20,35), rand(15,140), rand(9,35), $color) ;
    }
    for ($i=0; $i < $this->length; $i++){
      $phrase .= $chars[array_rand($chars)];
      $color = imagecolorallocate($image, 200, 20, 30);
    }
    Session::set('captcha',$phrase);
    imagefttext($image, 30, 3, 15, 40, $color, BASE_DIR."/core/captcha/Font/ABeeZee_regular.ttf", $phrase);
    imagejpeg($image,"captcha/captcha.jpg");
  }


  public static function checkCaptcha($captcha)
  {

    if (Session::get('captcha') && ($captcha == Session::get('captcha'))){
      return true;
    }
    return false;
  }
}