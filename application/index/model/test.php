<?php

/**
 * User:goodtimp
 * LastDate:2018/11/21
 */

namespace app\index\model;

use think\Model;

class test extends Model
{
  /**验证老师对于测试是否合法 */
  public static function verify($teachid, $testid)
  {
    $cou = db("test")->where("Id", $testid)->select();
    if ($cou) {
      $res = db("course")->where("Id", $cou[0]["courseId"])->select();
 
      if ($res) {
        return $res[0]["teacherId"] == $teachid;
      }
      return 1;
    }
    return 0;
  }
  static function get_status($starttime,$endtime)
  {
    $stime = strtotime($starttime);
    $etime = strtotime($endtime);
    $time = Time();
    if ($time < $stime) return "未开始";
    else if ($time > $etime) {
      return "已结束";
    } else {
     return  "进行中";
    }
  }
  /**
   * 根据课程id得到所有测试
   * @param int $courid
   * @return array {Id,courseId,name,startTime,endTime}
   */
  public static function get_tests($courid = 0)
  {

    $res = db("test")->where("courseId", $courid)->select();
    for ($i = 0; $i < Count($res); $i++) {
     $res[$i]["status"] =self::get_status($res[$i]["startTime"],$res[$i]["endTime"]); 
    }

    return $res;

  }

  /**
   * 根据测试id得到测试信息
   * @param int $courid
   * @return array {Id,courseId,name,startTime,endTime}
   */
  public static function get_test($testid)
  {
    $res = db("test")->where("Id", $testid)->select();
    if ($res) {
      $res[0]["status"] =self::get_status($res[0]["startTime"],$res[0]["endTime"]); 
      return $res[0];
    }
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
    return db("test")->where("Id", $testid)->delete();
  }
  /**
   * 删除多个测试
   * @param array testids
   */
  public static function delete_testes($testids)
  {
    return db("test")->delete($testids);
  }
  /**
   * 现在开始一个测试,并把结束时间设置到很久
   */
  public static function start_test($tid)
  {
    db("test")->where("Id", $tid)->update([
      'startTime' => date("Y-m-d H:i:s"),
      'endTime' => date("Y-m-d H:i:s", strtotime("+1years", Time())),
    ]);
  }
  /**
   * 结束一个测试
   */
  public static function end_test($tid)
  {
    db("test")->where("Id", $tid)->update([
      'endTime' => date("Y-m-d H:i:s"),
    ]);
  }


}