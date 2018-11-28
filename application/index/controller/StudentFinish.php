<?php

/**
 * User:goodtimp
 * LastDate:2018/11/23
 */

namespace app\index\controller;

use think\Controller;
use think\facade\Session;
use app\index\controller\Tools as Tools;
use app\index\model\answer as answerModel;


class StudentFinish extends Controller
{
  function initialize()
  {
    if(!Session::has('Id', 'answer'))
    {
      $this->redirect('Studentlogin/index');
    }
    $id=Session::get('Id', 'answer');
    Tools::deleteSession();
    dump($id);
    $answer=answerModel::get_answer_by_id($id);
    Session::set('Id', $answer['Id'], 'answer');
    Session::set('score', $answer['score'], 'answer');
    Session::set('testId', $answer['testId'], 'answer');
    Session::set('studentId', $answer['studentId'], 'answer');
  }

  public static function index(){
 
    $score=Session::get('score', 'answer');
  
    return "考试结束,您的分数为" . $score;
  }
  
}