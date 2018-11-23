<?php

/**
 * User:goodtimp
 * LastDate:2018/11/21
 */

namespace app\index\model;

use think\Model;

class answer extends Model
{
  /**
   * 根据学生sno,得到所有的答题
   * @param int $sno
   * @return array {Id,studentSno,score,testId}
   */
  public static function get_answer_by_sno($sno)
  {

    $res = db("answer")->where("studentSno",$sno)->select();

    static $arr = array();
    $temp_arr = array();
    foreach ($res as $row) {
      $temp_arr['Id'] = $row['Id'];
      $temp_arr['studentSno'] = $row['studentSno'];
      $temp_arr['score'] = $row['score'];
      $temp_arr['testId'] = $row['testId'];
      $arr[] = $tmp_arr; 
    }
    return $arr;
  }
  
  /**
   * 根据测试id,得到所有的答题
   * @param int $testid
   * @return array {Id,studentSno,score,testId}
   */
  public static function get_answer_by_testid($testid)
  {

    $res = db("answer")->where("testId",$testid)->select();

    static $arr = array();
    $temp_arr = array();
    foreach ($res as $row) {
      $temp_arr['Id'] = $row['Id'];
      $temp_arr['studentSno'] = $row['studentSno'];
      $temp_arr['score'] = $row['score'];
      $temp_arr['testId'] = $row['testId'];
      $arr[] = $tmp_arr; 
    }
    return $arr;
  }
  /**
   *  添加答题信息
   * @param array answer {Id,studentSno,score,testId}
 
   */
  public static function add_answere($answer)
  {
    return db("answer")->insert($answer);
  }
  /**
   *  根据答题id，删除答题信息
   * @param int  answerid
 
   */
  public static function delete_answere($answerid)
  {
    return db("answer")->delete($answerid);
  }
  /**
   *  根据答题id，删除多个答题信息
   * @param array answerids 
   */
  public static function delete_answeres($answerids)
  {
    return db("answer")->delete($answerids);
  }
   /**
   *  根据答题id，更新答题信息
   * @param array answer {Id,studentSno,score,testId}
 
   */
  public static function update_answere($answer)
  {
    return db("answer")->where("Id",$answer["Id"])->update([
      'studentSno'=>$answer["studentSno"],
      'score'=>$answer["score"],
      'testId'=>$answer["testId"],
    ]);
  }

}