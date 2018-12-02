<?php

/**
 * User:goodtimp
 * LastDate:2018/11/24
 */


namespace app\index\controller;

use app\index\model\course as courseModel;//记录一下错误 如果修改称courses与控制器内Course冲突
use think\Controller;
use think\facade\Session;
use think\helper\Time;
use app\index\model\test as testmodel;//记录一下错误 如果修改称courses与控制器内Course冲突

class Course extends Father
{
  public function index()
  {
    $cou_id = input('id');

    if ($cou_id && self::verify($cou_id)) {
      $test = testmodel::get_tests($cou_id);//根据id获取课程测试
      $this->assign([
        'couId'=>$cou_id,
        'tests' => $test,
      ]);
      return view();
    }
    return redirect("/");
  }
  /**
   * 添加课程
   */
  public function add()
  {
    if (request()->post()) {
      $data = input("post.");
      $data["teacherId"] = Session::get("Id", 'teacher');
      self::add_course($data);
      return redirect("/");
    }
    return view();
  }

  /**
   * 删除课程
   */
  public function delete()
  {
    if (request()->post()) {
      $data = input("post.");
      if(self::verify($data["Id"]))
      {
        courseModel::delete_course($data["Id"]);
      }
    }

    return redirect("/");
  }
  /**
   * 验证
   */
  static function verify($cou_id)
  {
    $cou = courseModel::get_course_by_id($cou_id);
    if ($cou && Session::get("Id", "teacher") == $cou["teacherId"]) return true;
    return false;
  }
  private function add_course($data)//避免创建时间的添加
  {
    $cou = new courseModel();
    $cou->name = $data['name'];
    $cou->teacherId = $data['teacherId'];
    $cou->save();
  }
}