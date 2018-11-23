<?php

/**
 * User:goodtimp
 * LastDate:2018/11/22
 */
namespace app\index\controller;
use app\index\model\student as student;
use app\index\model\test as test;
use think\Controller;
use think\Paginator;

class Studentlogin extends Controller
{
  function initialize()
  {
    if(session('student_Id','','index')&&session('test_Id', '', 'index'))
    {
      $this->redirect('Studentanswer/index');
    }
  }
  public function index()
  {
    $tid=input("get.id");
    if(self::get_test_message($tid))
    {
      $msg=self::judge_test_time();
      if($msg!="")
      {
        return $msg;
      }
    }
    else {
      return '无此考试';
    }
    if (request()->isPost()) {
      $data = input('post.');
      
      if(student::add_student($data))//不存在则将学生信息加入到数据库
      {
        $stu=student::get_student($data["sno"],$data["name"]);
        // 将登陆信息保存到session，登陆成功
        session('student_Id',$stu['Id'],'index');// prefix:'index'是指作用域是index部分
        session('student_sno',$stu['sno'],'index');
        session('student_name',$stu['name'],'index');
        $this->redirect('Studentanswer/index');
      }
      // 需修改
      // else{
      //   $this->error("请重新输入",'login/index',$wait=1);
      // }
      
    }
    return view();
  }
  /**
   * 得到测试信息，并存入session（减少访问数据库次数）
   */
  function get_test_message($id){
    if(!session('test_Id','','index'))
    {
      $data=test::get_test($id);
      if($data)
      {
        session('test_Id',$data["Id"],'index');
        session('test_courseId',$data["courseId"],'index');
        session('test_name',$data["name"],'index');
        session('test_startTime',strtotime($data["startTime"]),'index');
        session('test_endTime',strtotime($data["endTime"]),'index');
      }
      else{
        return false;
      }
    }
    return true;
  }
  /**
   * 判断考试时间
   */
  function judge_test_time(){
    if(session('test_Id','','index'))
    {
      $now_time=time();
      $start_time=session("test_startTime",'','index');
      $end_time=session("test_endTime",'','index');
      if($now_time<$start_time)
      {
        return "考试未开始。";
      }
      //  else if($now_time > $end_time)
      //  {
      //    return "考试已经结束。";
      //  }
    }
   
    return "";
  }
}