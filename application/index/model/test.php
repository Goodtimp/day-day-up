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
  public static function get_tests($courid = 0)
  {

    $res = db("test")->where("courseId", $courid)->select();
    for($i=0;$i<Count($res);$i++){
      $time=Time()-strtotime($res[$i]["endTime"]);
    if($time<0)  $res[$i]["status"]="未完成";
    else{
      $res[$i]["status"]="已完成";
    }
    }

    // static $arr = array();
    // $temp_arr = array();
    // foreach ($res as $row) {
    //   $temp_arr['Id'] = $row['Id'];
    //   $temp_arr['courseId'] = $row['courseId'];
    //   $temp_arr['name'] = $row['name'];
    //   $temp_arr['startTime'] = $row['startTime'];
    //   $temp_arr['endTime'] = $row['endTime'];
    //   $arr[] = $tmp_arr; 
    // }
    return $res;

  }
  /**
   * 根据测试id得到测试信息
   * @param int $courid
   * @return array {Id,courseId,name,startTime,endTime}
   */
  public static function get_test($testid)
  {

    $res = db("test")->where("Id", $testid)->select()[0];

    return $res;
  }
  /**
   * 添加测试
   * @param array test {Id,courseId,name,startTime,endTime}
   */
  public static function add_test($test)
  {
   return db("test")->insertGetId($test);
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