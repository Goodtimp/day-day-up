<?php
/**
 * User:goodtimp
 * LastDate:2018/11/23
 */

 namespace app\index\model;
 use app\index\model\testdetail as testdetail;
 use app\index\model\answerdetail as answerdetail;
 use think\Model;
 class testquestion extends Model{
   /**
    * 根据测试id，得到测试问题详情
    * @param int $tid
    * @return array {Id,testId,questionId,questionScore,questionTime,categoryId,content,answer,analysis,type}
    */
    public static function get_testquestions($tid=0){
      $res_test=db("testdetail")->where("testId",$tid)->select();
      static $arr=array();
      $temp_arr=array();
      foreach($res_test as $row)
      {
        $res_question=db("question")->where("Id",$row["questionId"])->select();
        $temp_arr['Id']=$row['Id'];
        $temp_arr['testId']=$row['testId'];
        $temp_arr['questionId']=$row['questionId'];
        $temp_arr['questionScore']=$row['questionScore'];
        $temp_arr['questionTime']=$row['questionTime'];
        //题目详情部分
        $temp_arr['categoryId']=$res_question[0]['categoryId'];
        $temp_arr['content']=$res_question[0]['content'];//约定：选择题选项用 OUT-A:来表示A选项内容 OUT-B:来表示B选项内容，例如:int为几个字节？OUT-A: 1 OUT-B: 2 OUT-C: 4
        $temp_arr['answer']=$res_question[0]['answer'];//正确答案 选择题为：A B C ... 填空题：答案 判断题:T F
        $temp_arr['type']=$res_question[0]['type'];//约定： 1 为填空 ；2为判断；3为选择
        $temp_arr['analysis']=$res_question[0]['analysis'];//题目解析 
        $arr[] = $temp_arr; 
      }
      return $arr;
    }
 }