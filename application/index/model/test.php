<?php

/**
 * User:goodtimp
 * LastDate:2018/11/21
 */

namespace app\index\model;

use think\Model;

class test extends Model
{
  /**
   * 根据课程id得到所有测试
   * @param int $courid
   * @return array {Id,courseId,name,startTime,endTime}
   */
  public static function get_test($courid = 0)
  {

    $res = db("test")->where("courseId", $courid)->select();


    static $arr = array();
    $temp_arr = array();
    foreach ($res as $row) {
      $temp_arr['Id'] = $row['Id'];
      $temp_arr['courseId'] = $row['courseId'];
      $temp_arr['name'] = $row['name'];
      $temp_arr['startTime'] = $row['startTime'];
      $temp_arr['endTime'] = $row['endTime'];
    }
    return $arr;

  }
  /**
   * 添加测试
   * @param array test {Id,courseId,name,startTime,endTime}
   */
  public static function add_teste($test)
  {
    return db("test")->insert($test);
  }
    /**
   * 删除测试
   * @param int testid 
   */
  public static function delete_test($testid)
  {
    return db("test")->where("Id",$testid)->delete();
  }
    /**
   * 删除多个测试
   * @param array testids
   */
  public static function delete_testes($testids)
  {
    return db("test")->delete($testids);
  }


}