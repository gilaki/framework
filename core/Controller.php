<?php
class Controller
{
  protected $view;
  public function __construct()
  {
    Session::init();
    Auth::checkConCurrency();
    $this->view = new View();

  }
}