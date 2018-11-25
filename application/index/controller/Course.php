<?php

/**
 * User:goodtimp
 * LastDate:2018/11/24
 */


namespace app\index\controller;

use app\index\model\course as courses;//记录一下错误 如果修改称courses与控制器内Course冲突
use think\Controller;
use think\facade\Session;
use think\helper\Time;
class Course extends Father
{
  public function index()
  {
    $cou_id = input('get.id');
    if($cou_id)
    {
   //参数
    }
    return view();
  }
  public function add(){
    if(request()->post())
    {
      $data=input("post.");
      $data["teacherId"]=Session::get("Id", 'teacher');
    
      self::add_course($data);
    }
    return view();
  }
  private function add_course($data)
  {
    $cou = new courses();
    $cou->name = $data['name'];
    $cou->teacherId = $data['teacherId'];
    $cou->save();
  }
}