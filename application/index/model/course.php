<?php

/**
 * User:goodtimp
 * LastDate:2018/11/21
 */

namespace app\index\model;

use think\Model;

class course extends Model
{
  protected $autoWriteTimestamp = 'datetime';//配置自动写入 更新创建数据库内容时间
  protected $createTime = 'createTime';

  /**
   * 根据教师id，得到所有的课程信息
   * @param int $tid
   * @return array {Id,teacherId,createTime,name}
   */
  public static function get_course($tid = 0)
  {
    $res = db("course")->where("teacherId", $tid)->select();
    return $res;
  }
  /**
   * 添加课程,采用模型存入方法。可以自动写入creattime字段,######弃用  会报错  将该方法放到了course控制器内
   * @param array cour{Id,teacherId,createTime,name}
   */
  public static function add_course($data)
  {
    $cou = new course();
    $cou->name = $data['name'];
    $cou->teacherId = $data['teacherId'];
    $cou->save();
  }

  /**
   * 删除一个课程
   * @param int courid
   */
  public static function delete_course($courid)
  {
    return db("course")->where("Id", $courid)->delete();
  }

    /**
   * 课程id得到课程
   * @param int $tid
   * @return array {Id,teacherId,createTime,name}
   */
  public static function get_course_by_id($cid = 0)
  {
    $res = db("course")->where("Id", $cid)->select();
    if($res)
    {
      return $res[0];
    }
    return $res;
  }

}