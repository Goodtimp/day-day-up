<?php
/**
 * User:goodtimp
 * LastDate:2018/11/22
 */

namespace app\index\controller;
use app\index\model\answer as answer;
use think\Controller;
use app\index\model\testdetail as testdetail;
class Studentanswer extends Controller
{
  public function index()
  {
    return self::get_testdetail();
    
  }
  /**
   * 得到测试详情信息，通过session
   */
  function get_testdetail()
  {
    if(!session('test_Id','','index')||! session('sno','','index'))
    {
      return false;
    }
    else {
      $testid=session('test_Id','','index');
      $testarry=testdetail::get_testdetail($testid);
      $detail=array();
      for($testarry as $detail)
      {
      }
    }
  }
}