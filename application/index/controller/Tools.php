<?php

/**
 * User:goodtimp
 * LastDate:2018/11/27
 * explain:封装一些需要用到的函数
 */


namespace app\index\controller;


class Tools
{
  /**
   * 判断题
   */
  private static function question_modelquestion_checking($data){
    $res=array();
    $res["answer"]=($data["true_answer"]=="1"?"T":"F");//获取正确答案
    $res["type"]=$data["type"];
    //$res["analysis"]=$data["analysis"];//获取分析数据
    $res["content"]=$data["content"];//获取content
    return $res;
  }
  /**
   * 填空题
   */
  private static function question_modelquestion_completion($data){
    $res=array();
   // $res["analysis"]=$data["analysis"];//获取分析数据
    $res["answer"]=$data["true_answer"];//获取正确答案
    $res["type"]=$data["type"];
    $res["content"]=$data["content"];//获取content
    return $res;
  }
  /**
   * 选择题
   */
  private static function question_modelquestion_choise($data){
    $res=array();
    //$res["analysis"]=$data["analysis"];//获取分析数据
    
    $answer=$data["true_answer"];//获取正确选项并加入答案描述，默认第一个选项为正确，用‘OUT-’分割
    for($i=1;$i<=intval($data["false_number"]);$i++)//判断错误选项的数量
    {
      $answer=$answer." OUT-:".$data[("false_answer_".strval($i))];//获得错误选项并加入答案描述
    }
    $res["type"]=$data["type"];
    $res["content"]=$data["content"];
    $res["answer"]=$answer;
    return $res;
  }
  /*
  * 前端添加测试题目数据转换称添加至数据库question表的数据。
  */
  public static function testdetail_modelquestion($data){
    if($data["type"]=="3")
    {
      return self::question_modelquestion_choise($data);
    }
    else if($data["type"]=="2")
    {
      return self::question_modelquestion_checking($data);
    }
    else 
    {
      return self::question_modelquestion_completion($data);
    }
  }
  
  /*
  * 前端添加测试题目数据转换称添加至数据库question表的数据。
  */
  public static function testdetail_modeltestdetail($data){
    $res=array();
    $res["testId"]=$data["test_id"];
    $res["questionId"]=$data["question_id"];
    $res["questionScore"]=$data["score"];
    $minute=intval($data["time"][0].$data["time"][1]);
    $second=intval($data["time"][3].$data["time"][4]);
  
   // $res["questionTime"]=mktime(8,$minute,$second,1,1,1970);//1970-1-1 08：00为初始日期 果断弃用
   $res["questionTime"]=($minute*60+$second);
    return $res;
  }


}