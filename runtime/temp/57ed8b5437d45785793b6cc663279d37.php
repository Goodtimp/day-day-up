<?php /*a:1:{s:86:"D:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\studentanswer\index.html";i:1543148518;}*/ ?>
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
                <?php echo htmlentities($Num); ?>
              <?php echo htmlentities($content); ?>
            </p>
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