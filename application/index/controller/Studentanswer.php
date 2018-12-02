<?php

/**
 * User:goodtimp
 * LastDate:2018/11/28
 */

namespace app\index\controller;

use app\index\controller\Tools as Tools;
use app\index\controller\Studentfinish as Studentfinish;
use app\index\model\answer as answerModel;
use think\Controller;
use app\index\model\mymodel as testquestioin;
use app\index\model\answerdetail as answerdetail;
use think\Paginator;
use think\facade\Session;


class Studentanswer extends Controller
{

  /**
   * 初始化 answer，testdetail等session信息
   */
  function initialize()
  {
    if (!Session::has('Id', 'test') || !Session::has('Id', 'student')) {
      $this->redirect('/stulogin/');//判断是否登陆和test信息
    }
   
    if (Session::has("Id", 'test')) {//判断是否在规定时间
      $msg = Tools::judge_test_time(Session::get("startTime", 'test'),Session::get("endTime", 'test'));//判断考试时间
     
      if ($msg ==1) {//时间已过
        self::addsession_answer(false);//添加已做答信息
        $this->redirect('Studentfinish/index');
      }
      else if($msg==-1)//未开始
      {
        $this->error('考试未开始','/stulogin/'.(Session::get("Id", 'test')));
      }
    } else {
      $this->error('考试不存在','/stulogin/'.(Session::get("Id", 'test')));
    }


    if (!Session::has('Id', 'answer')) {//添加做答概述
      self::addsession_answer(true);
    }

    self::initsession_testdetail();//得到未完成的题目信息
  }
  /**
   * 显示题目信息
   */
  public function index()
  {
    $now_pos=Session::get('nowpos', 'index');
    $finishcount=Session::get('finishcount', 'index');
    $testarray=Session::get('testdetail','index');
    

    //post获取提交的题目
    if (request()->post()) {
      $question = $testarray[$now_pos];//得到当前题目信息
      
      $answer = input('post.');
      // dump($question);
      // dump($answer);
      self::handle_add_answerdetail($answer, Session::get('Id', 'answer'), $question);//添加到数据库
      
      unset($testarray[$now_pos]);//删除已完成信息
      Session::set('testdetail',$testarray,'index');

      $now_pos++;//增加当前位置
      Session::set('nowpos',$now_pos ,'index');
      
      $finishcount++;//增加已完成的数量
      Session::set('finishcount', $finishcount, 'index');
    }

    if ( count($testarray)<=0) {
      // Tools::student_deleteSession_exceptanswer();
      $this->redirect('Studentfinish/index'); 
    }
  
  
    $question = $testarray[$now_pos];//获得当前qustion
  
    $this->assign([
      'content' => $question['content'],
      'type' => $question['type'],
      'answers' =>($question['type']==3? $question['answer']:""),
      'time' =>strtotime($question['questionTime']),
      'testName' => Session::get("name",'test'),
      'Num'=>$finishcount+1
    ]);
    return view();
  }


  /**
   * 判断对错，并写入数据库,删除session内已完成的问题
   * @param array  $answer 答案数据
   * @param int $answer_id 答题所在session内id
   * @param array $question 题目信息
   */
  function handle_add_answerdetail($answer, $answer_id, $question)
  {
    //$answerdetail = Session::get('answerdetail', 'index');//获取session内答题
    $data = array();
    $data['thisScore'] = ($answer['answerContent']== $question['right'] ? $question['questionScore'] : 0);//判断做答与原答案是否相同并给予相应分数
    $data['answerId'] = $answer_id;
    $data['answerContent'] = $answer['answerContent'];
    $data['questionId'] = $question['questionId'];
    answerdetail::add_answerdetail($data);
   
    //answerModel::update_score_answere($answer_id,intval($data['thisScore'])); //触发器取代
   
  }
  /**
   * 得到未完成的测试详情信息，写入session
   */
  function initsession_testdetail()
  {
    if (!Session::has('testdetail', 'index')) {
      $testid = Session::get('Id', 'test');
      $answer_id= Session::get('Id',  'answer');
      $res = testquestioin::get_testdetail_undone($answer_id,$testid);//得到未完成的题目和数量 返回一个数组，array($testarray,$finishcount)
    
      $finishcount=$res[1];
      $testarry = Tools::random_testdetail($res[0]);//题目顺序随机

      Session::set('nowpos', 0, 'index');//当前题目位置
      Session::set('testdetail', $testarry, 'index');//未完成的数组
      Session::set('finishcount', $finishcount, 'index');//当前已完成数量
    }
  }
 
  /**
   * 初始化，判断数据库内是否存在相应答题概略，存在则取出，不存在则创建,f为false则不创建
   * @param array $data {studentId,score,testId}
   * @return 'Id', 'answer'
   */
  function addsession_answer($f)
  {
    $data = array();
    $data['studentId'] = Session::get('Id', 'student');//prefix参数为前缀，有无是有区别的
    $data['testId'] = Session::get('Id', 'test');
    $data['score'] = 0;
    $answer = answerModel::get_answer_by_testid_stuid($data["testId"], $data["studentId"]);//获取答题信息
    if (!$answer&&$f) {
      answerModel::add_answere($data);
      $answer = answerModel::get_answer_by_testid_stuid($data["testId"], $data["studentId"]);
    }
    if($answer)
    {
      Session::set('Id', $answer['Id'], 'answer');
      Session::set('score', $answer['score'], 'answer');
    }
  }
  

}