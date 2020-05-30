<?php
class UserModel
{
  public static function sendActiveEmail()
  {

  }
  public static function insertEmail($email,$verifyHashCode)
  {
    $mail = new Mail();
    $name = 'WEBSITE';
    $subject = 'لینک فعال سازی حساب کاربری شما';
    $body = '<div style="text-align:center; "><h3 style="text-align:right; direction:rtl">با سلام خدمت شما کاربر گرامی</h3></div></br><span>برای فعال سازی حساب خود بر روی لینک کلیک کنید <a href=""><strong>فعال سازی حساب</strong></a></span></div>';
    $database = DatabaseFactory::getFactory()->getConnection();
    $sql = "INSERT INTO users(email,verifyHashCode) VALUES (:email,:verifyHashCode)";
    $query = $database->prepare($sql);
    $query->execute([':email'=>$email,':verifyHashCode'=>$verifyHashCode]);
  }

  public static function sendValidMail($email)
  {

    $mail = new Mail();
    $sendEmail = $mail->sendMail('gilaki1992@gmail.com','gilaki1992@gmail.com','hassan','activeLink','click to link active account');
    if ($sendEmail){
      Session::add('feedback_position',Text::add('لینک فعال سازی به ایمیل شما ارسال شد لطفا ایمیل خود را بررسی کنید'));
      Redirect::to('/register');
      exit();
    }else{
      Session::add('feedback_negative',Text::add('مشکلی در ارسال ایمیل پیش امده'.$mail->getError()));
      Redirect::to('/register');
      exit();
    }
  }
  public static function logout()
  {
    Session::sessionIdUpdate(Auth::user_id());
    Session::destroy();
  }
}