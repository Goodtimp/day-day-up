<?php

/**
 * User:goodtimp
 * LastDate:2018/11/23
 */

namespace app\index\controller;

use app\index\model\teacher as teacher;
use app\index\model\course as course;
use think\Controller;
use think\facade\Session;

class Father extends Controller
{
  protected function initialize()
  {
    if (!Session::has("Id", 'teacher')) {
      $this->redirect("login/index");
    }
    $courses = self::get_courses_teacher_id(Session::get("Id", 'teacher'));//得到当前session内老师的课程信息

    $this->assign([
      'courses' => $courses,
      "name" => Session::get("name", 'teacher'),
      "loginId" => Session::get("loginId", 'teacher'),
    ]);
  }
  /**得到所有的课程信息 */
  function get_courses_teacher_id($tid)
  {
    $arr = course::get_course($tid);
    return $arr;
  }

}