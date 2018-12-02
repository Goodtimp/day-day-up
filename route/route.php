<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

//学生部分
Route::rule('stulogin/:id','index/studentlogin/index');
Route::rule('stulogin/','index/studentlogin/index');
Route::rule('stuanswer/','index/studentanswer/index');



//教师部分路由
Route::get('hello/:name', 'index/hello');

Route::rule('course/add','index/course/add');
Route::rule('course/:id','index/course/index');

Route::rule('test/add','index/test/add');
Route::rule('test/:id$','index/test/index');
Route::rule('test/editor/:id','index/test/editortest');

Route::rule('answer/:id','index/answer/index');

Route::rule('/','index');
Route::rule('login','index/login/index');



return [

];
