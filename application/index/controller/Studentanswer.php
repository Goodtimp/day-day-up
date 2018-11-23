<?php

/**
 * User:goodtimp
 * LastDate:2018/11/22
 */

namespace app\index\controller;

use app\index\model\answer as answer;
use think\Controller;
use app\index\model\testquestion as testquestioin;
use think\Paginator;
use app\index\model\answerdetail;
use think\facade\Session;//tp5封装好的Session，貌似比原生的要优一点

class Studentanswer extends Controller
{

  /**
   * 初始化 answer，testdetail等session信息
   */
  function initialize()
  {
    if(!Session::has('student_Id','index'))
    {
      $this->redirect('Studentlogin/index');
    }
    self::addsession_testdetail();
    if(!Session::has('answer_id','index'))
    {
      $data=array();
      $data['studentId']=Session::get('student_Id','index');
      $data['testId']=Session::get('test_Id','index');
      $data['score']=0;
      self::addsession_answer($data);
    }
  }
  /**
   * 显示题目信息
   */
  public function index()
  {
    $answer_id = Session::get('now_answer_id','index');
    $testarray = Session::get('testdetail','index');
    dump($testarray);
    $question = $testarray[$answer_id];
    if (request()->post()) {
      $answer = input('post.');
      self::handle_add_answerdetail($answer,Session::get('answer_id','index'), $question);
    }
    $question = $testarray[$answer_id];
    
    $this->assign([
      'content' => $question['content'],
      'type' => $question['type']
    ]);
    return view();
  }

  /**
   * 判断对错，并写入数据库和session
   * @param array  $answer 答案数据
   * @param int $answer_id 答题所在session内id
   * @param array $question 题目信息
   */
  function handle_add_answerdetail($answer, $answer_id, $question)
  {
    $data = array();
    $data['thisScore'] = $answer['answerContent'] == $question['answer']?$question['questionScore']:0;//判断做答与原答案是否相同并给予相应分数
    $data['answerId'] = $answer_id;
    $data['answerContent'] = $answer['answerContent'];
    $data['questionId'] = $question['Id'];
    answerdetail::add_answerdetail($data);
    //session[]
  }
  /**
   * 得到测试详情信息，写入session
   */
  function addsession_testdetail()
  {
    if(!Session::has('test_Id','index')||!Session::has('student_Id','index')){
      return false;
    } 
    else if(!Session::has('testdetail','index')){
      $testid = Session::get('test_Id','index');
      $testarry = testquestioin::get_testquestions($testid);
      $testarry = self::random_testdetail($testarry);
      
      Session::set('testdetail', $testarry, 'index');
      Session::set('now_answer_id', 0, 'index');
    }
  
  }
  /**
   * 判断数据库内是否存在相应答题概略，存在则取出，不存在则创建
   * @param array $data {studentId,score,testId}
   * @return 'answer_score' 'answer_id'
   */
  function addsession_answer($data)
  {
    $answer = answer::get_answer_by_testid_stuid($data["testId"], $data["studentId"]);//获取答题信息
    if (!$answer) {
      answer::add_answere($data);
      $answer = answer::get_answer_by_testid_stuid($data["testId"], $data["studentId"]);
    }
    Session::set('answer_id', $answer[0]['Id'], 'index');
    Session::set('answer_score', $answer[0]['score'], 'index');
  }
  /**
   * 随机打乱测试详情信息
   */
  function random_testdetail($detailsarray)
  {
    $len = count($detailsarray);
    for ($i = 0; $i < $len; $i++) {
      $rand = rand(0, $len - 1);
      $temp = $detailsarray[$i];
      $detailsarray[$i] = $detailsarray[$rand];
      $detailsarray[$rand] = $temp;
    }
    return $detailsarray;
  }

}