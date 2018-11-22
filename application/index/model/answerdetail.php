<?php

/**
 * User:goodtimp
 * LastDate:2018/11/22
 */

namespace app\index\model;

use think\Model;

class answerdetail extends Model
{
  /**
   * 根据答题Id,得到所有的答题详情
   * @param int $answerid
   * @return array {Id,answerId,questionId,Isright}
   */
  public static function get_answerdetail_by_aid($answerid)
  {

    $res = db("answerdetail")->where("answerId",$answerid)->select();

    static $arr = array();
    $temp_arr = array();
    foreach ($res as $row) {
      $temp_arr['Id'] = $row['Id'];
      $temp_arr['studenanswerIdtSno'] = $row['answerId'];
      $temp_arr['questionId'] = $row['questionId'];
      $temp_arr['Isright'] = $row['Isright'];
    }
    return $arr;
  }
  
  /**
   * 根据问题id,得到所有的答题详情
   * @param int $qid
   * @return array  {Id,answerId,questionId,Isright}
   */
  public static function get_answerdetail_by_testid($qid)
  {

    $res = db("answerdetail")->where("questionId",$qid)->select();

    static $arr = array();
    $temp_arr = array();
    foreach ($res as $row) {
      $temp_arr['Id'] = $row['Id'];
      $temp_arr['studenanswerIdtSno'] = $row['answerId'];
      $temp_arr['questionId'] = $row['questionId'];
      $temp_arr['Isright'] = $row['Isright'];
    }
    return $arr;
  }
  /**
   *  添加答题详情
   * @param array answerdetail  {Id,answerId,questionId,Isright}
 
   */
  public static function add_answerdetail($answerdetail)
  {
    return db("answerdetail")->insert($answerdetail);
  }
  /**
   *  根据答题详情id，删除答题详情信息
   * @param int  adid
 
   */
  public static function delete_answerdetail($adid)
  {
    return db("answerdetail")->delete($adid);
  }
  /**
   *  根据答题详情id，删除多个答题详情信息
   * @param array answerids 
 
   */
  public static function delete_answerdetails($adids)
  {
    return db("answerdetail")->delete($adids);
  }
   /**
   *  根据答题id，更新答题信息
   * @param array answerdetail  {Id,answerId,questionId,Isright}
 
   */
  public static function update_answere($answerdetail)
  {
    return db("answerdetail")->where("Id",$answerdetail["Id"])->update([
      'answerId'=>$answerdetail["answerId"],
      'questionId'=>$answerdetail["questionId"],
      'Isright'=>$answerdetail["Isright"],
    ]);
  }

}