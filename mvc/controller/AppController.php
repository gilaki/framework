<?php
class AppController extends Controller
{
  public function index()
  {
    $string = '12345:1115454';
    $string = preg_replace('/.*:/','',$string);
    echo $string;
    exit;
    $namesArray = array("s" => "Sahar", "m" => "Mohamad");

    $input="ms";
    $inputArray = str_split($input);


    foreach($inputArray as $char)
    {
      if(array_key_exists($char, $namesArray))
        echo $namesArray[$char] . " ";
    }
//    $_SESSION['name'] = $_SESSION['user'];
//    $array = array('saledolar'=>2330,'buyseke'=>2320);
//    $array2 = array('saledolar'=>2330,'buyseke'=>2320);
//    $array3 = array('saledolar'=>2330,'buyseke'=>2320);
//    $all = array($array,$array2,$array3);
//    $dolar = '';
//        $arrayyy = array();
//      foreach ($all as $array12){
//        echo "<pre>";
//        print_r($array12);
//        echo "</pre>";
//        if (key_exists('buyseke',$array12)){
//          $arrayyy[] = $array12;
//        }
//      }
//        $saledolar = array_column($all,'saledolar');
//        $buyseke = array_column($arrayyy,'buyseke');
//        $sunValue = 0;
//        $sunValuebuyseke = 0;
//        foreach ($saledolar as $key => $value){
//          $sunValue += $value;
//        }
//        if ($arrayyy){
//          foreach ($buyseke as $key1 => $value1){
//            $sunValuebuyseke += $value1;
//          }
//          echo $sunValuebuyseke . "</br>";
//
//        }
//        echo $sunValue;
//      //print_r($saledolar);
//
//
//    echo $dolar;
//    //return $this->view->render('app/index');

  }
  public function create()
  {
    $this->view->render('app/create');
  }
  public function show()
  {

    Session::add('feedback_negative',Text::add('این یک تست است'));
    Session::add('feedback_negative',Text::get('SUCCESS'));
    $data['var'] = $this->view->renderFeedbackMessage();
    $this->view->render('app/create',$data);
  }
}