<?php /*a:4:{s:79:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\course\index.html";i:1543412851;s:80:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\father\header.html";i:1543061840;s:78:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\father\left.html";i:1543065665;s:80:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\father\footer.html";i:1543056846;}*/ ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>教师终端</title>
  <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
  <link rel="stylesheet" href="/day-day-up/vendor/layui/src/css/layui.css">
  <style>
    .test-tr td,
    .test-th {
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


    <div class="layui-body" style="padding:10px;">
      <!-- 内容主体区域 -->
      <table class="layui-table">
        <colgroup>
          <col width="150">
          <col width="200">
          <col width="200">
          <col width="100">
          <col>
        </colgroup>
        <thead>
          <tr>
            <th>测试名称</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>完成状态</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php if(is_array($tests) || $tests instanceof \think\Collection || $tests instanceof \think\Paginator): $i = 0; $__LIST__ = $tests;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$test): $mod = ($i % 2 );++$i;?>
          <tr>
            <td >
              <?php echo htmlentities($test['name']); ?>
         
              </td>
            <td><?php echo htmlentities($test['startTime']); ?></a></td>
            <td><?php echo htmlentities($test['endTime']); ?></a></td>
            <td class="status"><?php echo htmlentities($test['status']); ?></td>
            
            <td><a href="<?php echo url('Test/index'); ?>?id=<?php echo htmlentities($test['Id']); ?>">查看测试</a></td>
            <td style="display:none;"><?php echo htmlentities($test['Id']); ?></td>
           
          </tr>

          <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      </table>
    </div>

    <div class="layui-footer">
  <!-- 底部固定区域 -->
  @goodtimp & @someonegirl
</div>
  </div>
  <script src="/day-day-up/vendor/layui/src/layui.js"></script>
  <script>
    $(function(){
      $(".status").each(function(){
        if($(this).text()=="未完成")
        {
          $(this).next().find("a").attr("href","<?php echo url('Test/editortest'); ?>?id=<?php echo htmlentities($test['Id']); ?>");
        }
      })
     
     
    })
    //JavaScript代码区域
    layui.use('element', function () {
      var element = layui.element;

    });
  </script>
</body>

</html>