<?php
class App
{
  protected $controller;
  protected $controller_name;
  protected $controller_path;
  protected $model_path;
  protected $classInstance;
  protected $action;
  protected $params = [];


  public function __construct()
  {

    $this->getActionAndControllerAndParams();
    $pathController =  BASE_DIR . "/mvc/".$this->controller_path . $this->controller_name .".php";
    if (file_exists($pathController)){
      require_once $pathController;
      if (class_exists($this->controller_name)){
        $this->classInstance = new $this->controller_name();
        Model::InitModel(ucfirst($this->model_path));

        if (strpos($this->action,"?")!==false){
          $method = explode('?',$this->action);
          $this->action = $method[0];
        }

        if (is_callable(array($this->classInstance,$this->action))){
          if (!empty($this->params)){
            call_user_func_array(array($this->classInstance,$this->action),$this->params);
          }else{
            $this->classInstance->{$this->action}();
          }
        }else{
          echo "not method exists";
        }
      }else{
        echo "class not exists";
      }
    }else{
      echo "file not exists";
    }

  }

  public function getUrl()
  {
    $url = $_SERVER['REQUEST_URI'];
    $url = urldecode($url);
    global $route;
    $route = $route['routing'];
    foreach ($route as $alias => $target){
      $alias = '^'.$alias;
      $alias = str_replace('/','\/',$alias);
      $alias = str_replace('*','(.*)',$alias);
      if (preg_match('/'.$alias.'/',$url)){
        $url = preg_replace('/'.$alias.'/',$target,$url);
      }
    }

    $url = rtrim($url,'/');
    $url = ltrim($url,'/');
    $url = explode('/',filter_var($url,FILTER_SANITIZE_URL));
    return $url;
  }
  public function getActionAndControllerAndParams()
  {
    $url = $this->getUrl();
    if ($this->Admins($url[0])){

      $this->controller = !empty($url[1]) ? $url[1] : Config::get('DEFAULT_CONTROLLER');
      $this->action = !empty($url[2]) ? $url[2] : Config::get('DEFAULT_ACTION');
      unset($url[0],$url[1],$url[2]);

      $this->params = array_values($url);
      $this->controller_name = ucfirst($this->controller) . "Controller";
      $this->controller_path = 'controller/AdminControllers/';
      $this->model_path = 'AdminModels/'.ucfirst($this->controller);
    }else{
      $this->controller = !empty($url[0]) ? $url[0] : Config::get('DEFAULT_CONTROLLER');
      $this->action = !empty($url[1]) ? $url[1] : Config::get('DEFAULT_ACTION');
      unset($url[0],$url[1]);

      $this->params = array_values($url);
      $this->controller_name = ucfirst($this->controller) . "Controller";
      $this->controller_path = 'controller/';
      $this->model_path = ucfirst($this->controller);
    }
  }
  public function Admins($url)
  {
    if ($url == 'admins'){
      return true;
    }
    return false;
  }

}