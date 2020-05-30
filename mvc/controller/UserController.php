<?php
use Gregwar\Captcha\CaptchaBuilder;
class UserController extends Controller
{
  function __construct()
  {
    parent::__construct();

    if (Session::userIsLoggedIn()){
      Redirect::home();
      exit();
    }
  }
  public function loginForm()
  {
    return $this->view->render('users/login_register/login');
  }
  public function loginCheck()
  {
    $a = 'google.c om';
    $search = 'http:';
    if(!preg_match("/{$search}/i", $a)) {
      echo $search ,'//'. $a;
    }
  }

  public function register()
  {
    return $this->view->render('users/login_register/sendEmail');
  }

  public function getVerifyLink()
  {
      if (!Csrf::isTokenValidPost()){
        Redirect::to('/404');
        exit();
      }
      if(!Captcha::checkCaptcha($_POST['captcha'])){
        Session::add('feedback_negative',Text::add('کد امنیتی اشتباه است'));
        Redirect::to('/register');
        exit();
      }
    $validate = new Validate();
    $validation = $validate->check($_POST,array(
      'email'=>array(
        'required' => true,
        'unique'=>'email:users',
        'mailValid'=> true,
      )
    ));
    if ($validation->passed()){
      $email = Request::post('email',true);

      // generate random hash for email verification (40 char string)
      $user_activation_hash = sha1(uniqid(mt_rand(), true));

      $body = "<div style='text-align:center; '><h3 style='text-align:right; direction:rtl'>با سلام خدمت شما کاربر گرامی</h3></div></br><span>برای فعال سازی حساب خود بر روی لینک کلیک کنید </span></br><a href=''><strong>فعال سازی حساب</strong></a></div>";

      //UserModel::insertEmail($email,$user_activation_hash);
      $mail = new Mail();
      $sendEmail = $mail->sendMail('gilaki1992@gmail.com','gilaki1992@gmail.com','hassan','activeLink',$body);
      if ($sendEmail){
        Session::add('feedback_position',Text::add('لینک فعال سازی به ایمیل شما ارسال شد لطفا ایمیل خود را بررسی کنید'));
        Redirect::to('/register');
        exit();
      }else{
        Session::add('feedback_negative',Text::add('مشکلی در ارسال ایمیل پیش امده'.$mail->getError()));
        Redirect::to('/register');
        exit();
      }
    }else{
      $errors = $validation->errors();
      foreach ($errors as $error){
        Session::add('feedback_negative',Text::add($error));
        Redirect::to('/register');
      }

    }

  }
}