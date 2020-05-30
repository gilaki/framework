<?php
class Auth
{
  public function __construct()
  {
    if (!Session::userIsLoggedIn()){
      Redirect::to('error/404');
      exit();
    }
  }
  public static function user_id()
  {
    Session::init();
    return Session::get('user_id');
  }
  public static function checkConCurrency()
  {
    if (Session::userIsLoggedIn()){
      if (Session::isConCurrentSessionExists()){
        Model::InitModel('user');
        UserModel::logout();
        Redirect::home();
        exit();
      }
    }
  }
}