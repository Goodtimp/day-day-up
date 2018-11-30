<?php
/**
 * User:goodtimp
 * LastDate:2018/11/21
 */

 namespace app\index\model;
 use app\index\model\answerdetail;
 use think\Model;
 class testdetail extends Model{
   /**
    * 根据测试id，得到测试详情
    * @param int $tid
    * @return array {Id,testId,questionId,questionScore,questionTime}
    */
    public static function get_testdetail($tid=0){
      $res=db("testdetail")->where("testId",$tid)->select();
      // static $arr=array();
      // $temp_arr=array();
      // foreach($res as $row)
      // {
      //   $temp_arr['Id']=$row['Id'];
      //   $temp_arr['testId']=$row['testId'];
      //   $temp_arr['questionId']=$row['questionId'];
      //   $temp_arr['questionScore']=$row['questionScore'];
      //   $temp_arr['questionTime']=$row['questionTime'];
      //   $arr[] = $temp_arr; 
      // }
      return $res;
    }
    /**
    * 添加测试详情
    * @param array cour{Id,testId,questionId,questionScore,questionTime}
    */
    public static function add_testdetail($data){
      return db("testdetail")->insert($data);
    }
    /**
    * 根据测试详情的questionid和 testid，删除一个测试详情
    * @param int tdid
    */
    public static function delete_testdetail($tid,$qid){
      return db("testdetail")->where("questionId",$qid)->where("testId",$tid)->delete();
    }
     /**
    * 根据测试详情id，删除多个测试详情
    * @param array tdids
    */
    public static function delete_testdetails($tdids){
      return db("testdetail")->delete($tdid);
    }
     /**
    * 更新数据
    * @param int $id
    * @param array $data
    */
    public static function updata_testdetails($test_id,$question_id,$data)
    {
      return db("testdetail")->where("testId",$test_id)->where("questionId",$question_id)->update([
        'questionScore'=>$data["questionScore"],
      'questionTime'=>$data["questionTime"]
      ]);
    }
    
 }