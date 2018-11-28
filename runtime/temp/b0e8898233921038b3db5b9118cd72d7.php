<?php /*a:1:{s:86:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\studentanswer\index.html";i:1543377418;}*/ ?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>登录</title>
    <link rel="stylesheet" href="/day-day-up/vendor/layui/src/css/layui.css">
    <style>
        #form-main{
            margin: 20px;
        }
    </style>
</head>

<body>
    <div class="layui-anim layui-anim-up login-main" id="form-main">
        <form class="layui-form" role="form" action="" method="post">
            <p>
                <?php echo htmlentities($Num); ?>:
              <?php echo htmlentities($content); ?>
            </p>
            <?php if(is_array($answer) || $answer instanceof \think\Collection || $answer instanceof \think\Paginator): $i = 0; $__LIST__ = $answer;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$answer): $mod = ($i % 2 );++$i;?>
            <p>
               <?php echo htmlentities($answer); ?>
            </p>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <div class="ly-input">
                <input type="text" name="answerContent" required lay-verify="required" placeholder="请输入答案" autocomplete="off"
                    class="layui-input"/>
            </div>
         

            <div class="ly-input">
                <button class="layui-btn layui-btn-danger ly-submit" id="ly-submit" lay-submit lay-filter="formDemo">提交</button>
            </div>
        </form>

    </div>
</body>

</html>