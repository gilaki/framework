<?php
class Validate
{
  private $_passed = false;
  private $_errors = [];
  function __construct()
  {
    Model::InitModel('Validate');
  }

  public function check($source, $items=array())
  {
    foreach($items as $item => $rules)
    {
      $value = htmlspecialchars(trim($source[$item]),ENT_QUOTES,'UTF-8');
      foreach ($rules as $rule => $rule_value){

        switch ($rule)
        {
          case 'required':
            if (empty($value)){
             $this->addError(" فیلد مربوط به $item  خالی است ");
            }
            break;
          case 'match':
            if ($value != Request::post($rule_value,true)){
             $this->addError("رمزهای عبور باهم مطابقت ندارند");
            }
            break;
          case 'length_min':
            if (strlen($value) < $rule_value){
              $this->addError("$item ضعیف است حداقل باید $rule_value کاراکتر داشته باشد  ");
            }
            break;
          case 'length_max':
            if (strlen($value) > $rule_value){
              $this->addError("$item نباید بیشتر از  $rule_value کاراکتر داشته باشد  ");
            }
            break;
          case 'unique':
            $rule_value1 = explode(':',$rule_value);
            if (ValidateModel::checkUnique($rule_value1[0],$rule_value1[1],$value)){
              Redirect::to('');
              $this->addError("$item وارد شده در سایت موجود میباشد  ");
            }
            break;
          case "mailValid":
            if (!filter_var($value,FILTER_VALIDATE_EMAIL))
            {
              $this->addError(" ایمیل نامعتبر است ");
            }
            break;
        }
      }
    }
    if (empty($this->_errors))
    {
      $this->_passed = true;
    }
    return $this;
  }
  public function addError($error)
  {
    $this->_errors[] = $error;
  }
  public function errors()
  {
    return $this->_errors;
  }
  public function passed()
  {
    return $this->_passed;
  }

}