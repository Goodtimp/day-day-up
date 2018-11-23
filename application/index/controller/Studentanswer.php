<?php
/**
 * User:goodtimp
 * LastDate:2018/11/22
 */

namespace app\index\controller;
use app\index\model\answer as answer;
use think\Controller;
use app\index\model\testquestion as testquestioin ;
class Studentanswer extends Controller
{
  public function index()
  {
    self::get_testdetail();
    $answer_id=session('now_answer_id','','index');
    $testarray=session('testdetail','','index');
    $question=$testarray[$answer_id];
    if(request()->post())
    {
      $answer=input('post.');
      slef::handle_add_answerdetail($answer,$answer_id,$question);
    }
    $question=$testarray[$answer_id];
    $this->assign([
        'content'=>$question['content'],
        'type'=>$question['type']
      ]);
    return view();
  }
  /**
   * 判断对错，并写入数据库
   * @param array 答案数据
   * @param int 答题所在session内id
   * @param array 题目信息
   */
  function handle_add_answerdetail($answer,$answer_id,$question)
  {
    $data=array();
    if($answer['answerContent']=$question['answer'])
    {
      $data['thisScore']=$question['questionScore'];
    }
    $data['answerContent']=$answer['answerContent'];
    $data['questionId']=$question['questionId'];
  }
  /**
   * 得到测试详情信息，写入session
   */
  function get_testdetail()
  {
    if(!session('test_Id','','index')||! session('sno','','index'))
    {
      return false;
    }
    else if(!session('testdetail','','index')) {
      $testid=session('test_Id','','index');
      $testarry=testquestioin::get_testquestions($testid);
      $testarry=self::random_testdetail($testarry);
   
      session('testdetail',$testarry,'index');
      session('now_answer_id',0,'index');
    }
  }
  /**
   * 添加答题概略信息
   * @param array $data {studentId,score,testId}
   */
  function add_answer($data){
    $answer=answer::get_answer_by_testid_stuid($data["testId"],$data["studentId"]);//获取答题信息
    if(!$answer)
    {
      answer::add_answere($data);
      $answer=answer::get_answer_by_testid_stuid($data["testId"],$data["studentId"]);
      session('answer',$answer,'index');
    }
    if(!session('answer','','index'))
    {
      session('answer',$answer,'index');
    }
  }
  /**
  * 随机打乱测试详情信息
  */
  function random_testdetail($detailsarray){
    $len=count($detailsarray);
    for($i=0;$i<$len;$i++)
    {
      $rand=rand(0,$len-1);
      $temp=$detailsarray[$i];
      $detailsarray[$i]=$detailsarray[$rand];
      $detailsarray[$rand]=$temp;
    }
    return $detailsarray;
  }

}