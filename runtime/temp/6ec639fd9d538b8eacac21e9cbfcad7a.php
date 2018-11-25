<?php /*a:4:{s:77:"D:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\test\index.html";i:1543146788;s:80:"D:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\father\header.html";i:1543061840;s:78:"D:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\father\left.html";i:1543065665;s:80:"D:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\father\footer.html";i:1543056846;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>教师终端</title>

  <link rel="stylesheet" href="/day-day-up/vendor/layui/src/css/layui.css">
  <style>
    .test-tr td,.test-th {
        height: 50px;
        width: 170px;
    }


    .test-tr:nth-child(2n) {
        background-color: #e8ece8;
    }

    .test-tr:hover {
        background-color: #c2d2d1;
    }

    .checked {
        font-size: 30px;
        color: #042c6b;
    }
  </style>
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
    <!-- 内容主体区域 -->
    <div style="padding: 15px;width: 500px;">
      <table class="test-table">
        <tr class="test-th">
            <th>测试名称</th>
            <th>开始时间</th>
            <th>结束时间</th>
            
        </tr>
        <tr class="test-tr">
            <td><?php echo htmlentities($test['name']); ?></td>
            <td><?php echo htmlentities($test['startTime']); ?></a></td>
            <td><?php echo htmlentities($test['endTime']); ?></a></td>
        </tr>
      </table>
      <table>
          <tr>
              <th>题号</th>
              <th>问题</th>
          </tr>
      <?php if(is_array($test_detail) || $test_detail instanceof \think\Collection || $test_detail instanceof \think\Paginator): $i = 0; $__LIST__ = $test_detail;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$detail): $mod = ($i % 2 );++$i;?>
            <tr>
                <td><?php echo htmlentities($detail['Num']); ?></td>
                <td><?php echo htmlentities($detail['content']); ?></td>
            </tr>
      <?php endforeach; endif; else: echo "" ;endif; ?>
      </table>
    </div>
  
  </div>
  <div class="layui-footer">
  <!-- 底部固定区域 -->
  @goodtimp & @someonegirl
</div>
 
 
</div>
<script src="/day-day-up/vendor/layui/src/layui.js"></script>
<script>
//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;
  
});
</script>
</body>
</html>