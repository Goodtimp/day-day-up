<?php /*a:1:{s:78:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\login\index.html";i:1542977947;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>layui</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="/day-day-up/vendor/layui/dist/css/layui.css"  media="all">
  <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>
          

<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
  <legend>教师端登录</legend>
</fieldset>
<div class="layui-form-mid layui-word-aux" style="margin-left:5%;"><?php echo htmlentities($msg); ?></div>
<form class="layui-form" action="" method="POST" lay-filter="example">
  <div class="layui-form-item">
    <label class="layui-form-label">账号</label>
    <div class="layui-input-block">
      <input type="text" name="username" lay-verify="username" autocomplete="off" placeholder="请输入:姓名/昵称/Id" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">密码</label>
    <div class="layui-input-block">
      <input type="password" name="password" lay-verify="password" placeholder="请输入密码" autocomplete="off" class="layui-input">
    </div>
  </div>

  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit="" lay-filter="demo1">登录</button>
    </div>
  </div>
</form>

          
<script src="/day-day-up/vendor/layui/dist/layui.js" charset="utf-8"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
layui.use(['form', 'layedit', 'laydate'], function(){
  var form = layui.form
  ,layer = layui.layer
  ,layedit = layui.layedit
  ,laydate = layui.laydate;
  
  //自定义验证规则
  form.verify({
    username: function(value){
      if(value.length < 1){
        return '标题至少得1个字符';
      }
    }
    ,password: [/(.+){3,12}$/, '密码必须3到18位']
    ,content: function(value){
      layedit.sync(editIndex);
    }
  });
  
  
  //表单初始赋值
  // form.val('example', {
  //   "username": "" // "name": "value"
  //   ,"password": "123456"
    
  // })
  
});
</script>

</body>
</html>