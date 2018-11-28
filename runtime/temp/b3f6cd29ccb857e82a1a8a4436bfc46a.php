<?php /*a:5:{s:77:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\test\index.html";i:1543382994;s:80:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\father\header.html";i:1543061840;s:78:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\father\left.html";i:1543065665;s:88:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\question\questionView.html";i:1543379998;s:80:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\father\footer.html";i:1543056846;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>教师终端</title>

    <link rel="stylesheet" href="/day-day-up/vendor/layui/src/css/layui.css">
    <style>
        .test-message {
            margin: 20px;
        }
    </style>
</head>

<body class="layui-layout-body" style=" background-color: #F2F2F2;">
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
</div> <div class="layui-side layui-bg-black">
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
            
            <div style="padding: 20px; background-color: #F2F2F2;">
                <div class="layui-row layui-col-space15">
                    <div class="">
                        <div class="layui-card">
                            <div class="test-message">
                                <h1><?php echo htmlentities($test['name']); ?></h1>
                                <a href="<?php echo url('Test/index'); ?>?id=<?php echo htmlentities($test['Id']); ?>">修改测试</a>
                                <p>开始时间：<?php echo htmlentities($test['startTime']); ?></p>
                                <p>结束时间：<?php echo htmlentities($test['endTime']); ?></p>
                            </div>
                            <?php if(is_array($test_question) || $test_question instanceof \think\Collection || $test_question instanceof \think\Paginator): $i = 0; $__LIST__ = $test_question;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$question): $mod = ($i % 2 );++$i;?>
                            <div class="layui-card-body question_content">

                                <div class="view"><div class=""><?php echo htmlentities($question['num']); ?> .<?php echo htmlentities($question['content']); ?></div>
                                <div class="layui-hide right"><?php echo htmlentities($question['right']); ?></div>
                                <div class="layui-hide type"><?php echo htmlentities($question['type']); ?></div>
    <div class="options">
        <?php if(is_array($question['answer']) || $question['answer'] instanceof \think\Collection || $question['answer'] instanceof \think\Paginator): $i = 0; $__LIST__ = $question['answer'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
        <input type="radio" name=<?php echo htmlentities($question['num']); ?> value="<?php echo htmlentities($option); ?>" title="男" checked="false">
        <span class="answer"><?php echo htmlentities($option); ?></span>
        <br/> <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <div class="textbox">
        <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="" class="layui-input">
    </div>
    <div class="Edit ">
        <input type="button" value="修改题目" class="Editor"/>
     </div></div>
                                <div class="edit layui-hide"><div class="layui-footer">
  <!-- 底部固定区域 -->
  @goodtimp & @someonegirl
</div></div>
                            </div>

                            
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>
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
            layui.use('element', function () {
                var element = layui.element;
            });
      
            $(function () {
                $(".view").each(function () {
                    var type = $(this).children(".type").text();
                    //根据题目类型判断显示输入框还是单选框
                    if (type.trim() == 3) {
                        $(this).children(".textbox").html("");
                        var right = $(this).children(".right").text();
                        var answer = $(this).children(".options").children(".answer");
                        answer.each(function () {
                            if ($(this).text().trim() == right.trim()) {
                                $(this).prev().prop("checked", true);
                            }
                        })

                    }
                    else {
                        var answer = $(this).children(".options").children(".answer").text();//获取答案，用来输入框的显示
                        $(this).children(".options").html("");
                        $(this).children(".textbox").children("input").attr("placeholder", answer);
                    }
                });
                
                //$(".Editor").each(function(){
                  // $(this).click(function(){
                      // var div='<div class="layui-footer">
  <!-- 底部固定区域 -->
  @goodtimp & @someonegirl
</div>';
                      // $(this).parents(".question_content").html("").append();
                 //  })
                //})
            })
        </script>
</body>

</html>