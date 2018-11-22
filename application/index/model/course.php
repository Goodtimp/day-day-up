<?php
/**
 * User:goodtimp
 * LastDate:2018/11/21
 */

 namespace app\index\model;
 use think\Model;
 class course extends Model{
   /**
    * 根据教师id，得到所有的课程信息
    * @param int $tid
    * @return array {Id,teacherId,createTime}
    */
    public static function get_course($tid=0){
      $res=db("course")->where("teacherId",$tid)->select();
      static $arr=array();
      $temp_arr=array();
      foreach($res as $row)
      {
        $temp_arr['Id']=$row['Id'];
        $temp_arr['teacherId']=$row['teacherId'];
        $temp_arr['createTime']=$row['createTime'];
      }
      return $arr;
    }
    /**
    * 添加课程
    * @param array cour{Id,teacherId,createTime}
    */
    public static function add_course($cour){
      return db("course")->insert($cour);
    }
    /**
    * 删除一个课程
    * @param int courid
    */
    public static function delete_course($courid){
      return db("course")->where("Id",$courid)->delete();
    }
    
 }