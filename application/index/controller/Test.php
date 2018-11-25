<?php

/**
 * User:goodtimp
 * LastDate:2018/11/24
 */


namespace app\index\controller;

use app\index\model\test as tests;
use app\index\model\testdetail as testdetail;

use think\Controller;
use think\facade\Session;
use think\helper\Time;
class Test extends Father
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