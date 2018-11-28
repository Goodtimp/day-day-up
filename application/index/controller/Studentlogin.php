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
use think\facade\Session;
use app\index\controller\Tools;

class Studentlogin extends Controller
{
  function initialize()
  {
    Tools::deleteSession();
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
     // dump($data);
      if(student::add_student($data))//不存在则将学生信息加入到数据库
      {
        $stu=student::get_student($data["sno"],$data["name"]);
        // 将登陆信息保存到session，登陆成功
        //dump($stu);
        Session::set('Id',$stu['Id'],'student');// prefix:'index'是指作用域是index部分
        Session::set('sno',$stu['sno'],'student');
        Session::set('name',$stu['name'],'student');

        $this->redirect('Studentanswer/index');
      }
      // 需修改
      // else{
      //   $this->error("请重新输入",'login/index',$wait=1);
      // }
      
    }

    $this->assign([
      "testName"=>Session::get("name",'test'),
    ]);
    return view();
  }
  /**
   * 得到测试信息，并存入session（减少访问数据库次数）
   */
  function get_test_message($id){
    //if(!session('test_Id','','index'))
    if(!Session::has('Id','test'))
    {
      $data=test::get_test($id);
      if($data)
      { 
        Session::set('Id',$data["Id"],'test');
        Session::set('courseId',$data["courseId"],'test');
        Session::set('name',$data["name"],'test');
        Session::set('startTime',strtotime($data["startTime"]),'test');
        Session::set('endTime',strtotime($data["endTime"]),'test');
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
    if(Session::has("Id",'index'))
    {
      $now_time=time();
      $start_time=Session::get("startTime",'test');
      $end_time=Session::get("endTime",'test');
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