<?php
/**
 * User:goodtimp
 * LastDate:2018/11/21
 */

 namespace app\index\model;
 use think\Model;
 class teacher extends Model{
   /**
    * 根据教师id或者name或者loginId 获取教师信息
    * @param int $tid
    * @return array {Id,name,password,loginId} or null
    */
    public static function get_teacher($tid=0){
      $res=db("teacher")->where("Id",$tid)->select();
      if(!$res)
      {
        $res=db("teacher")->where("name",$tid)->select();
      }
      if(!$res)
      {
        $res=db("teacher")->where("loginId",$tid)->select();
      }
      if($res)
      {
        static $arr=array();
        $temp_arr=array();
        foreach($res as $row)
        {
          $temp_arr['Id']=$row['Id'];
          $temp_arr['name']=$row['name'];
          $temp_arr['password']=$row['password'];
          $temp_arr['loginId']=$row['loginId'];
        }
        return $arr;
      }
      else return null;
    }
    /**
    * 添加教师
    * @param array tearch{Id,name,password,loginId}
    * @return int  0:loginId重复 -1:name重复
    */
    public static function add_teachere($tearch){
      $res=db("teacher")->where("loginId",$tearch["loginId"])->select();
      if($res)
      {
        return 0;
      }
      $res=db("teacher")->where("name",$tearch["name"])->select();
      if($res)
      {
        return -1;
      }
      
      return db("teacher")->insert($tearch);
    }
   
    
 }