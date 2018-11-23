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
   * @return array {Id,studentId,score,testId}
   */
  public static function get_answer_by_sno($stuid)
  {

    $res = db("answer")->where("studentId",$stuid)->select();

    static $arr = array();
    $temp_arr = array();
    foreach ($res as $row) {
      $temp_arr['Id'] = $row['Id'];
      $temp_arr['studentId'] = $row['studentId'];
      $temp_arr['score'] = $row['score'];
      $temp_arr['testId'] = $row['testId'];
      $arr[] = $tmp_arr; 
    }
    return $arr;
  }
  
  /**
   * 根据测试id,得到所有的答题
   * @param int $testid
   * @return array {Id,studentId,score,testId}
   */
  public static function get_answer_by_testid($testid)
  {

    $res = db("answer")->where("testId",$testid)->select();

    static $arr = array();
    $temp_arr = array();
    foreach ($res as $row) {
      $temp_arr['Id'] = $row['Id'];
      $temp_arr['studentId'] = $row['studentId'];
      $temp_arr['score'] = $row['score'];
      $temp_arr['testId'] = $row['testId'];
      $arr[] = $tmp_arr; 
    }
    return $arr;
  }
  /**
   * 根据测试id和学生id得到答题信息
   * @param int $testid
   * @return array {Id,studentId,score,testId}
   */
  public static function get_answer_by_testid_stuid($testid,$stuid)
  {

    $res = db("answer")->where("studentId",$stuid)->where('testId',$testid)->select();

    static $arr = array();
    $temp_arr = array();
    foreach ($res as $row) {
      $temp_arr['Id'] = $row['Id'];
      $temp_arr['studentId'] = $row['studentId'];
      $temp_arr['score'] = $row['score'];
      $temp_arr['testId'] = $row['testId'];
      $arr[] = $tmp_arr; 
    }
    return $arr;
  }
  /**
   *  添加答题信息
   * @param array answer {Id,studentId,score,testId}
 
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
   * @param array answer {Id,studentId,score,testId}
 
   */
  public static function update_answere($answer)
  {
    return db("answer")->where("Id",$answer["Id"])->update([
      'studentId'=>$answer["studentId"],
      'score'=>$answer["score"],
      'testId'=>$answer["testId"],
    ]);
  }

}