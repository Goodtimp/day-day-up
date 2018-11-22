<?php

/**
 * User:goodtimp
 * LastDate:2018/11/21
 */

namespace app\index\model;

use think\Model;

class helper extends Model
{
  /**
   * 根据教师id得到所有班助
   * @param int $tid
   * @return array {Id,name,password,loginId,teacherId}
   */
  public static function get_helper($tid)
  {

    $res = db("helper")->where("teacherId", $tid)->select();

    static $arr = array();
    $temp_arr = array();
    foreach ($res as $row) {
      $temp_arr['Id'] = $row['Id'];
      $temp_arr['password'] = $row['password'];
      $temp_arr['name'] = $row['name'];
      $temp_arr['loginId'] = $row['loginId'];
      $temp_arr['teacherId'] = $row['teacherId'];
    }
    return $arr;

  }
  /**
   *  添加班助
   * @param array helper {Id,name,password,loginId,teacherId}
   * @return int  0:loginId重复 -1:name重复
   */
  public static function add_helpere($helper)
  {
    $res = db("helper")->where("loginId", $helper["loginId"])->select();
    if ($res) {
      return 0;
    }
    $res = db("helper")->where("name", $helper["name"])->select();
    if ($res) {
      return -1;
    }
    return db("helper")->insert($helper);
  }
  /**
   * 删除一个班助信息 
   * @param int helperid 
   */
  public static function delete_helper($helperid)
  {
    return db("helper")->where("Id", $helperid)->delete();
  }
  /**
   * 删除多个班助信息
   * @param array helperids
   */
  public static function delete_helperes($helperids)
  {
    return db("helper")->delete($helperids);
  }


}