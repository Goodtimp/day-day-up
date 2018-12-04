<?php /*a:4:{s:78:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\index\index.html";i:1543833702;s:80:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\father\header.html";i:1543833286;s:78:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\father\left.html";i:1543722768;s:80:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\father\footer.html";i:1543909837;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>教师终端</title>
    <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
    <script src="/public/static//js/goodtimp.js">
    </script>
    
    <script>
        $(function () {
            var mobile_flag = isMobile(); // false为PC端，true为手机端

            if (mobile_flag) {
                window.location.href = "/index/Moblie/index/"
            }
        });
    </script>
    <link rel="stylesheet" href="/vendor/layui/src/css/layui.css">
</head>

<body class="layui-layout-body">
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
  <div class="layui-logo">教师端</div>
  <!-- 头部区域（可配合layui已有的水平导航） -->
  <ul class="layui-nav layui-layout-left">
    <li class="layui-nav-item"><a href="">题库</a></li>
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
          <dd><a href="/course/<?php echo htmlentities($cou['Id']); ?>"><?php echo htmlentities($cou['name']); ?></a></dd>
          <?php endforeach; endif; else: echo "" ;endif; ?>
          <dd><a href="/course/add">添加课程</a></dd>
        </dl>
      </li>
      
      <li class="layui-nav-item"><a href="/test/add">创建测试</a></li>
    </ul>
  </div>
</div>


        <div class="layui-body">
            <!-- 内容主体区域 -->
            <div style="padding: 15px;">

            </div>
        </div>
        <div class="layui-footer">
  <!-- 底部固定区域 -->
  <a href="http://722first.club/">@goodtimp</a> & @someonegirl
</div>


    </div>
    <script src="/vendor/layui/src/layui.js"></script>
    <script>
        function isMobile() {
            var userAgentInfo = navigator.userAgent;
            var mobileAgents = ["Android", "iPhone", "SymbianOS", "Windows Phone", "iPad", "iPod"];
            var mobile_flag = false;
            //根据userAgent判断是否是手机
            for (var v = 0; v < mobileAgents.length; v++) {
                if (userAgentInfo.indexOf(mobileAgents[v]) > 0) {
                    mobile_flag = true;
                    break;
                }
            }
            var screen_width = window.screen.width;
            var screen_height = window.screen.height;

            //根据屏幕分辨率判断是否是手机
            if (screen_width < 500 && screen_height < 800) {
                mobile_flag = true;
            }
            return mobile_flag;
        }

        $(function () {
            var mobile_flag = isMobile(); // false为PC端，true为手机端

            if (mobile_flag) {

            }
        });


        //JavaScript代码区域
        layui.use('element', function () {
            var element = layui.element;

        });
    </script>
</body>

</html>