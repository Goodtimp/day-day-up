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
   * @return array {sno,name}
   */
  public static function get_student()
  {

    $res = db("student")->select();

    static $arr = array();
    $temp_arr = array();
    foreach ($res as $row) {
      $temp_arr['sno'] = $row['sno'];
      $temp_arr['name'] = $row['name'];
    }
    return $arr;

  }
  /**
   *  添加学生
   * @param array student {sno,name}
 
   */
  public static function add_studente($student)
  {
    return db("student")->insert($student);
  }

}