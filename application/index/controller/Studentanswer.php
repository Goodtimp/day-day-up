<?php

/**
 * User:goodtimp
 * LastDate:2018/11/22
 */

namespace app\index\controller;

use app\index\model\answer as answer;
use think\Controller;
use app\index\model\testquestion as testquestioin;
use app\index\model\answerdetail as answerdetail;
use think\Paginator;
use think\facade\Session;
use app\index\model\question;

class Studentanswer extends Controller
{

  /**
   * 初始化 answer，testdetail等session信息
   */
  function initialize()
  {
    if (!Session::has('student_Id', 'index')) {
      $this->redirect('Studentlogin/index');
    }
    self::initsession_testdetail();
    if (!Session::has('answer_id', 'index')) {
      $data = array();
      $data['studentId'] = Session::get('student_Id', 'index');//prefix参数为前缀，有无是有区别的
      $data['testId'] = Session::get('test_Id', 'index');
      $data['score'] = 0;
      self::addsession_answer($data);
    }
    self::initsession_answerdetail();
  }
  /**
   * 显示题目信息
   */
  public function index()
  {

    $answer_pos = Session::get('now_answer_id', 'index');//当前测试位置


    $testarray = Session::get('testdetail', 'index');//获取所有题目信息
    if (request()->post()) {//获取提交的题目
      $next_answer_pos = self::next_question($answer_pos + 1);//寻找下一个未完成的测试
      $question = $testarray[$answer_pos];
      $answer = input('post.');
      // dump($question);
      // dump($answer);
      self::handle_add_answerdetail($answer, Session::get('answer_id', 'index'), $question);//添加到数据库，并且添加到session

      Session::set('now_answer_id', $next_answer_pos, 'index');//在这里修改，防止中途退出少答题
    }
    $answer_pos = Session::get('now_answer_id', 'index');//当前测试位置
    // dump(Session::get("answer_score", "index"));
    if ($answer_pos == -1) {
      $score = (string)Session::get("answer_score", "index");
      return "考试结束,您的分数为" . $score;
    }

    $question = $testarray[$answer_pos];//获得当前qustion

    $this->assign([
      'content' => $question['content'],
      'type' => $question['type'],
      'time' =>strtotime($question['questionTime']),
      'Num'=>$answer_pos
    ]);
    return view();
  }

  /**
   * 得到下一个测试信息
   * @param int $answer_pos 当前做答pos
   */
  function next_question($answer_pos)
  {
    $testdetail = Session::get('testdetail', 'index');
    $answerdetail = Session::get('answerdetail', 'index');

    $lentest = count($testdetail);
    for ($answer_pos; $answer_pos < $lentest; $answer_pos++) {
      if ($answerdetail) {
        $lenanswer = count($answerdetail);
        $testqid = $testdetail[$answer_pos]["questionId"];//当前遍历的问题Id
        for ($j = 0; $j < $lenanswer; $j++) {
          $answerqid = $answerdetail[$j]["questionId"];//获取question已完成的问题Id

          if ($answerqid == $testqid) {//如果相同代表已经答过
            break;
          }
        }
        if ($j == $lenanswer)//判断找不到相同的就返回当前位置
        {
          return $answer_pos;
        }
      } else return $answer_pos;
    }
    if ($answer_pos == $lentest)// 答题结束
    {
      return -1;
    }
  }
  /**
   * 判断对错，并写入数据库和session
   * @param array  $answer 答案数据
   * @param int $answer_id 答题所在session内id
   * @param array $question 题目信息
   */
  function handle_add_answerdetail($answer, $answer_id, $question)
  {
    //$answerdetail = Session::get('answerdetail', 'index');//获取session内答题
    $lenanswer = count(Session::get('answerdetail', 'index'));//得到已完成答题信息的长度，便于添加
    $data = array();
    $data['thisScore'] = ($answer['answerContent'] == $question['answer'] ? $question['questionScore'] : 0);//判断做答与原答案是否相同并给予相应分数
    $data['answerId'] = $answer_id;
    $data['answerContent'] = $answer['answerContent'];
    $data['questionId'] = $question['Id'];
    answerdetail::add_answerdetail($data);

    Session::set("answerdetail." . (string)$lenanswer, $data, 'index');//添加到已完成答题的末尾
    $score = Session::get("answer_score", 'index');
    Session::set("answer_score", $score + $data['thisScore'], 'index');
  }
  /**
   * 得到测试详情信息，写入session
   */
  function initsession_testdetail()
  {
    if (!Session::has('test_Id', 'index') || !Session::has('student_Id', 'index')) {
      return false;
    } else if (!Session::has('testdetail', 'index')) {
      $testid = Session::get('test_Id', 'index');
      $testarry = testquestioin::get_testquestions($testid);
      $testarry = self::random_testdetail($testarry);

      Session::set('testdetail', $testarry, 'index');
      Session::set('now_answer_id', 0, 'index');//从-1开始判断为起始位置
      Session::set('next_answer_id', 0, 'index');//从-1开始判断为起始位置
    }

  }
  /**
   * 添加做答详情信息初始化，写入session，不写入数据库
   */
  function initsession_answerdetail()
  {
    if (!Session::has('test_Id', 'index') || !Session::has('student_Id', 'index') || !Session::has('testdetail', 'index')) {
      return false;
    } else if (!Session::has('answerdetail', 'index')) {
      $answer_id = Session::get('answer_id', 'index');
      $testarry = answerdetail::get_answerdetail_by_aid($answer_id);
      Session::set('answerdetail', $testarry, 'index');
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