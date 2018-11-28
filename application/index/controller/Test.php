<?php

/**
 * User:goodtimp
 * LastDate:2018/11/27
 */


namespace app\index\controller;

use app\index\Model\testdetail as testdetailModel;
use app\index\controller\Tools as Tools;

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
  public function add()
  {
    if (request()->post()) {
      $data = input("post.");
      $test_id = testModel::add_test($data);

      if ($test_id > 0) {
        $this->redirect('/day-day-up/public/index.php/index/Test/editortest?id='.$test_id); //需修改
      } else {
        $this->error("未知因素,添加失败");
      }
    }
    return view();
  }
  
  public function adddetail(){
    if (request()->post()) {
      $data = input("post.");
      $question_data = Tools::testdetail_modelquestion($data);
      //dump($question_data);
      $data["question_id"]=questionModel::add_question($question_data);
      //$data["question_id"] = 1;//测试数据，保证程序正常运行
      if ($data["question_id"] != 0) {
        $test_detail = Tools::testdetail_modeltestdetail($data);
        //dump($test_detail);
        testdetailModel::add_testdetail($test_detail);
      }
      $test_id=$data["test_id"];
      $this->redirect('/day-day-up/public/index.php/index/Test/editortest?id='.$test_id);
    }
  }
  public function editordetail(){
    if (request()->post()) {
      $data = input("post.");
      $question_data = Tools::testdetail_modelquestion($data);
      // $data["question_id"]=questionModel::add_question($question_data);
      $data["question_id"] = 1;//测试数据，保证程序正常运行
      if ($data["question_id"] != 0) {
        $test_detail = Tools::testdetail_modeltestdetail($data);
        //dump($test_detail);
        //testdetailModel::updata_testdetails($data["test_detail_id"],$test_detail);//更新数据库，需要测试详情id，更新数据
      }
      $test_id=$data["test_id"];
      $this->redirect('/day-day-up/public/index.php/index/Test/editortest?id='.$test_id);
    }
  }
  public function deletedetail(){
    if (request()->post()) {
      $data = input("post.");
      $test_detail = testdetailModel::delete_testdetail($data["test_detail_id"]);
      $test_id=$data["test_id"];
      $this->redirect('/day-day-up/public/index.php/index/Test/editortest?id='.$test_id);
    }
  }
  /**
   * 添加测试题目
   */
  public function editortest()
  {
    $test_id = input("get.id");
    // dump($test_id);
    $test = testModel::get_test($test_id);//获取测试信息
   
    if ($test) {
      $test_detail = testquestionModel::get_testquestions($test_id);//获取测试详情信息
    
      $this->assign([
        'test' => $test,
      ]);
      $this->assign([
        'testdetail' => $test_detail
      ]);
      
     // dump($test);
      //dump($test_detail);
    }

    return view();
  }

}