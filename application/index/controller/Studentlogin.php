<?php

/**
 * User:goodtimp
 * LastDate:2018/11/22
 */
namespace app\index\controller;
use app\index\model\student as student;
use app\index\model\test as test;
use think\Controller;

class Studentlogin extends Controller
{
  public function index()
  {
    $tid=input("get.id");
    if(self::get_test_message($tid))
    {
      $now_time=time();
      $start_time=session("test_startTime",'','index');
      $end_time=session("test_endTime",'','index');
      if($now_time<$start_time)
      {
        return "考试未开始。";
      }
      // else if($now_time > $end_time)
      // {
      //   return "考试已经结束。";
      // }
      return view();
    }
    else {
      return '无此考试';
    }
    if (request()->isPost()) {
      $data = input('post.');
      
      if(student::add_student($data))//不存在则加入
      {
        // 将登陆信息保存到session，登陆成功
        session('sno',$data["sno"],'index');// prefix:'index'是指作用域是index部分
        session('name',$data["name"],'index');// prefix:'index'是指作用域是index部分
        $this->redirect('Studentanswer/index?id='+$tid);
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
}