<?php

/**
 * User:Lxx
 * LastDate:2018/11/24
 */


namespace app\index\controller;

use app\index\model\course as courses;//记录一下错误 如果修改称courses与控制器内Course冲突
use think\Controller;
use think\facade\Session;
use think\helper\Time;
use app\index\model\test as testmodel;//记录一下错误 如果修改称courses与控制器内Course冲突
use app\index\model\testquestion as testquestionModel;
use app\index\model\question as questionModel;
class Question extends Father
{
  public function questionEditor()
  {
    $test_id = input("get.id");
    // dump($test_id);
    $test = testModel::get_test($test_id);//获取测试信息
   
    if ($test) {
      $test_detail = testquestionModel::get_testquestions($test_id);//获取测试详情信息
    
      $this->assign([
        'test' => $test,
      ]);
      $this->assign([
        'testdetail' => $test_detail
      ]);
      
     // dump($test);
      //dump($test_detail);
    }

    return view("questionEditor");
  }
  public function SaveQuestionChange(){
    $que_id = input("get.id");
    if($que_id){
     
    }
    questionModel::save_Question($que_id);
  }
}