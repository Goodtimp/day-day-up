<?php

/**
 * User:goodtimp
 * LastDate:2018/11/24
 */


namespace app\index\controller;

use think\Controller;
use think\facade\Session;
use think\helper\Time;
use app\index\model\mymodel as myModel;//记录一下错误 如果修改称courses与控制器内Course冲突

class Moblie extends Father
{
  public function index()
  {
    $arr=myModel::get_coursetest(Session::get("Id", 'teacher'));
    $this->assign([
      "arr"=>$arr,
    ]);
    return view();
  }

}