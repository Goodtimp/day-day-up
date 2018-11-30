<?php

/**
 * User:goodtimp
 * LastDate:2018/11/29
 */


namespace app\index\controller;
use app\index\model\test as testModel;
use app\index\model\mymodel as myModel;
use app\index\controller\Tools as Tools;
use think\Controller;
use think\facade\Session;
use think\helper\Time;

class Answer extends Father
{
  public function index()
  {
    $testid = input("get.id");
   
    $test=testModel::get_test($testid);
    if($test)
    {
      $answer = myModel::get_answer($testid);
      $answer=Tools::sort_array($answer,"score");       
      
      $this->assign([
        "testname" => $test["name"],
        "testid"=>$test["Id"],
        "answers"=>$answer
      ]);
    }
    else {
      $this->assign([
        "testname" => "",
        "testid"=>"0",
        "answers"=>""
      ]);
    }
    return view();
  }
 /**
   * 测试导出测试详情excel
   */
  public function excel()
  {
    $testid = input("get.id");
    $test=testModel::get_test($testid);
    if($test)
    {
      $name = $test["name"];
    }
   
    $header = ['学号','姓名','分数'];
    $answer = myModel::get_answer($testid);
    $answer=Tools::sort_array($answer,"score");
    $data=array();
    $temp=array();
    foreach($answer as $row)
    {
      $temp["sno"]=$row["sno"];
      $temp["name"]=$row["name"];
      $temp["score"]=$row["score"];
      $data[]=$temp;
    }
 
    Tools::excelExport($name, $header, $data);
  }
}