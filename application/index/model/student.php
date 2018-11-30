<?php

/**
 * User:goodtimp
 * LastDate:2018/11/23
 */

namespace app\index\model;

use think\Model;

class student extends Model
{
  /**
   * 所有学生信息
   * @param int $sno
   * @return array  {sno,name,Id}
   */
  public static function get_students()
  {

    $res = db("student")->select();

    // static $arr = array();
    // $temp_arr = array();
    // foreach ($res as $row) {
    //   $temp_arr['sno'] = $row['sno'];
    //   $temp_arr['name'] = $row['name'];
    //   $arr[] = $tmp_arr; 
    // }
    return $res;

  }
   /**
   * 根据sno，name获取学生信息
   * @param string $sno
   * @param string $name
   * @return array  {sno,name,Id}
   */
  public static function get_student($sno,$name)
  {

    $res = db("student")->where('sno',$sno)->where('name',$name)->select();

    $temp_arr = array();
    foreach ($res as $row) {
      $temp_arr['sno'] = $row['sno'];
      $temp_arr['name'] = $row['name'];
      $temp_arr['Id'] = $row['Id'];
    }
    return $temp_arr;

  }
   /**
   * id获取学生信息
   * @param string $id
   * @return array  {sno,name,Id}
   */
  public static function get_student_byId($id)
  {
    $res = db("student")->where('Id',$id)->select();
    if($res) return $res[0];
    return $res;
  }

  /**
   *  添加学生
   * @param array student {sno,name,Id}
   */
  public static function add_student($student)
  {
    $res=db("student")->where("sno",$student["sno"])->select();
    if($res)
    {
      foreach ($res as $row) {
        if($row['name']==$student["name"])
        {
          return true;
        }
      }
    }
    return db("student")->insert($student);
  }

}