<?php

/**
 * User:goodtimp
 * LastDate:2018/11/24
 */


namespace app\index\controller;

use app\index\Model\test as tests;
use app\index\Model\testdetail as testdetailModel;

use think\Controller;
use think\facade\Session;
use think\helper\Time;
use app\index\Model\test as testModel;
use app\index\Model\question as questionModel;
use app\index\Model\testquestion as testquestionModel;
class Test extends Father
{
  public function index()
  {
    $test_id = input('get.id');
    if($test_id)
    {
      $test = testModel::get_test(2);//根据id获取课程测试

      $test_question=testquestionModel::get_testquestions($test_id);     
      //dump($test);
      $this->assign([
        'test' => $test,
        'test_question'=>$test_question
      ]);
    }
    return view("index");
  }
  /**
   * 添加测试 成功后返回到测试详情页面
   */
  public function add(){
    if(request()->post())
    {
      $data=input("post.");
      $test=tests::add_test($data);
      
      if($test!=0)
      {        
        $this->redirect('/day-day-up/public/index.php/index/Test/addtquestion?id=1'); //需修改
      }
      else {
        $this->error("未知因素,添加失败");
      }
    }
    return view();
  }
  /**
   * 添加测试题目
   */
  public function addtquestion(){
    if(request()->post())
    {
      $data=input("post.");
      dump($data);
      // if(tests::add_test($data))
      // {
      //   return $this->redirect('Test/index');
      // }
    }
    
    $test_id=input("get.id");
    // dump($test_id);
    $test_detail=testdetail::get_testdetail($test_id);
    $test=tests::get_test($test_id);
    if($test)
    {
      $this->assign([
        'test_name' => $test["name"],
        'test_id' => $test['Id']
      ]); 
      if($test_detail)
      {
        $this->assign([
          'testdetail'=>$test_detail
        ]);
      }
     
    } 
    
    return view();
  }

}