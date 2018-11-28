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
      $num=1;
      
      foreach($res_test as $row)
      {
        $res_question=db("question")->where("Id",$row["questionId"])->select()[0];
        $temp_arr['Id']=$row['Id'];
        $temp_arr['testId']=$row['testId'];
        $temp_arr['questionId']=$row['questionId'];
        $temp_arr['questionScore']=$row['questionScore'];
        $temp_arr['questionTime']=$row['questionTime'];
        //题目详情部分
        $temp_arr["num"]=$num++;
        $temp_arr["Score"]=$row["questionScore"];
        $temp_arr["Time"]=$row["questionTime"];
        $temp_arr['categoryId']=$res_question['categoryId'];
        $temp_arr['content']=$res_question['content'];//约定：选择题选项用 OUT-来表示选项内容 例如:int为几个字节？OUT-: 1 OUT-: 2 OUT-: 4
        $temp_arr['answer']=explode("OUT-", $res_question['answer']);//正确答案 选择题为：答案 填空题：答案 判断题:T F
        $temp_arr["right"]=$temp_arr["answer"][0];//用来保存选择题的正确选项
        shuffle($temp_arr["answer"]);//用来打乱选择题的选项
        $temp_arr['type']=$res_question['type'];//约定： 1 为填空 ；2为判断；3为选择
        $temp_arr['analysis']=$res_question['analysis'];//题目解析 
        $temp_arr["briefcontent"]=substr($temp_arr['content'],0,60)."...";
        $arr[] = $temp_arr; 
      }
      return $arr;
    
    
    }
    public static function update_testdetail($testdetail_id,$testdetail){
      return db("testdetail")->where("Id",$testdetail["Id"])->update([
        'questionScore'=>$testdetail["questionScore"],
        'questionTime'=>$testdetail["questionTime"]
      ]);
    }
 }