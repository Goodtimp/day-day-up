<?php
/**
 * User:goodtimp
 * LastDate:2018/11/22
 */

namespace app\index\controller;
use app\index\model\answer as answer;
use think\Controller;

class Studentanswer extends Controller
{
  public function index()
  {
    $tid=input("get.id");
    return view();
  }
}