<?php
/* Using PHPMailer's namespace */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Mail
{
  private $errors;

  public function sendMailWithPHPMailer($userEmail,$fromEmail,$fromName,$subject,$body)
  {
    $mail = new PHPMailer();

    $mail->SMTPOptions = array(
      'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    );
    $mail->CharSet = "UTF-8";

    if (Config::get('EMAIL_USE_SMTP'))
    {
      //set phpmailer to use smtp
      $mail->isSMTP();

      // 0 = off, 1 = commands, 2 = commands and data, perfect to see SMTP errors
      $mail->SMTPDebug = 2;

      // enable SMTP authentication
      $mail->SMTPAuth = Config::get('EMAIL_SMTP_AUTH');


      // set SMTP provider's credentials
      $mail->SMTPSecure = Config::get('EMAIL_SMTP_ENCRYPTION');
      $mail->Host = Config::get('EMAIL_SMTP_HOST');
      $mail->Username = Config::get('EMAIL_SMTP_USERNAME');
      $mail->Password = Config::get('EMAIL_SMTP_PASSWORD');
      $mail->Port = Config::get('EMAIL_SMTP_PORT');
    }else{
      $mail->IsMail();
    }

    $mail->isHTML(true);
    // fill mail with data
    $mail->setFrom($fromEmail,$fromName);
    $mail->AddAddress($userEmail);
    $mail->Subject = $subject;
    $mail->Body = $body;


    // try to send mail, put result status (true/false into $wasSendingSuccessful)
    // I'm unsure if mail->send really returns true or false every time, tis method in PHPMailer is quite complex
    $wasSendingSuccessful = $mail->send();

    if ($wasSendingSuccessful){
      return true;
    } else{
    // if not successful, copy errors into Mail's error property
      $this->errors = $mail->ErrorInfo;
      return false;
    }
  }

  public function sendMail($AddressEmail,$fromEmail,$fromName,$subject,$body)
  {
    if (Config::get('EMAIL_USED_MAILER') == 'phpmailer')
    {
      return $this->sendMailWithPHPMailer($AddressEmail,$fromEmail,$fromName,$subject,$body);
    }
  }
  public function getError()
  {
    return $this->errors;
  }
}