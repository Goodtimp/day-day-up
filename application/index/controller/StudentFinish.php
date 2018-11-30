<?php

/**
 * User:goodtimp
 * LastDate:2018/11/23
 */

namespace app\index\controller;

use think\Controller;
use think\facade\Session;
use app\index\controller\Tools as Tools;
use app\index\model\test as testModel;
use app\index\model\mymodel as testquestionModel;
use app\index\model\answer as answerModel;


class Studentfinish extends Controller
{
  function initialize()
  {
    if(!Session::has('Id', 'answer'))
    {
      $this->error("您未参加该考试",'/day-day-up/public/index.php/index/studentlogin/index?id='.(Session::get('Id','test')));
    }
    $id=Session::get('Id', 'answer');
    Tools::student_deleteSession();
    
    $answer=answerModel::get_answer_by_id($id);
    Session::set('Id', $answer['Id'], 'answer');
    Session::set('score', $answer['score'], 'answer');
    Session::set('testId', $answer['testId'], 'answer');
    Session::set('studentId', $answer['studentId'], 'answer');
    if(!Session::has("startTime",'test')||Session::has("endTime",'test')||Session::has("name","test"))//获取测试信息
    {
      $test=testModel::get_test(Session::get('testId', 'answer'));
      Session::set("endTime",strtotime($test["endTime"]),'test');
      Session::set("name",$test["name"],'test');
    }
  }

  public function index()
  {
    // dump((Session::get('endTime','test')<=Time()?
    // (testquestionModel::get_answerquestions(Session::get('Id', 'answer'),Session::get('testId', 'answer'))):""));
    $this->assign([
      "score" => Session::get('score', 'answer'),
      "name"=>Session::get('name','test'),
      'details'=>(Session::get('endTime','test')<=Time()?
      (testquestionModel::get_answerquestions(Session::get('Id', 'answer'),Session::get('testId', 'answer'))):"")//结束后获取做答详情
    ]);
    
    return view();
  }
  
}