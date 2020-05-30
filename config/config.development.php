<?php


return array(


  'URL' => 'http://'.$_SERVER['HTTP_HOST'],
/*
 *کانفیگ کردن مقدار پیشفرض controller و action
 */
  'DEFAULT_CONTROLLER' => 'index',
  'DEFAULT_ACTION' => 'index',

/*
 * کانفیگ کردن و اتصال به پایگاه داده با pdo
 * نوع پایگاه داد در کلید DB_TYPE مقدار دهی شود
 * نام هاست را در کلید DB_HOST مقدار دهی شود
 * نام دیتا بیس را در کلید DB_NAME مقدار دهی کنید
 * نام کاربری در پایگاه داده در DB_USER مقدار دهی شود
 * رمز عبور حساب کاربری پایگاه داده در DB_PASS مقدار دهی شود
 * پورت استفاده شده در پایگاه داده در DB_PORT مقدار دهی شود
 * کاراکتر دیتا بیس در DB_CHAR ست شود
 */
  'DB_TYPE' =>  'mysql',
  'DB_HOST' =>  '127.0.0.1',
  'DB_NAME' =>  'frame',
  'DB_USER' =>  'root',
  'DB_PASS' =>  '',
  'DB_PORT' =>  '3306',
  'DB_CHAR' =>  'utf8',

  /*
   * ادرس دایرکتوری view
   */
  'VIEW_PATH' =>  BASE_DIR . '/mvc/view/',
  /*
   * تصویر امنیتی
   */

  'CAPTCHA_WIDTH' =>  359,
  'CAPTCHA_HEIGHT'  =>  100,

  /*
   * کانفیگ ایمیل
   */
  'EMAIL_USED_MAILER' =>  'phpmailer',
  'EMAIL_USE_SMTP'  =>  true,
  'EMAIL_SMTP_AUTH' =>  true,
  'EMAIL_SMTP_ENCRYPTION' =>  'tls',
  'EMAIL_SMTP_HOST' =>  'smtp.gmail.com',
  'EMAIL_SMTP_USERNAME' =>  'gilaki1992@gmail.com',
  'EMAIL_SMTP_PASSWORD' =>  '2409012223hg',
  'EMAIL_SMTP_PORT' =>  587,

);