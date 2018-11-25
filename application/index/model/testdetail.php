<?php
/**
 * User:goodtimp
 * LastDate:2018/11/21
 */

 namespace app\index\model;
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
    public static function add_testdetail($cour){
      return db("testdetail")->insert($cour);
    }
    /**
    * 根据测试详情id，删除一个测试详情
    * @param int tdid
    */
    public static function delete_testdetail($tdid){
      return db("testdetail")->where("Id",$tdid)->delete();
    }
     /**
    * 根据测试详情id，删除多个测试详情
    * @param array tdids
    */
    public static function delete_testdetails($tdids){
      return db("testdetail")->delete($tdid);
    }
    
 }