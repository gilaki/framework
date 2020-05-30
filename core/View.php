<?php
class View
{
  private static $feedback_negative = [];

  public function render($fileName,$data=null)
  {
    if ($data){
      Filter::XSSFilter($data);
      extract($data);
    }
    include Config::get('VIEW_PATH').$fileName.'.php';
  }
  public function renderFeedbackMessage()
  {
    require BASE_DIR . '/_templates/feedback.php';
    Session::set('feedback_negative',null);
    Session::set('feedback_position',null);
  }

}
