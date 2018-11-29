<?php /*a:6:{s:77:"D:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\test\index.html";i:1543453094;s:80:"D:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\father\header.html";i:1543061840;s:78:"D:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\father\left.html";i:1543065665;s:88:"D:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\question\questionView.html";i:1543386856;s:90:"D:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\question\questionEditor.html";i:1543453996;s:80:"D:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\father\footer.html";i:1543056846;}*/ ?>
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

                                <div class="view">
                                    <div class=""><?php echo htmlentities($question['num']); ?> .<?php echo htmlentities($question['content']); ?></div>
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

<div class="">
        <input type="button" value="修改题目" class="Motify" />
    </div>
                                </div>
                                <div class="edit layui-hide">
                                       <!-- 填空题与问答题 -->

<div class="my-completion">
    <form class="layui-form" action="../Test/TestQuestionChange" method="POST">
        <input name="test_id" value=<?php echo htmlentities($test['Id']); ?> style="display: none;">
        <input name="type" value="" style="display:none" class="type">
        <input name="question_id" value=<?php echo htmlentities($question['num']); ?> style="display: none;">
        <div class="">第<?php echo htmlentities($question['num']); ?>题 </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">题目描述</label>
            <div class="layui-input-block">
                <textarea placeholder="" lay-verify="content" name="content" class="layui-textarea"><?php echo htmlentities($question['content']); ?></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">正确答案</label>
            <div class="layui-input-block">
                <input type="text" name="true_answer" lay-verify="choise" autocomplete="off" placeholder="" class="layui-input" value="<?php echo htmlentities($question['right']); ?>">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">做答时间</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" name="time" id="question_time1" placeholder="" value="<?php echo htmlentities($question['Time']); ?>">
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">该题分值</label>
                <div class="layui-input-inline">
                    <input type="text" name="score" lay-verify="score" name="question_score" placeholder="" autocomplete="off" class="layui-input" value="<?php echo htmlentities($question['Score']); ?>">
                </div>
            </div>
        </div>
        
        <div class="">
                <input type="submit" value="保存" class="Save" />
            </div>
    </form>
    <div></div>
</div>

                                </div>
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
        <script src="/day-day-up/public/static/js/jquery-1.11.1.js"></script>
        <script>
            //JavaScript代码区域
            layui.use('element', function () {
                var element = layui.element;
            });

            $(function () {
                $(".Motify").each(function () {
                    $(this).click(function () {
                        $(this).parents(".question_content").children(".view").addClass("layui-hide");
                        $(this).parents(".question_content").children(".edit").removeClass("layui-hide");
                    })
                });
                $(".Save").each(function(){
                    $(this).click(function(){
                        $(this).parents(".question_content").children(".view").removeClass("layui-hide");
                        $(this).parents(".question_content").children(".edit").addClass("layui-hide");
                    })
                })
                $(".view").each(function () {
                    var type = $(this).children(".type").text();
                    //根据题目类型判断显示输入框还是单选框
                    if (type.trim() == 3) {
                        $(this).children(".textbox").html("");
                        $(this).next().children(".type").val(type.trim());
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
                        $(this).next().children(".type").val(type.trim());
                    }
                });


            })
        </script>
         <script>
            layui.use(['form', 'layedit', 'laydate'], function () {
              var form = layui.form,
                layer = layui.layer,
                layedit = layui.layedit,
                laydate = layui.laydate;
              //时间设置
              laydate.render({
                elem: '#question_time1',
                format: "mm:ss",
                value: "10:00",
                max: "00:59:59",
                min: "00:00:01",
                type: 'time'
              });
              laydate.render({
                elem: '#question_time2',
                format: "mm:ss",
                value: "10:00",
                max: "00:59:59",
                min: "00:00:01",
                type: 'time'
              });
              laydate.render({
                elem: '#question_time3',
                format: "mm:ss",
                value: "10:00",
                max: "00:59:59",
                min: "00:00:01",
                type: 'time'
              });
              //自定义验证规则
              form.verify({
                content: function (value) {
                  if (value.length < 1) {
                    return '请输入题目描述';
                  } else if (value.length > 600) {
                    return '学生读题很麻烦，所以题目描述最多600字';
                  }
                },
        
                score: [/^\+?[1-9][0-9]*$/, '请输入正整数分值'],
                choise: function (value) {
                  if (value.length < 1) {
                    return '请输入答案信息描述';
                  } else if (value.length > 600) {
                    return '学生读题很麻烦，答案最多600字';
                  }
                },
        
                required: function (value) {
                  if (value == null) {
                    return '请确定课程时间';
                  }
                }
              });
        
        
            });
          </script>
</body>

</html>