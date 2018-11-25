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
class Test extends Father
{
  public function index()
  {
    $test_id = input('get.id');
    if($test_id)
    {
      $test = testModel::get_test($test_id);//根据id获取课程测试
      $test_detail=testdetailModel::get_testdetail($test_id);
      for($i=0;$i<Count($test_detail);$i++){
        $test_detail[$i]["Num"]=$i+1;
        $question=questionModel::get_Question($test_detail[$i]["questionId"]);
        $question_content=explode("OUT",$question["content"]);
        $test_detail[$i]["content"]=$question_content[0];
      }
      $this->assign([
        'test' => $test,
        'test_detail'=>$test_detail
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
   * 添加测试 成功后返回到测试详情页面
   */
  public function addtquestion(){
    $test_id=input("get.id");
    dump($test_id);
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
    if(request()->post())
    {
      $data=input("post.");
      if(tests::add_test($data))
      {
        return $this->redirect('Test/index');
      }
    }
    return view();
  }

}