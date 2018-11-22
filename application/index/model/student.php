<?php

/**
 * User:goodtimp
 * LastDate:2018/11/21
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
  public static function get_student()
  {

    $res = db("student")->select();

    static $arr = array();
    $temp_arr = array();
    foreach ($res as $row) {
      $temp_arr['sno'] = $row['sno'];
      $temp_arr['name'] = $row['name'];
      $arr[] = $tmp_arr; 
    }
    return $arr;

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