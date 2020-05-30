<?php
class ApiController extends Controller
{
  public function user()
  {

    $result = ApiModel::user();

    foreach ($result as $res){
      $users[$res['id']] =[
        'id'   =>  $res['id'],
        'name'  =>  $res['name'],
        'rules'  =>  $res['rules'],
        'created' =>  $res['created'],
      ];
    }
    header("Content-Type: application/json");
    echo json_encode($users);
  }

}
