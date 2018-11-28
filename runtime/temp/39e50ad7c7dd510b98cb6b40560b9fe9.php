<?php /*a:4:{s:75:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\test\add.html";i:1543319848;s:80:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\father\header.html";i:1543061840;s:78:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\father\left.html";i:1543065665;s:80:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\father\footer.html";i:1543056846;}*/ ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>教师终端</title>

  <link rel="stylesheet" href="/day-day-up/vendor/layui/src/css/layui.css">
</head>

<body class="layui-layout-body">
  <div class="layui-layout layui-layout-admin">
    <div class="layui-header">
  <div class="layui-logo">layui 后台布局</div>
  <!-- 头部区域（可配合layui已有的水平导航） -->
  <ul class="layui-nav layui-layout-left">
    <li class="layui-nav-item"><a href="">题库</a></li>
    <!-- <li class="layui-nav-item"><a href="<?php echo url('studentlogin/index'); ?>?id=1">开始测试1</a></li>
    <li class="layui-nav-item"><a href="<?php echo url('Login/index'); ?>">登录</a></li> -->
   
  </ul>
  <ul class="layui-nav layui-layout-right">
    <li class="layui-nav-item">
      <a href="javascript:;">
        <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
        <?php echo htmlentities($name); ?> 
      </a>
      <dl class="layui-nav-child">
        <dd><a href="">基本资料</a></dd>
        <dd><a href="">安全设置</a></dd>
      </dl>
    </li>
    <li class="layui-nav-item"><a href="<?php echo url('Login/exit_user'); ?>">退了</a></li>
  </ul>
</div>
    <div class="layui-side layui-bg-black">
  <div class="layui-side-scroll">
    <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
    <ul class="layui-nav layui-nav-tree"  lay-filter="test">
      <li class="layui-nav-item layui-nav-itemed">
        <a class="" href="javascript:;">课程</a>
        <dl class="layui-nav-child">
          <?php if(is_array($courses) || $courses instanceof \think\Collection || $courses instanceof \think\Paginator): $i = 0; $__LIST__ = $courses;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cou): $mod = ($i % 2 );++$i;?>
          <dd><a href="<?php echo url('Course/index'); ?>?id=<?php echo htmlentities($cou['Id']); ?>"><?php echo htmlentities($cou['name']); ?></a></dd>
          <?php endforeach; endif; else: echo "" ;endif; ?>
          <dd><a href="<?php echo url('Course/add'); ?>">添加课程</a></dd>
        </dl>
      </li>
      
      <li class="layui-nav-item"><a href="<?php echo url('Test/add'); ?>">创建测试</a></li>
    </ul>
  </div>
</div>


    <div class="layui-body">

      <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>表单集合演示</legend>
      </fieldset>

      <form class="layui-form" action="" method="POST">
        <div class="layui-form-item">
          <label class="layui-form-label">测试名称</label>
          <div class="layui-input-block">
            <input type="text" style="width:300px" name="name" lay-verify="name" autocomplete="off" placeholder="请输入测试名称"
              class="layui-input">
          </div>
        </div>


        <div class="layui-form-item">

          <div class="layui-inline">
            <label class="layui-form-label">开始时间</label>
            <div class="layui-input-inline">
              <input type="text" name="startTime" id="startdate" lay-verify="startdate" placeholder="yyyy-MM-dd hh:mm:ss"
                autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-inline">
            <label class="layui-form-label">结束时间</label>
            <div class="layui-input-inline">
              <input type="text" name="endTime" id="enddate" lay-verify="enddate" placeholder="yyyy-MM-dd hh:mm:ss"
                autocomplete="off" class="layui-input">
            </div>
          </div>
        </div>


        <div class="layui-form-item">
          <div class="layui-inline">
            <label class="layui-form-label">选择课程</label>
            <div class="layui-input-inline">
              <select name="courseId" lay-verify="required" lay-search="">
                <?php if(is_array($courses) || $courses instanceof \think\Collection || $courses instanceof \think\Paginator): $i = 0; $__LIST__ = $courses;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cou): $mod = ($i % 2 );++$i;?>
                <option value=<?php echo htmlentities($cou['Id']); ?>><?php echo htmlentities($cou['name']); ?></option>

                <?php endforeach; endif; else: echo "" ;endif; ?>


              </select>
            </div>
          </div>
        </div>

        <div class="layui-form-item">
          <div class="layui-input-block">
            <button class="layui-btn" lay-submit="" lay-filter="demo1">添加测试</button>
          </div>
        </div>
      </form>

      <div style="padding: 15px;">

      </div>
    </div>
    <div class="layui-footer">
  <!-- 底部固定区域 -->
  @goodtimp & @someonegirl
</div>


  </div>
  <script src="/day-day-up/vendor/layui/src/layui.js"></script>
  <script>
    layui.use(['form', 'layedit', 'laydate'], function () {
      var form = layui.form,
        layer = layui.layer,
        layedit = layui.layedit,
        laydate = layui.laydate;

      //日期
      laydate.render({
        elem: '#startdate',
        type: 'datetime'
      });
      laydate.render({
        elem: '#enddate',
        type: 'datetime'
      });
      var starttime;
      //自定义验证规则
      form.verify({
      
        name: function (value) {
          if (value.length < 1) {
            return '测试名至少1个字符';
          } else if (value.length > 100) {
            return '测试名最多40个字符';
          }
        },
        startdate: function (value) {
          if(value.length<8)
          {
            return '请选择正确的开始时间';
          }
          starttime=value;
        },
        enddate:function(value){
          if(value.length<8)
          {
            return '请选择正确的结束时间';
          }
          if(starttime>value)
          {
            return '请确定开始时间早于结束时间';
          }
        },
        required:function(value){
          if(value==null)
          {
            return '请确定课程时间';
          }
        }
      });


    });
    //JavaScript代码区域
    layui.use('element', function () {
      var element = layui.element;
    });
  </script>
</body>

</html>