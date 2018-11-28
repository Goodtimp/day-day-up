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
        $res_question=db("question")->where("Id",$row["questionId"])->select()[0];
        $temp_arr['Id']=$row['Id'];
        $temp_arr['testId']=$row['testId'];
        $temp_arr['questionId']=$row['questionId'];
        $temp_arr['questionScore']=$row['questionScore'];
        $temp_arr['questionTime']=$row['questionTime'];
        //题目详情部分
        $temp_arr['categoryId']=$res_question['categoryId'];
        $temp_arr['content']=$res_question['content'];//约定：选择题选项用 OUT-来表示选项内容 例如:int为几个字节？OUT-: 1 OUT-: 2 OUT-: 4
        $temp_arr['answer']=explode("OUT-:", $res_question['answer']);//正确答案 选择题为：答案 填空题：答案 判断题:T F
        $temp_arr['type']=$res_question['type'];//约定： 1 为填空 ；2为判断；3为选择
        $temp_arr['analysis']=$res_question['analysis'];//题目解析 
        $temp_arr["briefcontent"]=substr($temp_arr['content'],0,60)."...";
        $arr[] = $temp_arr; 
      }
      return $arr;
    }
    /**
     * 根据answerid，testid 获取某学生未作答的答题信息
     */
    public static function get_testdetail_undone($answerid,$testid)
    {
      $answerdetails=answerdetail::get_answerdetail_by_aid($answerid);//得到已完成的测试信息
      $res=self::get_testquestions($testid);//得到全部的测试信息
      $cnt=0;
      $length=count($res);
      foreach($answerdetails as $detail)
      {
        for($i=0;$i<$length;$i++)
        {
          if(isset($res[$i])&&($res[$i]["questionId"]==$detail["questionId"]))
          {
            $cnt++;
            unset($res[$i]);
          }
        }
      }
      $arr=array();
      $j=0;
      if($cnt!=0)//对数组键值对重新排序
      {
        for($i=0;$i<$length;$i++)
        {
          if(isset($res[$i]))
          {
            $arr[$j]=$res[$i];
            $j++;
          }
        }
        return array($arr,$cnt);
      }
      return array($res,$cnt);
    }
 }